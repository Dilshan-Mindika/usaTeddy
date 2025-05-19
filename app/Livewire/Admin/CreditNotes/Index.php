<?php

namespace App\Livewire\Admin\CreditNotes;

use App\Models\CreditNote;
use Livewire\Component;

class Index extends Component
{
    /**
     * Render the credit notes index page with a list of all credit notes.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Fetch all credit notes and pass them to the view
        return view('livewire.admin.credit-notes.index', [
            'creditNotes' => CreditNote::all(), // Fetch all credit notes from the database
        ]);
    }
}
