<?php

namespace App\Livewire\Admin\CreditNotes;

use App\Models\CreditNote;
use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    // Holds form input for creating a credit note
    public $creditNote = [
        'product_id' => null,
        'quantity' => null,
        'unit_price' => null,
        'date' => null,
    ];

    // Stores product options for the dropdown
    public $products;

    /**
     * Initialize component and load required data (products).
     */
    public function mount()
    {
        $this->products = Product::all(); // Load all products for selection
    }

    /**
     * Validate and store the new credit note.
     */
    public function save()
    {
        // Validate credit note input fields
        $this->validate([
            'creditNote.product_id' => 'required|exists:products,id', // Ensure the product exists
            'creditNote.quantity' => 'required|numeric|min:0',        // Quantity must be numeric and non-negative
            'creditNote.unit_price' => 'required|numeric|min:0',      // Unit price must be numeric and non-negative
            'creditNote.date' => 'required|date',                     // Must be a valid date
        ]);

        // Create the credit note in the database
        CreditNote::create([
            'product_id' => $this->creditNote['product_id'],
            'quantity' => $this->creditNote['quantity'],
            'unit_price' => $this->creditNote['unit_price'],
            'date' => $this->creditNote['date'],
        ]);

        // Optionally reset form and provide feedback
        session()->flash('message', 'Credit Note created successfully!');
        return redirect()->route('admin.credit-notes.index');
    }

    /**
     * Render the form view for creating a credit note.
     *
     * NOTE: This currently renders the `index` view, which may be incorrect for a "create" form.
     */
    public function render()
    {
        return view('livewire.admin.credit-notes.create', [ // ← corrected from `index` to `create`
            'products' => $this->products, // Pass products to the view
        ]);
    }
}
