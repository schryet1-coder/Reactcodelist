<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    protected $table = 'matches';
    protected $fillable = ['title', 'external_url', 'starts_at', 'meta'];
    protected $casts = ['meta' => 'array', 'starts_at' => 'datetime'];
}
