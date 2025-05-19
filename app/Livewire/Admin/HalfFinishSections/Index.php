<?php

namespace App\Livewire\Admin\HalfFinishSections;

use App\Models\HalfFinishSection;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.half-finish-sections.index',data: [
            'halfFinishSections' => HalfFinishSection::all()
        ]);
    }
}
