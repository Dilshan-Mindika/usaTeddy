<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    function products()
    {
        return $this->hasMany(Product::class);
    }
}
