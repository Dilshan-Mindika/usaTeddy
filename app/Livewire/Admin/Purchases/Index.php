<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Purchase;
use Livewire\Component;

class Index extends Component
{

    function delete($id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            if ($purchase->is_paid) {
                throw new \Exception("Error Processing request: This Purchase has already been paid for", 1);
            }

            $purchase->products()->detach();
            $purchase->delete();

            $this->dispatch('done', success: "Successfully Deleted this Purchase");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.purchases.index', [
            'purchases' => Purchase::all()
        ]);
    }
}
