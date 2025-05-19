<div>
    <x-slot:header>Products</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a new Product</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Category</label>
                        <select wire:model.live='product.product_category_id' class="form-select " name=""
                            id="">
                            <option selected>Select your Product Category</option>
                            @foreach ($productCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product.product_category_id')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Brand</label>
                        <select wire:model.live='product.brand_id' class="form-select " name="" id="">
                            <option selected>Select your Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('product.brand_id')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input wire:model.live='product.name' type="text" class="form-control" name="name"
                        id="name" aria-describedby="name" placeholder="Enter your Product's Name" />
                    @error('product.name')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Product Description</label>
                    <textarea wire:model.live='product.description' class="form-control" name="" id="" rows="3"></textarea>
                    @error('product.description')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Measure Unit</label>
                        <select wire:model.live='product.unit_id' class="form-select " name="" id="">
                            <option selected>Select your Product Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('product.unit_id')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Quantity</label>
                        <input wire:model.live='product.quantity' type="number" min="0" step="0.1"
                            class="form-control" name="quantity" id="name" aria-describedby="quantity"
                            placeholder="Enter your Product's quantity per unit" />
                        @error('product.quantity')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Cost</label>
                        <input wire:model.live='product.purchase_price' type="number" min="0" step="0.1"
                            class="form-control" name="purchase_price" id="name" aria-describedby="purchase_price"
                            placeholder="Enter your Product's purchase price" />
                        @error('product.purchase_price')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Sale Price</label>
                        <input wire:model.live='product.sale_price' type="number" min="0" step="0.1"
                            class="form-control" name="sale_price" id="name" aria-describedby="sale_price"
                            placeholder="Enter your Product's sale price" />
                        @error('product.sale_price')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>





            </div>



            <button onclick="confirm('Are you sure you wish to create this Product')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
