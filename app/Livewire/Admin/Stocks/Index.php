<?php

namespace App\Livewire\Admin\Stocks;

use App\Models\Stock;
use Livewire\Component;

class Index extends Component
{
    public function delete($id)
{
    try {
        $stock = \App\Models\Stock::findOrFail($id);
        $stock->delete();
        $this->dispatch('done', success: 'Stock deleted successfully.');
    } catch (\Throwable $e) {
        $this->dispatch('done', error: 'Failed to delete: ' . $e->getMessage());
    }
}

    public function render()
    {
        return view('livewire.admin.stocks.index',data: [
            'stocks' => Stock::all()
        ]);
    }
}
