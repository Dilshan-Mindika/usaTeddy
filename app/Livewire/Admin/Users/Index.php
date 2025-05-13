<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($id == 1) {
                throw new \Exception("Error Processing request: This User is the super administrator", 1);
            }
            $user->roles()->detach();
            $user->delete();

            $this->dispatch('done', success: "Successfully Deleted this User");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::all(),
        ]);
    }
}
