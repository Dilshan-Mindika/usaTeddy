<?php

namespace App\Livewire\Admin\PurchasePayments;

use App\Models\Purchase;
use App\Models\PurchasePayment;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $supplierSearch;
    public $selectedPurchaseId;
    public $amount;
    public PurchasePayment $purchase_payment;

    public $purchaseList = [];

    function rules()
    {
        return [
            'purchase_payment.supplier_id' => 'required',
            'purchase_payment.transaction_reference' => 'required',
            'purchase_payment.payment_time' => 'required',
            'purchase_payment.amount' => 'required',
        ];
    }

    function selectSupplier($id)
    {
        $this->purchase_payment->supplier_id = $id;
        $this->supplierSearch = $this->purchase_payment->supplier->name;
    }

    function takeBalance()
    {
        if ($this->selectedPurchaseId) {
            $this->amount = Purchase::find($this->selectedPurchaseId)->total_balance;
            foreach ($this->purchaseList as $key => $listItem) {
                if ($listItem['purchase_id'] == $this->selectedPurchaseId) {
                    $this->amount = Purchase::find($listItem['purchase_id'])->total_balance - $listItem['amount'];
                }
            }
        }
    }
    function takeFullBalance()
    {
        $total = 0;
        foreach ($this->purchaseList as $key => $item) {
            $total += $item['amount'];
        }
        $this->purchase_payment->amount = $total;
    }

    function mount($id)
    {
        $this->purchase_payment = PurchasePayment::findOrFail(id: $id);
        foreach ($this->purchase_payment->purchases as $key => $purchase) {

            array_push($this->purchaseList, [
                'purchase_id' => $purchase->id,
                'amount' => $purchase->pivot->amount,
            ]);
        }
        $this->supplierSearch = $this->purchase_payment->supplier->name;
    }

    function addToList()
    {
        try {
            if (Purchase::find($this->selectedPurchaseId)->total_balance < $this->amount) {
                throw new \Exception("Total Balance is Low", 1);
            }
            foreach ($this->purchaseList as $key => $listItem) {
                $newBalance = Purchase::find($listItem['purchase_id'])->total_balance - $listItem['amount'];
                if ($listItem['purchase_id'] == $this->selectedPurchaseId && $newBalance < $this->amount) {
                    throw new \Exception("Total Balance is Low", 1);
                }
            }
            foreach ($this->purchaseList as $key => $listItem) {
                if ($listItem['purchase_id'] == $this->selectedPurchaseId) {
                    $this->purchaseList[$key]['amount'] += $this->amount;
                    return;
                }
            }



            array_push($this->purchaseList, [
                'purchase_id' => $this->selectedPurchaseId,
                'amount' => $this->amount,
            ]);

            $this->reset([
                'selectedPurchaseId',
                'amount',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function deleteListItem($key)
    {
        array_splice($this->purchaseList, $key, 1);
    }



    function savePayment()
    {
        try {
            // $this->validate([
            //     'purchase_payment.supplier_id' => 'required',
            //     'purchase_payment.transaction_reference' => 'required',
            //     'purchase_payment.payment_time' => 'required',
            //     'purchase_payment.amount' => 'required',
            // ]);
            foreach ($this->purchaseList as $key => $listItem) {
                if (!in_array($listItem['purchase_id'], Supplier::find($this->purchase_payment->supplier_id)->purchases()->pluck('id')->toArray())) {
                    throw new \Exception("This Supplier doesn't have all these purchases", 1);
                }
            }
            $this->purchase_payment->save();

            $syncData = [];
            foreach ($this->purchaseList as $listItem) {
                $syncData[$listItem['purchase_id']] = ['amount' => $listItem['amount']];
            }
            $this->purchase_payment->purchases()->sync($syncData);
            return redirect()->route('admin.purchase-payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        return view('livewire.admin.purchase-payments.edit', [
            'suppliers' => $suppliers
        ]);
    }
}
