<?php

namespace App\Livewire\Admin\DeliveryNotes;

use App\Models\Product;
use App\Models\DeliveryNote;
use Livewire\Component;

class Create extends Component
{
    public $deliveryNote = [
        'route_id' => null,
        'product_id' => null,
        'quantity' => null,
        'unit_price' => null,
        'date' => null,
    ];

    public $products;

    public function mount()
    {
        // Load the products from the database
        $this->products = Product::all();
    }

    public function save()
    {
        // Validate the inputs
        $this->validate([
            'deliveryNote.route_id' => 'required|exists:routes,id',
            'deliveryNote.product_id' => 'required|exists:products,id',
            'deliveryNote.quantity' => 'required|numeric|min:0',
            'deliveryNote.unit_price' => 'required|numeric|min:0',
            'deliveryNote.date' => 'required|date',
        ]);

        // Save the delivery note
        DeliveryNote::create([
            'route_id' => $this->deliveryNote['route_id'],
            'product_id' => $this->deliveryNote['product_id'],
            'quantity' => $this->deliveryNote['quantity'],
            'unit_price' => $this->deliveryNote['unit_price'],
            'date' => $this->deliveryNote['date'],
        ]);

        // Reset the form fields
        $this->deliveryNote = [
            'route_id' => null,
            'product_id' => null,
            'quantity' => null,
            'unit_price' => null,
            'date' => null,
        ];

        session()->flash('message', 'Delivery note created successfully!');

        return redirect()->route('admin.delivery-notes.index');
    }

    public function render()
    {
        return view('livewire.admin.delivery-notes.create');
    }
}
