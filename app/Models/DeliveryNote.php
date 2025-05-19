<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    // Allow mass assignment for these attributes
    protected $fillable = [
    'route_id',
    'product_id',   // or remove this if you're using the pivot table only
    'quantity',
    'unit_price',
    'date',
];


    // Define relationship with products (many-to-many relationship)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'delivery_note_product')
                    ->withPivot('quantity', 'unit_price'); // Optionally, add pivot fields if needed
    }

    // Define relationship with route (one-to-many relationship)
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

