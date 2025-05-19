<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Bank;
use App\Models\Client;
use Livewire\Component;

class Edit extends Component
{
    // Public property to hold the client instance
    public Client $client;

    /**
     * Define validation rules for updating a client.
     *
     * Note: Email uniqueness rule excludes the current client's ID to prevent false validation errors.
     */
    function rules()
    {
        return [
            'client.name' => "required", 
            'client.email' => "required|email|unique:clients,email," . $this->client->id, // Exclude current client
            'client.address' => "required",
            'client.phone_number' => "required",
            'client.registration_number' => "nullable",
            'client.bank_id' => "required",
            'client.account_number' => "required",
        ];
    }

    /**
     * Load the client to be edited using the given ID.
     *
     * @param int $id - Client ID
     */
    function mount($id)
    {
        // Fail safely if the client is not found
        $this->client = Client::findOrFail($id);
    }

    /**
     * Validate the component whenever a property is updated.
     */
    function updated()
    {
        $this->validate(); // Full validation on each update
    }

    /**
     * Save the updated client data.
     */
    function save()
    {
        $this->validate(); // Validate before saving

        try {
            $this->client->update(); // Update client in the database
            return redirect()->route('admin.clients.index'); // Redirect on success
        } catch (\Throwable $th) {
            // Handle any errors by dispatching a Livewire event
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the view for editing a client.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.clients.edit', [
            'banks' => Bank::all(), // Fetch banks for the select dropdown
        ]);
    }
}
