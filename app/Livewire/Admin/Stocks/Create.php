<?php

namespace App\Livewire\Admin\Stocks;

use App\Models\Stock;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $stock = [
        'name' => '',
        'quantity' => '',
        'unit_id' => '',
        'unit_price' => '',
        'total_price' => '',
        'brought_date' => '',
    ];

    public $units;

    public function mount()
    {
        $this->units = Unit::all();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['stock.quantity', 'stock.unit_price'])) {
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        $quantity = (float) $this->stock['quantity'];
        $unitPrice = (float) $this->stock['unit_price'];

        $this->stock['total_price'] = $quantity * $unitPrice;
    }

    public function save()
    {
        $this->validate([
            'stock.name' => 'required|string|max:255',
            'stock.quantity' => 'required|numeric|min:0.01',
            'stock.unit_id' => 'required|exists:units,id',
            'stock.unit_price' => 'required|numeric|min:0',
            'stock.brought_date' => 'required|date',
        ]);

        Stock::create($this->stock);

        session()->flash('success', 'Stock created successfully.');
        $this->reset('stock');
    }

    public function render()
    {
        return view('livewire.admin.stocks.create', [
            'units' => $this->units
        ]);
    }
}
