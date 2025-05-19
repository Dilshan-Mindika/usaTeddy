<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    // Bind the Brand model to the component
    public Brand $brand;

    // Holds the uploaded image file
    public $image;

    // Enable file uploads in Livewire
    use WithFileUploads;

    /**
     * Define validation rules.
     *
     * @return array
     */
    function rules()
    {
        return [
            'brand.name' => "required", // Brand name is required
        ];
    }

    /**
     * Load the brand model by ID when the component is initialized.
     *
     * @param int $id - The ID of the brand to be edited
     */
    function mount($id)
    {
        $this->brand = Brand::findOrFail($id); // Fail with 404 if not found
    }

    /**
     * Automatically validate properties on update.
     */
    function updated()
    {
        $this->validate(); // Validate fields on change
    }

    /**
     * Save the updated brand details, including the logo if a new one is uploaded.
     */
    function save()
    {
        $this->validate(); // Ensure fields are valid before saving

        try {
            // If a new image is uploaded, handle replacement
            if ($this->image) {
                // Delete the old logo if it exists
                if ($this->brand->logo_path && file_exists(public_path('storage/' . $this->brand->logo_path))) {
                    unlink(public_path('storage/' . $this->brand->logo_path));
                }

                // Create a slug-based logo name
                $logoName = Str::slug($this->brand->name) . '-logo.' . $this->image->extension();

                // Store the new image in 'brands/logos' directory (in public disk)
                $this->image->storeAs('brands/logos', $logoName, 'public');

                // Update the brand's logo path
                $this->brand->logo_path = "brands/logos/" . $logoName;
            }

            // Save changes to the database
            $this->brand->update();

            // Redirect to the brand index page
            return redirect()->route('admin.brands.index');
        } catch (\Throwable $th) {
            // Handle any errors and notify the frontend via Livewire event
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the edit brand view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.brands.edit');
    }
}
