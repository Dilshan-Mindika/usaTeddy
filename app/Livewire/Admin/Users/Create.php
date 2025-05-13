<?php

namespace App\Livewire\Admin\Users;

use App\Mail\UserCreatedMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Create extends Component
{
    public User $user;
    public $selectedRoles = [];

    function rules()
    {
        return [
            'user.name' => "required",
            'selectedRoles' => "required",
            'user.email' => "required|unique:users,email",
        ];
    }

    function mount()
    {
        $this->user = new User();
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $password = Str::random(12);
            $this->user->password = Hash::make($password);
            $this->user->save();

            $this->user->roles()->attach($this->selectedRoles);

            Mail::to($this->user->email)->send(new UserCreatedMail($this->user, $password));

            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.users.create', [
            'roles' => Role::all()
        ]);
    }
}
