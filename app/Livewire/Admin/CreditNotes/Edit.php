<?php

namespace App\Livewire\Admin\CreditNotes;

use App\Models\CreditNote;
use Livewire\Component;

class Edit extends Component
{
    // Public property to hold the credit note that is being edited
    public $creditNote;

    /**
     * Mount method to load the credit note from the database based on the ID.
     *
     * @param int $id - The ID of the credit note to be edited.
     */
    public function mount($id)
    {
        // Find the credit note by its ID and load it into the component
        $this->creditNote = CreditNote::findOrFail($id);
    }

    /**
     * Render the view for editing the credit note.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.credit-notes.edit', [
            'creditNote' => $this->creditNote, // Pass the credit note to the view
        ]);
    }
}
