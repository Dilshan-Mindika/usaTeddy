<?php

namespace App\Livewire\Admin\DeliveryNotes;

use App\Models\DeliveryNote;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.delivery-notes.index', [
            'deliveryNotes' => DeliveryNote::all()
        ]);
    }
}
