How to run background worker and Stripe webhook

- Ensure `.env` contains:
  - `EXTREME_API_URL` and `EXTREME_API_KEY` for channel fetching
  - `STRIPE_SECRET` and `STRIPE_PUBLISHABLE_KEY` for payments
  - `STRIPE_WEBHOOK_SECRET` for webhook signature verification

Run migrations and seeders:

```bash
php artisan migrate --force
php artisan db:seed
```

Run the queue worker (recommended to use supervisor in production):

```bash
# run continuous worker
php artisan queue:work

# or run one-off job processor (useful for CI)
php artisan queue:work --once
```

Create Stripe webhook (in Stripe dashboard) pointing to:

```
https://<your-host>/webhook/stripe
```

Set the `STRIPE_WEBHOOK_SECRET` in `.env` to the secret provided by Stripe.
