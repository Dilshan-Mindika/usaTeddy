<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Edit extends Component
{
    // Public property for binding the Bank model instance to the component
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
     * Mount the component with the bank data based on the given ID.
     *
     * @param int $id - ID of the bank to be edited
     */
    function mount($id)
    {
        // Retrieve the bank record or throw a 404 if not found
        $this->bank = Bank::findOrFail($id);
    }

    /**
     * Automatically validate inputs when any bound property is updated.
     */
    function updated()
    {
        $this->validate(); // Validate all inputs on update
    }

    /**
     * Save the updated bank data to the database.
     * On success, redirects to the index page. On failure, dispatches an error.
     */
    function save()
    {
        $this->validate(); // Ensure all fields are valid before saving

        try {
            $this->bank->update(); // Update the bank record in the database
            return redirect()->route('admin.banks.index'); // Redirect to the bank list
        } catch (\Throwable $th) {
            // Dispatch a Livewire event with the error message
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the view for editing the bank.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.banks.edit');
    }
}
