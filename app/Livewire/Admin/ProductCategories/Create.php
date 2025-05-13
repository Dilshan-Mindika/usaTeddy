<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Component;

class Create extends Component
{
    public ProductCategory $category;

    function rules()
    {
        return [
            'category.name' => "required",
        ];
    }

    function mount()
    {
        $this->category = new ProductCategory();
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->category->save();
            return redirect()->route('admin.product-categories.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.product-categories.create');
    }
}
