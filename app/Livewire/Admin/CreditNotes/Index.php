<?php

namespace App\Livewire\Admin\CreditNotes;


use App\Models\CreditNote;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.credit-notes.index',data: [
            'creditNotes'=>CreditNote::all()
        ]);
    }
}
