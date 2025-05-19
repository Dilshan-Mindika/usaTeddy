<?php

namespace App\Livewire\Admin\HalfFinishSections;

use App\Models\HalfFinishSection;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
    {
        try {
            $section = HalfFinishSection::findOrFail($id); // Find the section by ID
            $section->delete(); // Delete the section

            // Dispatch success message
            $this->dispatch('done', ['success' => 'Half Finish Section deleted successfully.']);
        } catch (\Throwable $e) {
            // Dispatch error message
            $this->dispatch('done', ['error' => 'Error deleting Half Finish Section: ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.half-finish-sections.index', [
            'halfFinishSections' => HalfFinishSection::all() // Fetch all half finish sections
        ]);
    }
}



