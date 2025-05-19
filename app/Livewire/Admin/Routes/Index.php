<?php

namespace App\Livewire\Admin\Routes;

use App\Models\Route;
use Livewire\Component;

class Index extends Component
{
    
    public function render()
    {
        return view('livewire.admin.routes.index',data: [
            'routes'=>Route::all()
        ]);
    }
}
