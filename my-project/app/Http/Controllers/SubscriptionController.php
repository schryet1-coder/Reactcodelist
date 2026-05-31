<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Subscription::where('active', true)->get();
        $current = auth()->check() ? auth()->user()->activeSubscription() : null;
        return view('subscriptions.index', compact('plans', 'current'));
    }

    public function checkout(Request $request, Subscription $subscription)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('message', 'Please login to purchase a subscription.');
        }

        if (!env('STRIPE_SECRET')) {
            return redirect('/subscriptions')->with('message', 'Stripe configuration is missing.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'mode' => 'subscription',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $subscription->name],
                    'unit_amount' => (int)($subscription->price * 100),
                    'recurring' => ['interval' => 'month'],
                ],
                'quantity' => 1,
            ]],
            'success_url' => url('/subscriptions/success'),
            'cancel_url' => url('/subscriptions'),
            'metadata' => ['subscription_id' => $subscription->id, 'user_id' => auth()->id()],
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('subscriptions.success');
    }
}
