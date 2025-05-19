<?php

namespace App\Livewire\Admin\Stocks;

use App\Models\Stock;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.stocks.index', [
            'stocks' => Stock::all()
        ]);
    }
}
