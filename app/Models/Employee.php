<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    function bank() {
        return $this->belongsTo(Bank::class);
    }
}
