<?php

namespace App\Livewire\Admin\HalfFinishSections;

use App\Models\HalfFinishSection;
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
            'section.quantity' => 'required|numeric|min:0',
            'section.unit_id' => 'required|exists:units,id',
            'section.product_id' => 'required|exists:products,id',
            'section.date' => 'required|date',
        ]);

        HalfFinishSection::create($this->section);

        session()->flash('success', 'Half Finish Section created successfully.');
        $this->reset('section');
    }

    public function render()
    {
        return view('livewire.admin.half-finish-sections.create', [
            'units' => $this->units,
            'products' => $this->products
        ]);
    }
}
