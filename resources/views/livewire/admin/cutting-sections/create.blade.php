<div>
    <x-slot:header>Cutting Sections</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a New Cutting Section</h5>
        </div>
        <div class="card-body">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Section Name</label>
                <input wire:model.live="section.name" type="text" class="form-control" placeholder="Enter section name">
                @error('section.name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input wire:model.live="section.quantity" type="number" step="0.01" class="form-control" placeholder="Enter quantity">
                @error('section.quantity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Unit -->
            <div class="mb-3">
                <label class="form-label">Unit</label>
                <select wire:model.live="section.unit_id" class="form-select">
                    <option value="">Select Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
                @error('section.unit_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Product -->
            <div class="mb-3">
                <label class="form-label">Product</label>
                <select wire:model.live="section.product_id" class="form-select">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('section.product_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Date -->
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input wire:model.live="section.date" type="date" class="form-control">
                @error('section.date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Save Button -->
            <button wire:click="save"
                onclick="confirm('Are you sure you want to create this cutting section?') || event.stopImmediatePropagation()"
                class="btn btn-dark text-inv-primary">
                Save
            </button>
        </div>
    </div>
</div>
