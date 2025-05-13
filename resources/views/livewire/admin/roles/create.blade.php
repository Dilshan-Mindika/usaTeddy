<div>
    <x-slot:header>Roles</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Create a new Role</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Title</label>
                        <input wire:model.live='role.title' type="text" class="form-control" name="name"
                            id="name" aria-describedby="" placeholder="Enter your Role Title" />
                        @error('role.title')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Permissions</label>
                        <input wire:model.live='search' type="search" class="form-control" name="search"
                            placeholder="Search your Permission" />
                        @error('search')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <!-- Horizontal under breakpoint -->
                        <div class="list-group">

                            @foreach ($filtered_permissions as $perm)
                                <button
                                    class="list-group-item btn @if (in_array($perm, $selected_permissions)) bg-inv-secondary disabled @endif"
                                    wire:click="add('{{ $perm }}')">
                                    {{ $perm }}
                                </button>
                            @endforeach

                        </div>


                    </div>
                    @foreach ($selected_permissions as $key => $permission)
                        <span class="badge rounded-pill bg-inv-secondary">
                            {{ $permission }}
                            <a href="javascript:void(0)" wire:click="subtract('{{ $key }}')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </span>
                    @endforeach
                </div>
            </div>





            <button onclick="confirm('Are you sure you wish to create this Role')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-primary">Save</button>
        </div>
    </div>
</div>
