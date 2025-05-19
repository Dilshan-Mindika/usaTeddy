<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Bank;
use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
    // Public property for binding client model data
    public Client $client;

    /**
     * Define validation rules for client creation form.
     *
     * @return array
     */
    function rules()
    {
        return [
            'client.name' => "required",                              // Client name is required
            'client.email' => "required|email|unique:clients,email", // Email must be unique and valid
            'client.address' => "required",                           // Address is required
            'client.phone_number' => "required",                      // Phone number is required
            'client.registration_number' => "nullable",               // Optional registration number
            'client.bank_id' => "required",                           // Associated bank is required
            'client.account_number' => "required",                    // Bank account number is required
        ];
    }

    /**
     * Initialize a new Client model when the component mounts.
     */
    function mount()
    {
        $this->client = new Client();
    }

    /**
     * Automatically validate fields whenever they are updated.
     */
    function updated()
    {
        $this->validate(); // Re-validate the entire form on update
    }

    /**
     * Handle saving of a new client record.
     * Redirect on success or dispatch an error on failure.
     */
    function save()
    {
        $this->validate(); // Ensure form data is valid

        try {
            $this->client->save(); // Persist the client to the database
            return redirect()->route('admin.clients.index'); // Redirect to the client listing
        } catch (\Throwable $th) {
            // Dispatch a Livewire event to handle the error
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the client creation view with available banks.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.clients.create', [
            'banks' => Bank::all(), // Fetch all banks for the bank select dropdown
        ]);
    }
}
