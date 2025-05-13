<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{

    function updatePermissions($id)
    {
        try {
            if ($id !== 1) {
                throw new \Exception("This is not the Super Administrator", 1);
            }
            $role = Role::find($id);
            $role->permissions = json_encode(config('permissions.permissions'));
            $role->save();

            $this->dispatch('done', success: "Successfully Updated Super Admin Roles");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            if (count($role->users) > 0) {
                throw new \Exception("Error Processing request: This Role has {$role->users->count()} user(s)", 1);
            }
            $role->delete();

            $this->dispatch('done', success: "Successfully Deleted this Role");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }
}
