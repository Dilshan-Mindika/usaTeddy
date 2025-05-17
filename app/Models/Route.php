<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    function clients() {
        return $this->hasMany(Client::class);
    }

    function deliveryNotes() {
        return $this->hasMany(DeliveryNote::class);
    }
}
