<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['name', 'price', 'period_days', 'features', 'active'];
    protected $casts = ['features' => 'array', 'active' => 'bool'];
}
