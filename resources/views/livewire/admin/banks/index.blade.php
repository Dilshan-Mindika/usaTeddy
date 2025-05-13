<div>
    <x-slot:header>Banks</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Bank Overview</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Common SORT Code</th>
                        <th>Number of Clients</th>
                        <th>Number of Suppliers</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banks as $bank)
                        <tr>
                            <td scope="row">{{ $bank->id }}</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->short_name }}</td>
                            <td>{{ $bank->sort_code }}</td>
                            <td>{{ count($bank->clients) }}</td>
                            <td>{{ count($bank->suppliers) }}</td>


                            <td class="text-center">
                                <a href="{{ route('admin.banks.edit', $bank->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="confirm('Are you sure you wish to DELETE this Bank?')||event.stopImmediatePropagation()" class="btn btn-danger" wire:click='delete({{ $bank->id }})'>
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
