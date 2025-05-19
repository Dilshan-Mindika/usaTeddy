<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'unit_id',
        'unit_price',
        'total_price',
        'brought_date',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
