<div>
    <x-slot:header>Product Categories</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Product Categorie Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number of Products</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productCategories as $category)
                        <tr>
                            <td scope="row">{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ count($category->products) }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.product-categories.edit', $category->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="confirm('Are you sure you wish to DELETE this category?')||event.stopImmediatePropagation()" class="btn btn-danger" wire:click='delete({{ $category->id }})'>
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
