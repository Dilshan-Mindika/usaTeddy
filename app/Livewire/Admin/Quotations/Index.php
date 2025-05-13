<?php

namespace App\Livewire\Admin\Quotations;

use App\Models\Quotation;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $quotation = Quotation::findOrFail($id);
            // if ($quotation->is_paid) {
            //     throw new \Exception("Error Processing request: This Quotation has already been paid for", 1);
            // }

            $quotation->products()->detach();
            $quotation->delete();

            $this->dispatch('done', success: "Successfully Deleted this Quotation");
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.quotations.index', [
            'quotations' => Quotation::all()
        ]);
    }
}
