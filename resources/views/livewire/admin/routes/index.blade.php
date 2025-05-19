<div>
    <x-slot:header>Routes</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0 d-flex justify-content-between align-items-center">
            <h5>Route List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>City</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes as $route)
                        <tr>
                            <td>{{ $route->id }}</td>
                            <td>{{ $route->city }}</td>
                            <td>{{ $route->description ?? 'N/A' }}</td>
                            <td class="text-center">
                                <!-- Edit button -->
                                <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Delete button (using wire:click for Livewire delete) -->
                                <button 
                                    onclick="confirm('Are you sure you want to delete this route?') || event.stopImmediatePropagation()" 
                                    class="btn btn-danger btn-sm" 
                                    wire:click="delete({{ $route->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <!-- If no routes, show a message -->
                    @if ($routes->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted">No routes found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
