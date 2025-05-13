<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $appends = [
        'total_amount'
    ];
    function client()
    {
        return $this->belongsTo(Client::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product')->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }
}
