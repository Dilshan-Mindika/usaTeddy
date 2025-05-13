<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public Unit $unit;

    function rules()
    {
        return [
            'unit.name' => "required",
            'unit.symbol' => "required",
        ];
    }

    function mount()
    {
        $this->unit = new Unit();
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
        return view('livewire.admin.units.create');
    }
}
