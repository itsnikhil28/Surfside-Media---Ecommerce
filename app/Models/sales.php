<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class sales extends Model
{
    public $guarded = [];

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
