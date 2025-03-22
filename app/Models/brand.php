<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class brand extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    public function products()
    {
        return $this->hasMany(product::class);
    }
}
