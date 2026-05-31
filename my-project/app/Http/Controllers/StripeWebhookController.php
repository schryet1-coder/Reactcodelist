<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UserSubscription;
use App\Models\Subscription;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        if (!$secret) {
            Log::warning('Stripe webhook secret not configured.');
            return response('Webhook secret not configured', 400);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSession($session);
                break;

            case 'invoice.payment_succeeded':
                $invoice = $event->data->object;
                $this->handleInvoicePaymentSucceeded($invoice);
                break;

            case 'customer.subscription.updated':
            case 'customer.subscription.deleted':
                $sub = $event->data->object;
                $this->handleSubscriptionUpdated($sub);
                break;
        }

        return response('OK', 200);
    }

    protected function handleCheckoutSession($session)
    {
        // session contains metadata if set, and subscription id
        $metadata = (array)($session->metadata ?? []);
        $userId = $metadata['user_id'] ?? null;
        $subscriptionId = $metadata['subscription_id'] ?? null;

        $stripeSubId = $session->subscription ?? null;

        if ($userId && $subscriptionId) {
            $sub = Subscription::find($subscriptionId);
            if ($sub) {
                UserSubscription::create([
                    'user_id' => $userId,
                    'subscription_id' => $sub->id,
                    'starts_at' => now(),
                    'ends_at' => now()->addDays($sub->period_days),
                    'stripe_subscription_id' => $stripeSubId,
                ]);
            }
        }
    }

    protected function handleInvoicePaymentSucceeded($invoice)
    {
        // When invoice payment succeeds, extend user's subscription if linked
        $stripeSubId = $invoice->subscription ?? null;
        if (!$stripeSubId) {
            return;
        }

        $userSub = UserSubscription::where('stripe_subscription_id', $stripeSubId)->latest()->first();
        if (!$userSub) {
            return;
        }

        $sub = Subscription::find($userSub->subscription_id);
        if (!$sub) {
            return;
        }

        // extend ends_at by plan period
        $userSub->ends_at = now()->max($userSub->ends_at ?? now())->addDays($sub->period_days);
        $userSub->save();
    }

    protected function handleSubscriptionUpdated($stripeSubscription)
    {
        $stripeSubId = $stripeSubscription->id ?? null;
        if (!$stripeSubId) {
            return;
        }

        $userSub = UserSubscription::where('stripe_subscription_id', $stripeSubId)->latest()->first();
        if (!$userSub) {
            return;
        }

        // If canceled, set ends_at based on current_period_end
        if (isset($stripeSubscription->cancel_at_period_end) && $stripeSubscription->cancel_at_period_end) {
            $periodEnd = isset($stripeSubscription->current_period_end) ? \Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_end) : now();
            $userSub->ends_at = $periodEnd;
            $userSub->save();
            return;
        }

        // Otherwise, update status and dates if available
        if (isset($stripeSubscription->current_period_end)) {
            $userSub->ends_at = \Carbon\Carbon::createFromTimestamp($stripeSubscription->current_period_end);
            $userSub->save();
        }
    }
}
