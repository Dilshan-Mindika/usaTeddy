<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    function clients() {
        return $this->hasMany(Client::class);
    }
    function suppliers() {
        return $this->hasMany(Supplier::class);
    }
    function employees() {
        return $this->hasMany(Employee::class);
    }
}
