<?php

namespace App\Livewire\Admin\CuttingSections;

use App\Models\CuttingSection;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;  // Adding pagination functionality

    /**
     * Delete a Cutting Section.
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            $section = CuttingSection::findOrFail($id);
            $section->delete();

            // Dispatch success message
            $this->dispatch('done', success: 'Cutting Section deleted successfully.');
        } catch (\Throwable $e) {
            // Dispatch error message
            $this->dispatch('done', error: 'Error deleting Cutting Section: ' . $e->getMessage());
        }
    }

    /**
     * Render the Cutting Sections list view with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Paginate the cutting sections, limit to 10 per page
        $cuttingSections = CuttingSection::paginate(10);

        return view('livewire.admin.cutting-sections.index', [
            'cuttingSections' => $cuttingSections,
        ]);
    }
}
