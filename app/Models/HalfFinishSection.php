<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalfFinishSection extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'unit_id',
        'product_id',
        'date',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
