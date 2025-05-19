<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    // Use Livewire pagination trait
    use WithPagination;

    /**
     * Delete a client by ID, with checks to prevent deletion if the client has made purchases.
     *
     * @param int $id - The ID of the client to delete
     */
    function delete($id)
    {
        try {
            // Find the client or throw a 404 if not found
            $client = Client::findOrFail($id);

            // Prevent deletion if the client has related sales
            if ($client->sales->count() > 0) {
                throw new \Exception(
                    "Error Processing request: This Client has bought from you {$client->sales->count()} time(s)",
                    1
                );
            }

            // Delete the client record
            $client->delete();

            // Dispatch success message to frontend
            $this->dispatch('done', success: "Successfully Deleted this Client");

            // Reset pagination to first page if needed
            $this->resetPage();
        } catch (\Throwable $th) {
            // Dispatch error message to frontend
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the Livewire view with paginated client list.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.clients.index', [
            'clients' => Client::orderBy('id', 'DESC')->paginate(10) // Paginate clients, newest first
        ]);
    }
}
