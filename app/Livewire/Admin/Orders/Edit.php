<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Edit extends Component
{
    public $supplierSearch;
    public $productSearch;
    public $selectedProductId;
    public $quantity;
    public $price;
    public Order $order;

    public $productList = [];



    function rules()
    {
        return [
            'order.order_date' => 'required',
            'order.supplier_id' => 'required',
        ];
    }


    function mount($id)
    {
        $this->order = Order::find($id);

        foreach ($this->order->products as $key => $product) {

            array_push($this->productList, [
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->unit_price,
            ]);
        }
        $this->supplierSearch = $this->order->supplier->name;
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
        $this->order->supplier_id = $id;
        $this->supplierSearch = $this->order->supplier->name;
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

    function makeOrder()
    {

        try {
            $this->validate();
            $this->order->update();
            $this->order->products()->detach();
            foreach ($this->productList as $key => $listItem) {
                $this->order->products()->attach($listItem['product_id'], [
                    'quantity' => $listItem['quantity'],
                    'unit_price' => $listItem['price'],
                ]);
            }
            return redirect()->route('admin.orders.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->supplierSearch . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->productSearch . '%')->get();

        return view('livewire.admin.orders.edit', [
            'suppliers' => $suppliers,
            'products' => $products,
        ]);
    }
}
