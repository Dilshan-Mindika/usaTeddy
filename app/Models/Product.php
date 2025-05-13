<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $appends = [
        'total_purchase_count',
        'total_sale_count',
        'inventory_balance',
    ];
    function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale')->withPivot(['quantity', 'unit_price']);
    }
    function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'product_purchase')->withPivot(['quantity', 'unit_price']);
    }
    function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'product_quotation')->withPivot(['quantity', 'unit_price']);
    }
    function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot(['quantity', 'unit_price']);
    }
    function invoices()
    {
        return $this->belongsToMany(Invoice::class,  'invoice_product')->withPivot(['quantity', 'unit_price']);
    }
    function deliveryNotes()
    {
        return $this->belongsToMany(DeliveryNote::class, 'delivery_note_product');
    }
    function creditNotes()
    {
        return $this->belongsToMany(CreditNote::class, 'credit_note_product');
    }

    function getTotalPurchaseCountAttribute(){
        $amount = 0;
        foreach ($this->purchases as $purchase)
        {
            $amount += ($purchase->pivot->quantity);
        }

        return $amount;
    }
    function getTotalSaleCountAttribute(){
        $amount = 0;
        foreach ($this->sales as $sale) {
            $amount += ($sale->pivot->quantity);
        }

        return $amount;
    }

    function getInventoryBalanceAttribute()
    {
        return $this->total_purchase_count - $this->total_sale_count;
    }



}
