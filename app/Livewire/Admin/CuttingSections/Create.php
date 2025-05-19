<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $section = [
        'name' => '',
        'quantity' => '',
        'unit_id' => '',
        'product_id' => '',
        'date' => '',
    ];

    public $units;
    public $products;

    public function mount()
    {
        $this->units = Unit::all();
        $this->products = Product::all();
    }

    public function save()
    {
        $this->validate([
            'section.name' => 'required|string|max:255',
            'section.quantity' => 'required|numeric|min:0.01',
            'section.unit_id' => 'required|exists:units,id',
            'section.product_id' => 'required|exists:products,id',
            'section.date' => 'required|date',
        ]);

        CuttingSection::create($this->section);

        session()->flash('success', 'Cutting section created successfully.');
        $this->reset('section');
    }

    public function render()
    {
        return view('livewire.admin.cutting-sections.create', [
            'units' => $this->units,
            'products' => $this->products,
        ]);
    }
}
