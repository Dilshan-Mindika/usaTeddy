<div>
    <x-slot:header>Employees</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Employee List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Basic Details</th>
                        <th>Address</th>
                        <th>Job Info</th>
                        <th>Account Details</th>
                        <th>Joining Date</th>
                        <th>Resignation Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td scope="row">{{ $employee->id }}</td>
                            <td>
                                <h6>{{ $employee->name }}</h6>
                                <small>{{ $employee->email ?? 'N/A' }}</small><br>
                                <small>{{ $employee->phone_number }}</small>
                            </td>
                            <td>{{ $employee->address }}</td>
                            <td>
                                <small><strong>Position:</strong> {{ $employee->position }}</small><br>
                                <small><strong>Reg No:</strong> {{ $employee->registration_number ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <small><strong>Bank:</strong> {{ $employee->bank->name ?? 'N/A' }}</small><br>
                                <small><strong>A/C No:</strong> {{ $employee->account_number ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $employee->joining_date }}</td>
                            <td>{{ $employee->resignation_date ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.employees.edit', $employee->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Employee?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $employee->id }})'>
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
