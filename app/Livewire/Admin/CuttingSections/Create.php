<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    // Holds form input for creating a cutting section
    public $section = [
        'name' => '',
        'quantity' => '',
        'unit_id' => '',
        'product_id' => '',
        'date' => '',
    ];

    // Stores all units and products to populate dropdowns
    public $units;
    public $products;

    /**
     * Initialize component and load required data (units and products).
     */
    public function mount()
    {
        // Load all units and products from the database
        $this->units = Unit::all();  // Fetch all available units
        $this->products = Product::all();  // Fetch all available products
    }

    /**
     * Validate and store the new cutting section in the database.
     */
    public function save()
    {
        // Validate form input fields before saving
        $this->validate([
            'section.name' => 'required|string|max:255',            // Ensure name is required, a string, and not too long
            'section.quantity' => 'required|numeric|min:0.01',      // Quantity must be numeric and greater than zero
            'section.unit_id' => 'required|exists:units,id',        // Ensure selected unit exists in the database
            'section.product_id' => 'required|exists:products,id',  // Ensure selected product exists in the database
            'section.date' => 'required|date',                      // Ensure date is valid
        ]);

        // Create the new cutting section
        CuttingSection::create($this->section);

        // Provide success feedback to the user and reset the form
        session()->flash('success', 'Cutting section created successfully.');
        $this->reset('section'); // Clear the form fields after saving
    }

    /**
     * Render the view for creating a cutting section.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.cutting-sections.create', [
            'units' => $this->units,    // Pass units to the view for selection
            'products' => $this->products,  // Pass products to the view for selection
        ]);
    }
}
