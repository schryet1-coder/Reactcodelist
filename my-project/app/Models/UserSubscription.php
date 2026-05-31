<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $fillable = ['user_id', 'subscription_id', 'starts_at', 'ends_at', 'stripe_subscription_id'];
    protected $casts = ['starts_at' => 'datetime', 'ends_at' => 'datetime'];
}
