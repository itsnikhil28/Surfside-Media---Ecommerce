<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class address extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'type' => 'home'
    ];

    // public
}
