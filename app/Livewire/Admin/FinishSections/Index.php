<?php

namespace App\Livewire\Admin\FinishSections;

use App\Models\FinishSection;
use Livewire\Component;

class Index extends Component
{
    // Public delete method
    public function delete($id)
    {
        try {
            // Find and delete the section
            $section = FinishSection::findOrFail($id);
            $section->delete();

            // Dispatch success message
            $this->dispatch('done', ['success' => 'Finish Section deleted successfully.']);
        } catch (\Throwable $e) {
            // Dispatch error message
            $this->dispatch('done', ['error' => 'Error deleting Finish Section: ' . $e->getMessage()]);
        }
    }

    // Render method to return the view with data
    public function render()
    {
        return view('livewire.admin.finish-sections.index', [
            'finishSections' => FinishSection::all()
        ]);
    }
}
