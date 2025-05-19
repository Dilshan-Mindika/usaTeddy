<div>
    <x-slot:header>Half Finish Sections</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0 d-flex justify-content-between align-items-center">
            <h5>Half Finish Sections List</h5>
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
                    @foreach ($halfFinishSections as $halfFinishSection)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->quantity }}</td>
                            <td>{{ $section->unit->name ?? 'N/A' }}</td>
                            <td>{{ $section->product->name ?? 'N/A' }}</td> <!-- Fetch product name -->
                            <td>{{ \Carbon\Carbon::parse($section->date)->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.half-finish-sections.edit', $section->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.half-finish-sections.destroy', $section->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this section?');">
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
