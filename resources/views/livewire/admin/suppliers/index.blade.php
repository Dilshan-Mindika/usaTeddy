<div>
    <x-slot:header>Suppliers</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Suppliers' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Basic Details</th>
                        <th>Address</th>
                        <th>Business Details</th>
                        <th>Account Details</th>
                        <th>Purchases Made</th>
                        <th>Total Purchase Value</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td scope="row">{{ $supplier->id }}</td>
                            <td>
                                <h6>{{ $supplier->name }}</h6>
                                <small>{{ $supplier->email }}</small><br>
                                <small>{{ $supplier->phone_number }}</small>
                            </td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                
                                <small><strong>Reg No:</strong> {{ $supplier->registration_number ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <small><strong>Bank:</strong> {{ $supplier->bank->name }}</small><br>
                                <small><strong>A/c No:</strong> {{ $supplier->account_number }}</small>
                            </td>
                            <td>
                                {{ $supplier->purchases->count() }}
                            </td>
                            <td>
                                <small>RS
                                </small>{{ number_format(
                                    $supplier->purchases->sum(function ($sale) {
                                        return $sale->total_amount;
                                    }),
                                ) }}
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Supplier?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $supplier->id }})'>
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
