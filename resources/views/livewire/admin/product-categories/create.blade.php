<div>
    <x-slot:header>Product Categories</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a new Product Category</h5>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input wire:model.live='category.name' type="text" class="form-control" name="name" id="name"
                    aria-describedby="" placeholder="Enter your category name" />
                @error('category.name')
                    <small id="" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>



            <button onclick="confirm('Are you sure you wish to create this Category')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
