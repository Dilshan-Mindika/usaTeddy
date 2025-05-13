<div>
    <x-slot:header>Purchases</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Purchase Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>No. of Units Bought</th>
                        <th>Total Amount</th>
                        <th>Total Paid</th>
                        <th>Total Balance</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td scope="row">{{ $purchase->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($purchase->purchase_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>
                                {{ $purchase->supplier->name }}
                            </td>
                            <td>
                                <small> {{ number_format($purchase->total_quantity) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($purchase->total_amount, 2) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($purchase->total_paid, 2) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($purchase->total_balance, 2) }}</small>
                            </td>
                            <td>
                                <span class="{{ $purchase->is_paid ? 'text-success' : 'text-danger' }}"
                                    style="font: bold">
                                    {{ $purchase->is_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.purchases.edit', $purchase->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Purchase?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $purchase->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>TOTALS</strong></td>
                        <td></td>
                        <td></td>
                        <td>
                            <strong>
                                {{ number_format(
                                    $purchases->sum(function ($purchase) {
                                        return $purchase->total_quantity;
                                    }),
                                ) }}
                            </strong>
                        </td>
                        <td>
                            <strong>
                                RS
                                {{ number_format(
                                    $purchases->sum(function ($purchase) {
                                        return $purchase->total_amount;
                                    }),
                                ) }}
                            </strong>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
