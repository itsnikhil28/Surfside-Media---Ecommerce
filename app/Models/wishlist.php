<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class wishlist extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
