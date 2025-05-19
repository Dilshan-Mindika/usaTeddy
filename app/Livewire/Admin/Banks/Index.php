<?php

namespace App\Livewire\Admin\Banks;

use App\Models\Bank;
use Livewire\Component;

class Index extends Component
{
    /**
     * Delete a bank by its ID.
     * Prevents deletion if the bank is linked to any clients or suppliers.
     *
     * @param int $id
     */
    function delete($id)
    {
        try {
            // Attempt to find the bank by ID or throw a 404 error
            $bank = Bank::findOrFail($id);

            // Check if the bank has related clients or suppliers
            if (count($bank->clients) > 0 || count($bank->suppliers) > 0) {
                throw new \Exception("Error Processing request: This Bank has {$bank->clients->count()} client(s) & {$bank->suppliers->count()} supplier(s)", 1);
            }

            // Proceed to delete the bank
            $bank->delete();

            // Dispatch a Livewire event to notify success
            $this->dispatch('done', success: "Successfully Deleted this Bank");
        } catch (\Throwable $th) {
            // Handle any errors and dispatch an error event
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }

    /**
     * Render the view for the list of banks.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.banks.index', [
            'banks' => Bank::all(), // Fetch all banks to be displayed in the view
        ]);
    }
}
