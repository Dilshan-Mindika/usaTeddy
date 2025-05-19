<div>
    <x-slot:header>Delivery Note Products</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Delivery Note Product List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>Delivery Note ID</th>
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
                            <td>{{ $item->delivery_note_id }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs {{ number_format($item->unit_price, 2) }}</td>
                            <td>Rs {{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.delivery-note-products.edit', [$item->delivery_note_id, $item->product_id]) }}"
                                   class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.delivery-note-products.destroy', [$item->delivery_note_id, $item->product_id]) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
