<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;

class Index extends Component
{
    /**
     * Delete a brand by its ID.
     * Prevent deletion if the brand has associated products.
     *
     * @param int $id
     */
    function delete($id)
    {
        try {
            // Attempt to find the brand or throw 404 if not found
            $brand = Brand::findOrFail($id);

            // Prevent deletion if the brand has related products
            if ($brand->products->count() > 0) {
                throw new \Exception(
                    "Error Processing request: This Brand has {$brand->products->count()} product(s)",
                    1
                );
            }

            // Delete the brand
            $brand->delete();

            // Dispatch a Livewire event indicating successful deletion
            $this->dispatch('done', success: "Successfully Deleted this Brand");
        } catch (\Throwable $th) {
            // Catch and handle any errors by dispatching an error event
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the brand listing view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.brands.index', [
            'brands' => Brand::all(), // Fetch all brands from the database
        ]);
    }
}
