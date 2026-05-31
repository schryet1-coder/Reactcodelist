<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        Subscription::updateOrCreate(['name' => 'Basic'], ['price' => 5.00, 'period_days' => 30, 'features' => ['access' => 'standard'], 'active' => true]);
        Subscription::updateOrCreate(['name' => 'Pro'], ['price' => 12.00, 'period_days' => 30, 'features' => ['access' => 'premium'], 'active' => true]);
    }
}
