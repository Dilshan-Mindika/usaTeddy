<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    // Add 'city' to the $fillable array to allow mass assignment
    protected $fillable = ['city', 'description'];
    
    function clients() {
        return $this->hasMany(Client::class);
    }

    function deliveryNotes() {
        return $this->hasMany(DeliveryNote::class);
    }
}
