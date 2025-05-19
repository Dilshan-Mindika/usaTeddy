<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Create extends Component
{
    // Declare a public property to bind the Bank model to the component
    public Bank $bank;

    /**
     * Define validation rules for the bank fields.
     *
     * @return array
     */
    function rules()
    {
        return [
            'bank.name' => "required",       // Bank name is required
            'bank.short_name' => "required", // Short name is required
            'bank.sort_code' => "required",  // Sort code is required
        ];
    }

    /**
     * Initialize a new Bank instance when the component is mounted.
     */
    function mount()
    {
        $this->bank = new Bank();
    }

    /**
     * Automatically validate the component's data when any property is updated.
     */
    function updated()
    {
        $this->validate(); // Validate all fields on update
    }

    /**
     * Handle the form submission to save a new bank.
     * Redirects to the index page on success, or dispatches an error on failure.
     */
    function save()
    {
        $this->validate(); // Ensure all fields are valid before saving

        try {
            $this->bank->save(); // Save the bank to the database
            return redirect()->route('admin.banks.index'); // Redirect to the banks index page
        } catch (\Throwable $th) {
            // Dispatch a custom event with the error message
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.banks.create');
    }
}
