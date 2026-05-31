How to run background worker and Stripe webhook

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

## CI and Deployment Instructions for InfinityFree

The repository now includes a deploy package workflow that produces a downloadable `deploy.zip` artifact.

You can also generate the package locally using:

```bash
./scripts/prepare_deploy.sh deploy.zip
```

To deploy your application on InfinityFree, follow these steps:

1. **Create an InfinityFree Account**: Sign up at [InfinityFree](https://infinityfree.net).

2. **Download the deploy artifact**: After the GitHub Actions `deploy` job runs successfully, download the `deploy-package` artifact. It contains:
   - `htdocs/` for the public web root
   - `laravel_app/` for the application files

3. **Upload Your Files**: Use the file manager or an FTP client to upload `htdocs/` contents to the `htdocs` directory and `laravel_app/` to a separate folder if needed.

4. **Set Up Your Database**: If your application uses a database, create a MySQL database via the InfinityFree control panel and import your database schema.

4. **Configure Environment Variables**: Update your `.env` file with the necessary configuration for your InfinityFree environment.

5. **Access Your Application**: Your application will be accessible at `https://yourusername.epizy.com` (replace `yourusername` with your InfinityFree account username).

6. **Set Up Cron Jobs**: If you need to run scheduled tasks, set up cron jobs in the InfinityFree control panel.

7. **Monitor Your Application**: Keep an eye on your application’s performance and error logs through the InfinityFree dashboard.
