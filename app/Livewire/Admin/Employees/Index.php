<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use Livewire\Component;

class Index extends Component
{
    
    public function render()
    {
        return view('livewire.admin.employees.index',data: [
            'employees'=>Employee::all()
        ]);
    }
}
