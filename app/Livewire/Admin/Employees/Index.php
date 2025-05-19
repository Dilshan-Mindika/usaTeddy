<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Employee;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        // Optionally dispatch a success message
        $this->dispatch('done', success: 'Employee deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.employees.index', [
            'employees' => Employee::all()
        ]);
    }
}
