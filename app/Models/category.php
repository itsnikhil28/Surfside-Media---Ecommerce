<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class category extends Model
{
    public $guarded = [];

    public function products()
    {
        return $this->hasMany(product::class);
    }
}
