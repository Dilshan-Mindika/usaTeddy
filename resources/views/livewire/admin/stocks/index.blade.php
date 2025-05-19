<div>
    <x-slot:header>Stocks</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0 d-flex justify-content-between align-items-center">
            <h5>Stock List</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Brought Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->unit->name ?? 'N/A' }}</td>
                            <td>Rs {{ number_format($stock->unit_price, 2) }}</td>
                            <td>Rs {{ number_format($stock->total_price, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->brought_date)->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.stocks.edit', $stock->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.stocks.destroy', $stock->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this stock?');">
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
