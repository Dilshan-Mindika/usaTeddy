<div>
    <x-slot:header>Credit Note Products</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a New Credit Note Product</h5>
        </div>
        <div class="card-body">

            <!-- Product Selection -->
            <div class="mb-3">
                <label class="form-label">Product</label>
                <select wire:model.live="creditNote.product_id" class="form-select">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('creditNote.product_id') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Quantity Input -->
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input wire:model.live="creditNote.quantity" type="number" class="form-control" placeholder="Enter quantity" step="0.01">
                @error('creditNote.quantity') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Unit Price Input -->
            <div class="mb-3">
                <label class="form-label">Unit Price</label>
                <input wire:model.live="creditNote.unit_price" type="number" class="form-control" placeholder="Enter unit price" step="0.01">
                @error('creditNote.unit_price') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Date Input -->
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input wire:model.live="creditNote.date" type="date" class="form-control">
                @error('creditNote.date') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <!-- Save Button -->
            <button wire:click="save"
                    onclick="confirm('Are you sure you want to create this credit note?') || event.stopImmediatePropagation()"
                    class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>