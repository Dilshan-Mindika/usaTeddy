<div>
    <x-slot:header>Purchases</x-slot:header>

    <div class="row justify-content-center">
        <div class="col-md-6 col-4">
            <div class="card">
                <div class="card-header bg-inv-secondary text-inv-primary border-0">
                    <h5>Set Date & Supplier</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="mb-3">
                            <label for="" class="form-label">Date of Purchase</label>
                            <input wire:model='purchase_payment.payment_time' type="datetime-local"
                                class="form-control" />
                            @error('purchase_payment.payment_time')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ref" class="form-label">Transaction Reference</label>
                            <input
                            wire:model='purchase_payment.transaction_reference'
                                type="text"
                                class="form-control"
                                name="ref"
                                id="ref"
                                aria-describedby="ref"
                                placeholder="Enter your transaction reference"
                            />

                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Supplier Search</label>
                            <input type="text" wire:model.live='supplierSearch' class="form-control" />
                            @error('purchase.supplier_id')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <ul class="list-group mt-2 w-100">
                                @if ($supplierSearch != '')
                                    @foreach ($suppliers as $supplier)
                                        <x-supplier-payment-list-item :supplier="$supplier" :purchase_payment="$purchase_payment" />
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Total Amount</label>
                            <div class="input-group">
                                <input wire:model='purchase_payment.amount' type="number" class="form-control" />
                                <button wire:click='takeFullBalance' class="btn btn-outline-secondary">
                                    <i class="bi bi-wallet"></i>
                                </button>
                            </div>
                            @error('purchase_payment.amount')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <hr>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Purchase</label>
                                <select wire:model='selectedPurchaseId' class="form-select" name=""
                                    id="">
                                    @if ($purchase_payment->supplier)
                                        <option value=""></option>
                                        @foreach ($purchase_payment->supplier->purchases as $purchase)
                                            <option value="{{ $purchase->id }}">Purchase #{{ $purchase->id }} <br>
                                                Balance:
                                                KES {{ number_format($purchase->total_balance) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="" class="form-label">Amount to Attach</label>
                            <div class="input-group mb-3">
                                <input wire:model='amount' type="number" class="form-control" />
                                <button wire:click='takeBalance' class="btn btn-outline-secondary">
                                    <i class="bi bi-wallet"></i>
                                </button>
                            </div>
                            @error('amount')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button
                        onclick="confirm('Are you sure you wish to add this Purchase to the list')||event.stopImmediatePropagation()"
                        wire:click='addToList' class="btn btn-dark text-inv-primary">Add To List</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-8">
            <div class="card shadow">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h5 class="text-center text-uppercase">Cart</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supplier</th>
                                <th>Purchase Date</th>
                                <th>Total Amount</th>
                                <th>Amount Allocated</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($purchaseList)
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($purchaseList as $key => $listItem)
                                    <tr>
                                        <td scope="row">
                                            {{ App\Models\Purchase::find($listItem['purchase_id'])->id }}
                                        </td>
                                        <td scope="row">
                                            {{ App\Models\Purchase::find($listItem['purchase_id'])->supplier->name }}
                                        </td>
                                        <td>
                                            {{ Carbon\Carbon::parse(App\Models\Purchase::find($listItem['purchase_id'])->purchase_date)->format('jS F,Y') }}
                                            <br>

                                        </td>
                                        <td>
                                            {{ number_format(App\Models\Purchase::find($listItem['purchase_id'])->total_amount, 2) }}
                                            <br>

                                        </td>
                                        <td>
                                            {{ number_format($listItem['amount'], 2) }}
                                        </td>

                                        <td class="text-center">

                                            <button
                                                onclick="confirm('Are you sure you wish to remove this item from the list')||event.stopImmediatePropagation()"
                                                wire:click='deleteListItem({{ $key }})'
                                                class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @php
                                        $total += $listItem['amount'];
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2" style="font-size: 18px">
                                        <strong>TOTAL</strong>
                                    </td>
                                    <td></td>
                                    <td style="font-size: 18px">
                                        <strong>KES {{ number_format($total, 2) }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button
                        onclick="confirm('Are you sure you wish to make the payment')||event.stopImmediatePropagation()"
                        wire:click='savePayment' class="btn btn-dark text-inv-primary w-100">Save Payment</button>

                </div>
            </div>
        </div>
    </div>
</div>
