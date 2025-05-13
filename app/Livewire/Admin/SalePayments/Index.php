<?php

namespace App\Livewire\Admin\SalePayments;

use App\Models\SalesPayment;
use Livewire\Component;

class Index extends Component
{

    function delete($id)
    {
        try {
            $sale_payment = SalesPayment::findOrFail($id);
            $sale_payment->sales()->detach();
            $sale_payment->delete();

            $this->dispatch('done', success: "Successfully Deleted this Sale Payment");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.sale-payments.index', [
            'sales_payments' => SalesPayment::all()
        ]);
    }
}
