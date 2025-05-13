<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
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

    function mount()
    {
        $this->product = new Product();
    }
    function updated()
    {
        $this->validate();
    }

    function save()
    {
        try {
            $this->validate();

            $this->product->save();

            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.products.create', [
            'productCategories' => ProductCategory::all(),
            'units' => Unit::all(),
            'brands' => Brand::all()
        ]);
    }
}
