<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishSection extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_id',
        'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
