<?php

namespace App\Livewire\Admin\FinishSections;

use App\Models\FinishSection;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public $section = [
        'product_id' => '',
        'quantity' => '',
        'unit_id' => '',
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
            'section.product_id' => 'required|exists:products,id',
            'section.quantity' => 'required|numeric|min:0.01',
            'section.unit_id' => 'required|exists:units,id',
            'section.date' => 'required|date',
        ]);

        FinishSection::create($this->section);

        session()->flash('success', 'Finish Section created successfully.');
        $this->reset('section');
    }

    public function render()
    {
        return view('livewire.admin.finish-sections.create', [
            'products' => $this->products,
            'units' => $this->units,
        ]);
    }
}
