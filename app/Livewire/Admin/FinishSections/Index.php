<?php

namespace App\Livewire\Admin\FinishSections;

use App\Models\FinishSection;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.finish-sections.index',data: [
            'finishSections' => FinishSection::all(),
        ]);
    }
}
