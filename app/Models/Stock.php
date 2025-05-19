<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
