<?php

namespace App\Livewire\Admin\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public User $user;
    public $selectedRoles = [];

    function rules()
    {
        return [
            'user.name' => "required",
            'selectedRoles' => "required",
            'user.email' => "required|unique:users,email," . $this->user->id,
        ];
    }

    function mount($id)
    {
        $this->user = User::find($id);
        $this->selectedRoles = $this->user->roles()->pluck('id');
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->user->update();
            $this->user->roles()->detach();
            $this->user->roles()->attach($this->selectedRoles);
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.users.edit', [
            'roles' => Role::all()
        ]);
    }
}
