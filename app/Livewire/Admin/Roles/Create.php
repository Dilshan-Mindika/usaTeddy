<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Create extends Component
{
    public Role $role;
    public String $search = '';
    public array $permissions = [];

    public array $selected_permissions = [];
    function rules()
    {
        return [
            'role.title' => "required",
        ];
    }

    function mount()
    {
        $this->role = new Role();
        $this->permissions = config('permissions.permissions');
    }

    function add($permission)
    {
        // $this->dispatch('done', success: "Test Complete");
        try {
            if (in_array($permission, $this->selected_permissions)) {
                throw new \Exception("Error Processing Request: Permission already added", 1);
            }

            array_push($this->selected_permissions, $permission);
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    function subtract($key)
    {
        try {
            //code...
            array_splice($this->selected_permissions, $key, 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->role->permissions = json_encode($this->selected_permissions);
            $this->role->save();
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {

        $filteredData = [];

        if (!empty($this->search)) {
            $filteredData = array_filter($this->permissions, function ($permission) {
                return str_contains($permission, $this->search) !== false;
            });
        }

        return view('livewire.admin.roles.create', [
            'filtered_permissions' => $filteredData
        ]);
    }
}
