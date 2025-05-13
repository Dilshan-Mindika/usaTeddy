<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Bank;
use App\Models\Client;
use Livewire\Component;

class Edit extends Component
{
    public Client $client;

    function rules()
    {
        return [
            'client.name' => "required",
            'client.email' => "required|unique:clients,email",
            'client.address' => "required",
            'client.phone_number' => "required",
            'client.registration_number' => "nullable",
            'client.bank_id' => "required",
            'client.account_number' => "required",
        ];
    }

    function mount($id)
    {
        $this->client = Client::find($id);
    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->client->update();
            return redirect()->route('admin.clients.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: "Something Went Wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.clients.edit',[
            'banks'=>Bank::all()
        ]);
    }
}
