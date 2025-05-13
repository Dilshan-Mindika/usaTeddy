<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    function payments()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->total_amount;
        });
    }
    function getTotalPaidAttribute()
    {
        return $this->payments->sum(function ($payment) {
            return $payment->amount;
        });
    }

    function getTotalBalanceAttribute()
    {
        return $this->total_amount - $this->total_paid;
    }
}
