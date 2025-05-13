<?php

namespace App\Livewire\Admin\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            if (count($supplier->purchases) > 0) {
                throw new \Exception("Error Processing request: This Supplier has bought from you {$supplier->purchases->count()} time(s)", 1);
            }
            $supplier->delete();

            $this->dispatch('done', success: "Successfully Deleted this Supplier");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.suppliers.index', [
            'suppliers' => Supplier::all()
        ]);
    }
}
