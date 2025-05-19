<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    // Bind a Brand model instance to the component
    public Brand $brand;

    // Holds the uploaded image file
    public $image;

    // Trait to enable file upload handling
    use WithFileUploads;

    /**
     * Define validation rules for the form inputs.
     *
     * @return array
     */
    function rules()
    {
        return [
            'brand.name' => "required",          // Brand name is required
            'image' => 'nullable|image|max:2048' // Image is optional, must be an image file and max 2MB
        ];
    }

    /**
     * Initialize a new Brand instance when the component mounts.
     */
    function mount()
    {
        $this->brand = new Brand();
    }

    /**
     * Automatically validate inputs when a property is updated.
     */
    function updated()
    {
        $this->validate(); // Re-validate fields on any update
    }

    /**
     * Save the new brand, along with the uploaded image if provided.
     */
    function save()
    {
        $this->validate(); // Validate all inputs

        try {
            // Handle image upload if an image is provided
            if ($this->image) {
                // Generate a slug-based filename for the logo
                $logoName = Str::slug($this->brand->name) . '-logo.' . $this->image->extension();

                // Store the image in the public disk under "brands/logos"
                $this->image->storeAs('brands/logos', $logoName, 'public');

                // Save the image path to the model
                $this->brand->logo_path = "brands/logos/" . $logoName;
            }

            // Save the brand to the database
            $this->brand->save();

            // Redirect to the brand listing page on success
            return redirect()->route('admin.brands.index');
        } catch (\Throwable $th) {
            // Dispatch an error message via Livewire event
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the Livewire view for brand creation.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.brands.create');
    }
}
