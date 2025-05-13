<div>
    <x-slot:header>Quotations</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary bquotation-0">
            <h5>Quotation Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Quotation Date</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td scope="row">{{ $quotation->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($quotation->quotation_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>
                                {{ $quotation->client->name }}
                            </td>
                            <td>
                                <small>RS {{ number_format($quotation->total_amount, 2) }}</small>
                            </td>
                            {{-- <td>
                                <span class="{{ $quotation->is_paid ? 'text-success' : 'text-danger' }}"
                                    style="font: bold">
                                    {{ $quotation->is_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td> --}}
                            <td class="text-center">
                                <a href="{{ route('admin.quotations.edit', $quotation->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a target="_blank" href="{{ route('admin.quotation-download', $quotation->id) }}" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Quotation?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $quotation->id }})'>
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
