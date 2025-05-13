<?php

namespace App\Livewire\Admin\Purchases;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $supplierSearch;
    public $productSearch;
    public $selectedProductId;
    public $quantity;
    public $price;
    public Purchase $purchase;

    public $productList = [];



    function rules()
    {
        return [
            'purchase.purchase_date' => 'required',
            'purchase.supplier_id' => 'required',
        ];
    }


    function mount()
    {
        $this->purchase = new Purchase();
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


    function selectSupplier($id)
    {
        $this->purchase->supplier_id = $id;
        $this->supplierSearch = $this->purchase->supplier->name;

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

    function makePurchase()
    {

        try {
            $this->validate();
            $this->purchase->save();
            foreach ($this->productList as $key => $listItem) {
                $this->purchase->products()->attach($listItem['product_id'], [
                    'quantity' => $listItem['quantity'],
                    'unit_price' => $listItem['price'],
                ]);
            }

            return redirect()->route('admin.purchases.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view('livewire.admin.purchases.create', [
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }
}
