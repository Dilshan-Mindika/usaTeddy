<?php

namespace App\Livewire\Admin\DeliveryNotes;

use App\Models\DeliveryNote;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; // Include pagination functionality

    public $deliveryNotes;
    public $paginationLinks;

    public function mount()
    {
        // Fetch paginated delivery notes
        $paginatedData = DeliveryNote::orderBy('created_at', 'desc')->paginate(10);

        // Extract the delivery notes and pagination links separately
        $this->deliveryNotes = $paginatedData->items();  // Convert to an array of items
        $this->paginationLinks = $paginatedData->links(); // Get pagination links
    }

    public function render()
    {
        return view('livewire.admin.delivery-notes.index', [
            'deliveryNotes' => $this->deliveryNotes,  // List of delivery notes
            'paginationLinks' => $this->paginationLinks, // Pagination links for the view
        ]);
    }
}