<div>
    <x-slot:header>Employees</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create New Employee</h5>
        </div>
        <div class="card-body">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input wire:model.live="employee.name" type="text" class="form-control" placeholder="Enter name">
                @error('employee.name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input wire:model.live="employee.email" type="email" class="form-control" placeholder="Enter email">
                @error('employee.email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input wire:model.live="employee.phone_number" type="text" class="form-control" placeholder="Enter phone number">
                @error('employee.phone_number') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea wire:model.live="employee.address" class="form-control" rows="2" placeholder="Enter address"></textarea>
                @error('employee.address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Position -->
            <div class="mb-3">
                <label class="form-label">Position</label>
                <input wire:model.live="employee.position" type="text" class="form-control" placeholder="Enter job position">
                @error('employee.position') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Registration Number -->
            <div class="mb-3">
                <label class="form-label">Registration Number</label>
                <input wire:model.live="employee.registration_number" type="text" class="form-control" placeholder="Enter registration number (optional)">
                @error('employee.registration_number') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Bank -->
            <div class="mb-3">
                <label class="form-label">Bank</label>
                <select wire:model.live="employee.bank_id" class="form-select">
                    <option value="">Select Bank</option>
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
                @error('employee.bank_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Account Number -->
            <div class="mb-3">
                <label class="form-label">Account Number</label>
                <input wire:model.live="employee.account_number" type="text" class="form-control" placeholder="Enter account number">
                @error('employee.account_number') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Joining Date -->
            <div class="mb-3">
                <label class="form-label">Joining Date</label>
                <input wire:model.live="employee.joining_date" type="date" class="form-control">
                @error('employee.joining_date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Submit Button -->
            <button wire:click="save"
                    onclick="confirm('Are you sure you want to create this employee?') || event.stopImmediatePropagation()"
                    class="btn btn-dark text-inv-primary">
                Save
            </button>
        </div>
    </div>
</div>
