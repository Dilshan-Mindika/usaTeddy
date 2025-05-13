<div>
    <x-slot:header>Sales</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Sale Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Sale Date</th>
                        <th>Customer</th>
                        <th>No. of Units Sold</th>
                        <th>Total Amount</th>
                        <th>Total Paid</th>
                        <th>Total Balance</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td scope="row">{{ $sale->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($sale->sale_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>
                                {{ $sale->client->name }}
                            </td>
                            <td>
                                <small>{{ number_format($sale->total_quantity) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($sale->total_amount, 2) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($sale->total_paid, 2) }}</small>
                            </td>
                            <td>
                                <small>RS {{ number_format($sale->total_balance, 2) }}</small>
                            </td>
                            <td>
                                <span class="{{ $sale->is_paid ? 'text-success' : 'text-danger' }}" style="font: bold">
                                    {{ $sale->is_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.sales.edit', $sale->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Sale?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $sale->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td></td>
                        <td>
                            <strong>
                                {{ number_format(
                                    $sales->sum(function ($sale) {
                                        return $sale->total_quantity;
                                    }),
                                ) }}
                            </strong>
                        </td>
                        <td>
                            <strong>
                                RS
                                {{ number_format(
                                    $sales->sum(function ($sale) {
                                        return $sale->total_amount;
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
