<div>
    <x-slot:header>Invoices</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary binvoice-0">
            <h5>Invoice Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Invoice Date</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td scope="row">{{ $invoice->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($invoice->invoice_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>
                                {{ $invoice->client->name }}
                            </td>
                            <td>
                                <small>RS {{ number_format($invoice->total_amount, 2) }}</small>
                            </td>
                            {{-- <td>
                                <span class="{{ $invoice->is_paid ? 'text-success' : 'text-danger' }}"
                                    style="font: bold">
                                    {{ $invoice->is_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td> --}}
                            <td class="text-center">
                                <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a target="_blank" href="{{ route('admin.invoice-download', $invoice->id) }}" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Invoice?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $invoice->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
