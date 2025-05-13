<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = [
        'total_amount'
    ];
    function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->unit_price;
        });
    }


}
