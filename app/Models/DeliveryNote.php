<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    // Allow mass assignment for these attributes
    protected $fillable = [
        'route_id',  // Allow mass assignment for route_id
        'product_id', // Assuming this field is relevant to the products pivot table
        'quantity', // Add other relevant fields for the delivery note
        'unit_price', // If you want to store unit price directly
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

