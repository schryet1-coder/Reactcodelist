<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['position', 'content', 'active'];
    protected $casts = ['active' => 'bool'];
}
