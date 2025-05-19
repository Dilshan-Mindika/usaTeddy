<?php

namespace App\Livewire\Admin\Employees;

use App\Models\Bank;
use App\Models\Employee;
use Livewire\Component;

class Create extends Component
{
    public $employee = [];

    public function save()
    {
        $validated = $this->validate([
            'employee.name' => 'required|string|max:255',
            'employee.email' => 'nullable|email',
            'employee.phone_number' => 'required|string',
            'employee.address' => 'required|string',
            'employee.position' => 'required|string',
            'employee.registration_number' => 'nullable|string',
            'employee.bank_id' => 'nullable|exists:banks,id',
            'employee.account_number' => 'nullable|string',
            'employee.joining_date' => 'required|date',
            'employee.resignation_date' => 'nullable|date|after_or_equal:employee.joining_date',
        ]);

        Employee::create($validated['employee']);

        $this->reset('employee');
        $this->dispatch('done', success: 'Employee created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.employees.create', [
            'banks' => Bank::all(),
        ]);
    }
}
