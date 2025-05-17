<div>
    <x-slot:header>Customer</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Edit this Customer</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='client.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Client's Name" />
                        @error('client.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Email Address</label>
                        <input wire:model.live='client.email' type="email" class="form-control" name="email"
                            id="name" aria-describedby="email" placeholder="Enter your Customer's Email Address" />
                        @error('client.email')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Phone Number</label>
                        <input wire:model.live='client.phone_number' type="text" class="form-control" name="phone_number"
                            id="name" aria-describedby="phone_number" placeholder="Enter Phone Number" />
                        @error('client.phone_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Registration Number</label>
                        <input wire:model.live='client.registration_number' type="text" class="form-control"
                            name="name" id="name" aria-describedby=""
                            placeholder="Enter Business Registration Number" />
                        @error('client.registration_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                

                <div class="mb-3">
                    <label for="" class="form-label">Address</label>
                    <textarea wire:model.live='client.address' class="form-control" name="" id="" rows="3"></textarea>
                    @error('client.address')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Bank</label>
                    <select wire:model.live='client.bank_id' class="form-select " name=""
                        id="">
                        <option selected>Select your Bank</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                    @error('client.bank_id')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Account Number</label>
                    <input wire:model.live='client.account_number' type="text" class="form-control" name="name"
                        id="name" aria-describedby="" placeholder="Enter Customer's Account Number" />
                    @error('client.account_number')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>



            </div>



            <button onclick="confirm('Are you sure you wish to create this Customer')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
