<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['key', 'name'];

    protected $casts = [
        'name' => 'array',
    ];
}
