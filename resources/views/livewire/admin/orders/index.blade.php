<div>
    <x-slot:header>Orders</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Order Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Order Date</th>
                        <th>Supplier</th>
                        <th>Total Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td scope="row">{{ $order->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($order->order_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>
                                {{ $order->supplier->name }}
                            </td>
                            <td>
                                <small>KES {{ number_format($order->total_amount, 2) }}</small>
                            </td>
                            {{-- <td>
                                <span class="{{ $order->is_paid ? 'text-success' : 'text-danger' }}"
                                    style="font: bold">
                                    {{ $order->is_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td> --}}
                            <td class="text-center">
                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a target="_blank" href="{{ route('admin.order-download', $order->id) }}" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Order?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $order->id }})'>
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
