<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class transaction_detail extends Model
{
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }
}
