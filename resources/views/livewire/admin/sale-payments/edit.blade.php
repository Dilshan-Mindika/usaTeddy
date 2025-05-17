<div>
    <x-slot:header>Sales</x-slot:header>

    <div class="row justify-content-center">
        <div class="col-md-6 col-4">
            <div class="card">
                <div class="card-header bg-inv-secondary text-inv-primary border-0">
                    <h5>Set Date & Customer</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="mb-3">
                            <label for="" class="form-label">Date of Sale</label>
                            <input wire:model='sale_payment.payment_time' type="datetime-local"
                                class="form-control" />
                            @error('sale_payment.payment_time')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ref" class="form-label">Transaction Reference</label>
                            <input
                            wire:model='sale_payment.transaction_reference'
                                type="text"
                                class="form-control"
                                name="ref"
                                id="ref"
                                aria-describedby="ref"
                                placeholder="Enter your transaction reference"
                            />

                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Customer Search</label>
                            <input type="text" wire:model.live='clientSearch' class="form-control" />
                            @error('sale.client_id')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <ul class="list-group mt-2 w-100">
                                @if ($clientSearch != '')
                                    @foreach ($clients as $client)
                                        <x-client-payment-list-item :client="$client" :sale_payment="$sale_payment" />
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Total Amount</label>
                            <div class="input-group">
                                <input wire:model='sale_payment.amount' type="number" class="form-control" />
                                <button wire:click='takeFullBalance' class="btn btn-outline-secondary">
                                    <i class="bi bi-wallet"></i>
                                </button>
                            </div>
                            @error('sale_payment.amount')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <hr>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Sale</label>
                                <select wire:model='selectedSaleId' class="form-select" name=""
                                    id="">
                                    @if ($sale_payment->client)
                                        <option value=""></option>
                                        @foreach ($sale_payment->client->sales as $sale)
                                            <option value="{{ $sale->id }}">Sale #{{ $sale->id }} <br>
                                                Balance:
                                                RS {{ number_format($sale->total_balance) }}</option>
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
                        onclick="confirm('Are you sure you wish to add this Sale to the list')||event.stopImmediatePropagation()"
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
                                <th>Customer</th>
                                <th>Sale Date</th>
                                <th>Total Amount</th>
                                <th>Amount Allocated</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($saleList)
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($saleList as $key => $listItem)
                                    <tr>
                                        <td scope="row">
                                            {{ App\Models\Sale::find($listItem['sale_id'])->id }}
                                        </td>
                                        <td scope="row">
                                            {{ App\Models\Sale::find($listItem['sale_id'])->client->name }}
                                        </td>
                                        <td>
                                            {{ Carbon\Carbon::parse(App\Models\Sale::find($listItem['sale_id'])->sale_date)->format('jS F,Y') }}
                                            <br>

                                        </td>
                                        <td>
                                            {{ number_format(App\Models\Sale::find($listItem['sale_id'])->total_amount, 2) }}
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
                                        <strong>Total</strong>
                                    </td>
                                    <td></td>
                                    <td style="font-size: 18px">
                                        <strong>RS {{ number_format($total, 2) }}</strong>
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
