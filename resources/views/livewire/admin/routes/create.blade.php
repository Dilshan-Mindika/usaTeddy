<div>
    <x-slot:header>Routes</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a New Route</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input wire:model.live='route.city' type="text" class="form-control" id="city"
                       placeholder="Enter City Name" />
                @error('route.city')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea wire:model.live='route.description' class="form-control" id="description"
                          rows="3" placeholder="Optional Description"></textarea>
                @error('route.description')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button onclick="confirm('Are you sure you want to create this route?') || event.stopImmediatePropagation()"
                    wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
