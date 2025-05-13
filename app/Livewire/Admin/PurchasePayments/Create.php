<?php

namespace App\Livewire\Admin\PurchasePayments;

use App\Models\Purchase;
use App\Models\PurchasePayment;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
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

    function mount()
    {
        $this->purchase_payment = new PurchasePayment();
        $this->purchase_payment->payment_time = Carbon::now()->toDateTimeLocalString();
    }

    function addToList()
    {
        try {
            $this->validate([
                'selectedPurchaseId' => 'required',
                'amount' => 'required',
            ]);


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
            $this->validate();
            $this->purchase_payment->save();

            foreach ($this->purchaseList as $key => $listItem) {
                $this->purchase_payment->purchases()->attach($listItem['purchase_id'], [
                    'amount' => $listItem['amount'],
                ]);
            }
            return redirect()->route('admin.purchase-payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        return view('livewire.admin.purchase-payments.create', [
            'suppliers' => $suppliers
        ]);
    }
}
