<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    protected $fillable = ['title', 'path', 'user_id', 'meta'];
    protected $casts = ['meta' => 'array'];
}
