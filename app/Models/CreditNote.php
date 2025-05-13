<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    function products()
    {
        return $this->belongsToMany(Product::class, 'credit_note_product');
    }
}
