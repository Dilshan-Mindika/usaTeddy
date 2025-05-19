<?php

namespace App\Livewire\Admin\Routes;

use App\Models\Route;
use Livewire\Component;

class Create extends Component
{
    public $route = [
        'city' => '',
        'description' => '',
    ];

    public function save()
    {
        $this->validate([
            'route.city' => 'required|string|max:255',
            'route.description' => 'nullable|string|max:1000',
        ]);

        Route::create($this->route);

        session()->flash('success', 'Route created successfully.');

        $this->reset('route');
    }

    public function render()
    {
        return view('livewire.admin.routes.create');
    }
}
