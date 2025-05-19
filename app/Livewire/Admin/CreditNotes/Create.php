<?php

namespace App\Livewire\Admin\CreditNotes;

use App\Models\CreditNote;
use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $creditNote = [
        'product_id' => null,
        'quantity' => null,
        'unit_price' => null,
        'date' => null
    ];
    
    public $products;

    public function mount()
    {
        // Load products from the database
        $this->products = Product::all();
    }

    public function save()
    {
        // Validate inputs
        $this->validate([
            'creditNote.product_id' => 'required',
            'creditNote.quantity' => 'required|numeric|min:0',
            'creditNote.unit_price' => 'required|numeric|min:0',
            'creditNote.date' => 'required|date',
        ]);

        // Save the new Credit Note
        CreditNote::create([
            'product_id' => $this->creditNote['product_id'],
            'quantity' => $this->creditNote['quantity'],
            'unit_price' => $this->creditNote['unit_price'],
            'date' => $this->creditNote['date'],
        ]);

        // Reset the form or give feedback to the user
        session()->flash('message', 'Credit Note created successfully!');
        return redirect()->route('admin.credit-notes.index');
    }

    public function render()
    {
        return view('livewire.admin.credit-notes.index',data:[
        'creditNotes' => CreditNote::all(),
    ]);
    }
}
