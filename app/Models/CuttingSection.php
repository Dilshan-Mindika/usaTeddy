<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuttingSection extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'unit_id',
        'product_id',
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
