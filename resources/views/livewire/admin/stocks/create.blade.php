<div>
    <x-slot:header>Stocks</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a New Stock</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Stock Name</label>
                        <input wire:model.live='stock.name' type="text" class="form-control" id="name"
                               placeholder="Enter Stock Name" />
                        @error('stock.name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input wire:model.live='stock.quantity' type="number" class="form-control" id="quantity"
                               placeholder="Enter Quantity" />
                        @error('stock.quantity')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="unit_id" class="form-label">Unit</label>
                        <select wire:model.live='stock.unit_id' class="form-select" id="unit_id">
                            <option selected>Select Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('stock.unit_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="unit_price" class="form-label">Unit Price (Rs)</label>
                        <input wire:model.live='stock.unit_price' type="number" step="0.01" class="form-control" id="unit_price"
                               placeholder="Enter Unit Price" />
                        @error('stock.unit_price')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="brought_date" class="form-label">Brought Date</label>
                        <input wire:model.live='stock.brought_date' type="date" class="form-control" id="brought_date" />
                        @error('stock.brought_date')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Optional total price (can also be auto-calculated via computed property or backend logic) --}}
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Total Price</label>
                        <input wire:model.live='stock.total_price' type="number" step="0.01" class="form-control"
                               placeholder="Calculated Total Price" readonly />
                    </div>
                </div>
            </div>

            <button onclick="confirm('Are you sure you want to create this stock?') || event.stopImmediatePropagation()"
                    wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
