<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public $section;
    public $units;
    public $products;

    /**
     * Mount the component, load the cutting section to edit, and the list of units/products.
     *
     * @param int $id
     */
    public function mount($id)
    {
        // Load the cutting section to edit
        $this->section = CuttingSection::findOrFail($id);

        // Load all units and products to populate dropdowns
        $this->units = Unit::all();
        $this->products = Product::all();
    }

    /**
     * Validation and saving the updated cutting section.
     */
    public function save()
    {
        // Validate the input data
        $this->validate([
            'section.name' => 'required|string|max:255',
            'section.quantity' => 'required|numeric|min:0.01',
            'section.unit_id' => 'required|exists:units,id',
            'section.product_id' => 'required|exists:products,id',
            'section.date' => 'required|date',
        ]);

        // Update the cutting section
        $this->section->save();

        // Provide success feedback to the user
        session()->flash('success', 'Cutting section updated successfully.');

        // Optionally redirect to another page
        return redirect()->route('admin.cutting-sections.index');
    }

    /**
     * Render the view for editing the cutting section.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.cutting-sections.edit', [
            'units' => $this->units,    // Pass available units to the view
            'products' => $this->products,  // Pass available products to the view
        ]);
    }
}
