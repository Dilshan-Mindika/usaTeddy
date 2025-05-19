<?php

namespace App\Livewire\Admin\Routes;

use App\Models\Route;
use Livewire\Component;

class Index extends Component
{
    // Delete function for handling route deletion
    public function delete($id)
    {
        try {
            $route = Route::findOrFail($id);
            // You can add any checks here (e.g., dependencies, related models, etc.)
            
            // Perform the delete operation
            $route->delete();

            // Dispatch success message
            session()->flash('message', 'Route deleted successfully!');
        } catch (\Throwable $th) {
            // Handle error (e.g., route not found, or issues during deletion)
            session()->flash('error', 'Error deleting the route: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.routes.index', [
            'routes' => Route::all(),
        ]);
    }
}
