<div>
    <x-slot:header>Delivery Notes</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Delivery Notes Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveryNotes as $deliveryNote)
                        <tr>
                            <td scope="row">{{ $deliveryNote->delivery_note_id }}</td>
                            <td>{{ $deliveryNote->product->name ?? 'N/A' }}</td>
                            <td>{{ $deliveryNote->quantity }}</td>
                            <td>Rs {{ number_format($deliveryNote->unit_price, 2) }}</td>
                            <td>Rs {{ number_format($deliveryNote->quantity * $deliveryNote->unit_price, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.delivery-note-products.edit', [$deliveryNote->delivery_note_id, $deliveryNote->product_id]) }}"
                                    class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button onclick="return confirm('Are you sure you wish to DELETE this delivery note?') || event.stopImmediatePropagation()" 
                                    class="btn btn-danger btn-sm"
                                    wire:click='delete({{ $deliveryNote->delivery_note_id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-3">
                {!! $paginationLinks !!}
            </div>
        </div>
    </div>
</div>
