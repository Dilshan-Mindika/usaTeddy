<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        try {
            $section = CuttingSection::findOrFail($id);
            $section->delete();

            $this->dispatch('done', success: 'Cutting Section deleted successfully.');
        } catch (\Throwable $e) {
            $this->dispatch('done', error: 'Error deleting Cutting Section: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.cutting-sections.index', [
            'cuttingSections' => CuttingSection::all()
        ]);
    }
}
