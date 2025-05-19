<?php

namespace App\Livewire\Admin\DeliveryNotes;

use App\Models\DeliveryNote;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;  // Include pagination functionality

    public $deliveryNotes;

    public function mount()
    {
        // Initially, fetch delivery notes for the component
        // Using pagination here
        $this->deliveryNotes = DeliveryNote::orderBy('created_at', 'desc')->paginate(10);
    }

    public function render()
    {
        // Use already fetched paginated data
        return view('livewire.admin.delivery-notes.index', [
            'deliveryNotes' => $this->deliveryNotes,  // Use paginated data
        ]);
    }
}
