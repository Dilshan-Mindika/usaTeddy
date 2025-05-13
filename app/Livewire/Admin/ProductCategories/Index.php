<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            if (count($category->products) > 0) {
                throw new \Exception("Error Processing request: This Category has {$category->products->count()} products(s)", 1);
            }
            $category->delete();

            $this->dispatch('done', success: "Successfully Deleted this Category");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.product-categories.index', [
            'productCategories' => ProductCategory::all()
        ]);
    }
}
