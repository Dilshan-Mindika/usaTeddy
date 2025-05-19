<?php

namespace App\Livewire\Admin\DeliveryNotes;

use App\Models\DeliveryNote;
use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    public $deliveryNote;  // This will hold the delivery note we're editing
    public $products;      // This will hold the list of available products

    public function mount($id)
    {
        // Fetch the DeliveryNote by its ID
        $this->deliveryNote = DeliveryNote::findOrFail($id);
        
        // Load all available products for the dropdown
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

        try {
            // Update the delivery note
            $this->deliveryNote->save();

            session()->flash('message', 'Delivery note updated successfully!');
            return redirect()->route('admin.delivery-notes.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.delivery-notes.edit');
    }
}
