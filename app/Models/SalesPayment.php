<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_sale_payment')->withPivot(['amount']);
    }
    function client()
    {
        return $this->belongsTo(Client::class);
    }
}
