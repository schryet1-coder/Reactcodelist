<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\UserSubscription;

class Subscription extends Model
{
    protected $fillable = ['name', 'price', 'period_days', 'features', 'active'];
    protected $casts = ['features' => 'array', 'active' => 'bool'];

    public function userSubscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function getFeatureListAttribute(): array
    {
        return $this->features ?? [];
    }
}
