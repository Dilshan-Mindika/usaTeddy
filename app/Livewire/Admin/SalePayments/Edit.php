<?php

namespace App\Livewire\Admin\SalePayments;

use App\Models\Sale;
use App\Models\SalesPayment;
use App\Models\Client;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public $clientSearch;
    public $selectedSaleId;
    public $amount;
    public SalesPayment $sale_payment;

    public $saleList = [];

    function rules()
    {
        return [
            'sale_payment.client_id' => 'required',
            'sale_payment.transaction_reference' => 'required',
            'sale_payment.payment_time' => 'required',
            'sale_payment.amount' => 'required',
        ];
    }

    function selectClient($id)
    {
        $this->sale_payment->client_id = $id;
        $this->clientSearch = $this->sale_payment->client->name;

    }

    function takeBalance()
    {
        if ($this->selectedSaleId) {
            $this->amount = Sale::find($this->selectedSaleId)->total_balance;
            foreach ($this->saleList as $key => $listItem) {
                if ($listItem['sale_id'] == $this->selectedSaleId) {
                    $this->amount = Sale::find($listItem['sale_id'])->total_balance - $listItem['amount'];
                }
            }
        }
    }
    function takeFullBalance()
    {
        $total = 0;
        foreach ($this->saleList as $key => $item) {
            $total += $item['amount'];
        }
        $this->sale_payment->amount = $total;
    }

    function mount($id)
    {
        $this->sale_payment = SalesPayment::find( $id);
        foreach ($this->sale_payment->sales as $key => $sale) {

            array_push($this->saleList, [
                'sale_id' => $sale->id,
                'amount' => $sale->pivot->amount,
            ]);
        }
        $this->clientSearch = $this->sale_payment->client->name;
    }

    function addToList()
    {
        try {
            if (Sale::find($this->selectedSaleId)->total_balance < $this->amount) {
                throw new \Exception("Total Balance is Low", 1);
            }
            foreach ($this->saleList as $key => $listItem) {
                $newBalance = Sale::find($listItem['sale_id'])->total_balance - $listItem['amount'];
                if ($listItem['sale_id'] == $this->selectedSaleId && $newBalance < $this->amount) {
                    throw new \Exception("Total Balance is Low", 1);
                }
            }
            foreach ($this->saleList as $key => $listItem) {
                if ($listItem['sale_id'] == $this->selectedSaleId) {
                    $this->saleList[$key]['amount'] += $this->amount;
                    return;
                }
            }



            array_push($this->saleList, [
                'sale_id' => $this->selectedSaleId,
                'amount' => $this->amount,
            ]);

            $this->reset([
                'selectedSaleId',
                'amount',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function deleteListItem($key)
    {
        array_splice($this->saleList, $key, 1);
    }



    function savePayment()
    {
        try {
            // $this->validate([
            //     'sale_payment.client_id' => 'required',
            //     'sale_payment.transaction_reference' => 'required',
            //     'sale_payment.payment_time' => 'required',
            //     'sale_payment.amount' => 'required',
            // ]);
            foreach ($this->saleList as $key => $listItem) {
                if (!in_array($listItem['sale_id'], Client::find($this->sale_payment->client_id)->sales()->pluck('id')->toArray())) {
                    throw new \Exception("This Client doesn't have all these sales", 1);
                }
            }
            $this->sale_payment->save();

            $syncData = [];
            foreach ($this->saleList as $listItem) {
                $syncData[$listItem['sale_id']] = ['amount' => $listItem['amount']];
            }
            $this->sale_payment->sales()->sync($syncData);
            return redirect()->route('admin.sale-payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->clientSearch . '%')->get();
        return view('livewire.admin.sale-payments.edit', [
            'clients' => $clients
        ]);
    }
}
