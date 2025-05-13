<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Create extends Component
{
    public Bank $bank;

    function rules()
    {
        return [
            'bank.name' => "required",
            'bank.short_name' => "required",
            'bank.sort_code' => "required",
        ];
    }

    function mount()
    {
        $this->bank = new Bank();
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->bank->save();
            return redirect()->route('admin.banks.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.banks.create');
    }
}
