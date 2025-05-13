<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            if (count($bank->clients) > 0 || count($bank->suppliers) > 0) {
                throw new \Exception("Error Processing request: This Bank has {$bank->clients->count()} clients(s) & {$bank->suppliers->count()} suppliers(s)", 1);
            }
            $bank->delete();

            $this->dispatch('done', success: "Successfully Deleted this Bank");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.banks.index', [
            'banks'=>Bank::all()
        ]);
    }
}
