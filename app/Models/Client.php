<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    'name',
    'email',
    'address',
    'phone_number',
    'registration_number',
    'bank_id',
    'account_number',
    'route_id',
];

    function bank() {
        return $this->belongsTo(Bank::class);
    }

    function route() {
        return $this->belongsTo(Route::class);
    }

    function sales()
    {
        return $this->hasMany(Sale::class);
    }

    function payments()
    {
        return $this->hasMany(SalesPayment::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->sales->sum(function ($sale) {
            return $sale->total_amount;
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
