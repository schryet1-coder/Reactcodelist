<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Subscription;

class UserSubscription extends Model
{
    protected $fillable = ['user_id', 'subscription_id', 'starts_at', 'ends_at', 'stripe_subscription_id'];
    protected $casts = ['starts_at' => 'datetime', 'ends_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isActive(): bool
    {
        return $this->ends_at && $this->ends_at->isFuture();
    }

    public function remainingDays(): int
    {
        return $this->ends_at ? now()->diffInDays($this->ends_at, false) : 0;
    }
}
