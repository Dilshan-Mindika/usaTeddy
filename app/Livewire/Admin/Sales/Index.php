<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Sale;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $sale = Sale::findOrFail($id);
            if ($sale->is_paid) {
                throw new \Exception("Error Processing request: This Sale has already been paid for", 1);
            }

            $sale->products()->detach();
            $sale->delete();

            $this->dispatch('done', success: "Successfully Deleted this Sale");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.sales.index', [
            'sales'=>Sale::all()
        ]);
    }
}
