<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Allow mass assignment for the following fields
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'position',
        'registration_number',
        'bank_id',
        'account_number',
        'joining_date',
        'resignation_date',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
