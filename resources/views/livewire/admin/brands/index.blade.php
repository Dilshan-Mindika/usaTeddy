<div>
    <x-slot:header>Brands</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Brand Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td scope="row">{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <img src="{{ $brand->logo_url }}" class="img-fluid rounded-0 p-2 border border-secondary" width="60px"
                                    alt="Brand Logo" />
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="confirm('Are you sure you wish to DELETE this brand?')||event.stopImmediatePropagation()" class="btn btn-danger" wire:click='delete({{ $brand->id }})'>
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
