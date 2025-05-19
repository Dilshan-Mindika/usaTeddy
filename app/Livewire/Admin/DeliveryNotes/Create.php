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
            'deliveryNote.route_id' => 'required|exists:routes,id',  // Ensure that the routes table exists and has a column named 'id'
            'deliveryNote.product_id' => 'required|exists:products,id',
            'deliveryNote.quantity' => 'required|numeric|min:0',
            'deliveryNote.unit_price' => 'required|numeric|min:0',
            'deliveryNote.date' => 'required|date',
        ]);

        try {
            // Save the delivery note
            DeliveryNote::create([
                'route_id' => $this->deliveryNote['route_id'],
                'product_id' => $this->deliveryNote['product_id'],
                'quantity' => $this->deliveryNote['quantity'],
                'unit_price' => $this->deliveryNote['unit_price'],
                'date' => $this->deliveryNote['date'],
            ]);

            // Reset form fields
            $this->reset('deliveryNote'); // Resets the entire deliveryNote array

            // Provide feedback to the user
            session()->flash('message', 'Delivery note created successfully!');
            
            // Redirect to the index page
            return redirect()->route('admin.delivery-notes.index');
        } catch (\Throwable $th) {
            // Handle any unexpected errors
            session()->flash('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.delivery-notes.create');
    }
}
