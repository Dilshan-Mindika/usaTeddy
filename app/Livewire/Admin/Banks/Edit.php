<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Edit extends Component
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

    function mount($id)
    {
        $this->bank = Bank::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->bank->update();
            return redirect()->route('admin.banks.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.banks.edit');
    }
}
