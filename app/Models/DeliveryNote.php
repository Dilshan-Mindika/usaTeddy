<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    function products()
    {
        return $this->belongsToMany(Product::class, 'delivery_note_product');
    }
}
