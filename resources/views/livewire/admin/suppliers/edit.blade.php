<div>
    <x-slot:header>Suppliers</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Edit this Supplier</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='supplier.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Supplier's Name" />
                        @error('supplier.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Email Address</label>
                        <input wire:model.live='supplier.email' type="email" class="form-control" name="email"
                            id="name" aria-describedby="email" placeholder="Enter your Supplier's Email Address" />
                        @error('supplier.email')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Phone Number</label>
                        <input wire:model.live='supplier.phone_number' type="text" class="form-control" name="phone_number"
                            id="name" aria-describedby="phone_number" placeholder="Enter Phone Number" />
                        @error('supplier.phone_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Registration Number</label>
                        <input wire:model.live='supplier.registration_number' type="text" class="form-control"
                            name="name" id="name" aria-describedby=""
                            placeholder="Enter Business Registration Number" />
                        @error('supplier.registration_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                

                <div class="mb-3">
                    <label for="" class="form-label">Address</label>
                    <textarea wire:model.live='supplier.address' class="form-control" name="" id="" rows="3"></textarea>
                    @error('supplier.address')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Bank</label>
                    <select wire:model.live='supplier.bank_id' class="form-select " name=""
                        id="">
                        <option selected>Select your Bank</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier.bank_id')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Account Number</label>
                    <input wire:model.live='supplier.account_number' type="text" class="form-control" name="name"
                        id="name" aria-describedby="" placeholder="Enter Supplier's Account Number" />
                    @error('supplier.account_number')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>



            </div>



            <button onclick="confirm('Are you sure you wish to update this Supplier')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
