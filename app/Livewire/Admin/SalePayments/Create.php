<?php

namespace App\Livewire\Admin\SalePayments;

use App\Models\Sale;
use App\Models\SalesPayment;
use App\Models\Client;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
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

    function mount()
    {
        $this->sale_payment = new SalesPayment();
        $this->sale_payment->payment_time = Carbon::now()->toDateTimeLocalString();
    }

    function addToList()
    {
        try {
            $this->validate([
                'selectedSaleId' => 'required',
                'amount' => 'required',
            ]);


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
            $this->validate();
            $this->sale_payment->save();

            foreach ($this->saleList as $key => $listItem) {
                $this->sale_payment->sales()->attach($listItem['sale_id'], [
                    'amount' => $listItem['amount'],
                ]);
            }
            return redirect()->route('admin.sale-payments.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->clientSearch . '%')->get();
        return view('livewire.admin.sale-payments.create', [
            'clients' => $clients
        ]);
    }
}
