<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'identifier', 'meta'];

    protected $casts = [
        'meta' => 'array',
    ];
}
