<?php

namespace App\Livewire\Admin\PurchasePayments;

use App\Models\PurchasePayment;
use Livewire\Component;

class Index extends Component
{

    function delete($id)
    {
        try {
            $purchase_payment = PurchasePayment::findOrFail($id);
            $purchase_payment->purchases()->detach();
            $purchase_payment->delete();

            $this->dispatch('done', success: "Successfully Deleted this Purchase Payment");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.purchase-payments.index', [
            'purchase_payments' => PurchasePayment::all()
        ]);
    }
}
