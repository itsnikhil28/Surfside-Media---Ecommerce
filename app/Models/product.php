<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class product extends Model
{
    public $guarded = [];

    public function brand()
    {
        return $this->belongsTo(brand::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function sale()
    {
        return $this->hasOne(sales::class);
    }

    // public function wishlist()
    // {
    //     return $this->belongsTo(wishlist::class);
    // }
}
