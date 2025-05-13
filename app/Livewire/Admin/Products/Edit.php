<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public Product $product;

    function rules()
    {
        return [
            'product.name' => 'required',
            'product.brand_id' => 'required',
            'product.description' => 'required',
            'product.unit_id' => 'required',
            'product.product_category_id' => 'required',
            'product.quantity' => 'required',
            'product.purchase_price' => 'required',
            'product.sale_price' => 'required',
        ];
    }

    function mount($id)
    {
        $this->product = Product::find($id);
    }
    // function updated()
    // {
    //     // $this->validate();
    // }

    function save()
    {
        // return redirect()->route('admin.products.index');
        try {
            // $this->validate();

            $this->product->update();

            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.products.edit', [
            'productCategories' => ProductCategory::all(),
            'units' => Unit::all(),
            'brands' => Brand::all()
        ]);
    }
}
