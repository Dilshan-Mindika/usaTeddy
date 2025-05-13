<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            if ($invoice->is_paid) {
                throw new \Exception("Error Processing request: This Invoice has already been paid for", 1);
            }

            $invoice->products()->detach();
            $invoice->delete();

            $this->dispatch('done', success: "Successfully Deleted this Invoice");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.invoices.index', [
            'invoices' => Invoice::all()
        ]);
    }
}
