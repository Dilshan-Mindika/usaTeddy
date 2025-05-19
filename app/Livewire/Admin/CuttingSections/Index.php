<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.cutting-sections.index', [
            'cuttingSections' => CuttingSection::all()
        ]);
    }
}
