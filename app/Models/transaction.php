<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class transaction extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function transactiondetail()
    {
        return $this->hasMany(transaction_detail::class);
    }
}
