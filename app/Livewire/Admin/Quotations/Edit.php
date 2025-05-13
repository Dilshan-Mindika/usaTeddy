<?php

namespace App\Livewire\Admin\Quotations;

use App\Models\Client;
use App\Models\Product;
use App\Models\Quotation;
use Livewire\Component;

class Edit extends Component
{
    public $clientSearch;
    public $productSearch;
    public $selectedProductId;
    public $quantity;
    public $price;
    public Quotation $quotation;

    public $productList = [];



    function rules()
    {
        return [
            'quotation.quotation_date' => 'required',
            'quotation.client_id' => 'required',
        ];
    }


    function mount($id)
    {
        $this->quotation = Quotation::find($id);

        foreach ($this->quotation->products as $key => $product) {

            array_push($this->productList, [
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->unit_price,
            ]);
        }
        $this->clientSearch = $this->quotation->client->name;
    }

    function deleteCartItem($key)
    {
        array_splice($this->productList, $key, 1);
    }

    function addQuantity($key)
    {
        $this->productList[$key]['quantity']++;
    }
    function subtractQuantity($key)
    {
        $this->productList[$key]['quantity']--;
    }


    function selectClient($id)
    {
        $this->quotation->client_id = $id;
        $this->clientSearch = $this->quotation->client->name;
    }
    function selectProduct($id)
    {
        $this->selectedProductId = $id;
        $this->productSearch = Product::find($id)->name;
    }
    function addToList()
    {
        try {
            $this->validate([
                'selectedProductId' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]);

            foreach ($this->productList as $key => $listItem) {
                if ($listItem['product_id'] == $this->selectedProductId && $listItem['price'] == $this->price) {
                    $this->productList[$key]['quantity'] += $this->quantity;
                    return;
                }
            }



            array_push($this->productList, [
                'product_id' => $this->selectedProductId,
                'quantity' => $this->quantity,
                'price' => $this->price,
            ]);

            $this->reset([
                'productSearch',
                'selectedProductId',
                'quantity',
                'price',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function makeQuotation()
    {

        try {
            $this->validate();
            $this->quotation->update();
            $this->quotation->products()->detach();
            foreach ($this->productList as $key => $listItem) {
                $this->quotation->products()->attach($listItem['product_id'], [
                    'quantity' => $listItem['quantity'],
                    'unit_price' => $listItem['price'],
                ]);
            }
            return redirect()->route('admin.quotations.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->clientSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view('livewire.admin.quotations.edit', [
            'clients' => $clients,
            'products' => $products,
        ]);
    }
}
