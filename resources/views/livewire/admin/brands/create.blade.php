<div>
    <x-slot:header>Brands</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a new Brand</h5>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <label for="name" class="form-label">Brand Name</label>
                <input wire:model='brand.name' type="text" class="form-control" name="name" id="name"
                    aria-describedby="" placeholder="Enter your Brand Name" />
                @error('brand.name')
                    <small id="" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Logo</label>
                <input wire:model='image' type="file" class="form-control" />
                @error('image')
                    <small id="" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            @if ($image)
                <div class="mb-3">
                    <img width="150px" class="img-fluid p-3 border border-secondary" src="{{ $image->temporaryUrl() }}">
                </div>
            @endif




            <button onclick="confirm('Are you sure you wish to create this Brand')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
