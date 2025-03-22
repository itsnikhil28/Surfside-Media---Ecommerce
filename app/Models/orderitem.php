<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class orderitem extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'rstatus' => false
    ];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    // public function review()
    // {
    //     return $this->hasOne(Review::class, 'order_item_id');
    // }
}
