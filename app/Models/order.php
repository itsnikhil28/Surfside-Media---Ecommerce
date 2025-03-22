<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use MongoDB\Laravel\Eloquent\Model;

class order extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'type' => 'home',
        'status' => 'ordered',
        'is_shipping_different' => false,
        'canceled_date' => 0,
    ];

    protected $casts = [
        'total' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(orderitem::class);
    }

    public function transaction()
    {
        return $this->hasOne(transaction::class);
    }
}
