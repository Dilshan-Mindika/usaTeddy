<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            if (count($product->purchases) > 0 || count($product->sales) > 0) {
                throw new \Exception("Error Processing request: This Product has been bought and/or sold in the system", 1);
            }
            $product->delete();

            $this->dispatch('done', success: "Successfully Deleted this Product");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    use WithPagination;
    public function render()
    {
        return view('livewire.admin.products.index', [
            'products' => Product::orderBy('id', 'DESC')->paginate(5)
        ]);
    }
}
