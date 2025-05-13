<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
    public $unit;

    function rules()
    {
        return [
            'unit.name' => "required",
            'unit.symbol' => "required",
        ];
    }

    function mount($id)
    {
        $this->unit = Unit::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->unit->save();
            return redirect()->route('admin.units.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.units.edit');
    }
}
