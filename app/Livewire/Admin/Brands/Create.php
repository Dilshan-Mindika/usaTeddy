<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    public Brand $brand;
    public $image;

    use WithFileUploads;

    function rules()
    {
        return [
            'brand.name' => "required",
            'image' => 'nullable|image|max:2048'
        ];
    }

    function mount()
    {
        $this->brand = new Brand();
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {

            if ($this->image) {
                $logoName = Str::slug($this->brand->name) . '-logo.' . $this->image->extension();

                $this->image->storeAs('brands/logos', $logoName, 'public');

                $this->brand->logo_path = "brands/logos/" . $logoName;
            }



            $this->brand->save();
            return redirect()->route('admin.brands.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.brands.create');
    }
}
