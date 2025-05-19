<div>
    <x-slot:header>Cutting Sections</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0 d-flex justify-content-between align-items-center">
            <h5>Cutting Sections List</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cuttingSections as $cuttingsection)
                        <tr>
                            <td>{{ $cuttingsection->id }}</td>
                            <td>{{ $cuttingsection->name }}</td>
                            <td>{{ $cuttingsection->quantity }}</td>
                            <td>{{ $cuttingsection->unit->name ?? 'N/A' }}</td>
                            <td>{{ $cuttingsection->product->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuttingsection->date)->format('d M Y') }}</td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.cutting-sections.edit', $cuttingsection->id) }}"
                                   class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you want to delete this section?') || event.stopImmediatePropagation()"
                                    class="btn btn-danger btn-sm"
                                    wire:click="delete({{ $cuttingsection->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No cutting sections found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
