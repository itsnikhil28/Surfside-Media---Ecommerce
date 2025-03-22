<?php

namespace App\Livewire;

use App\Models\product;
use Livewire\Component;
use Livewire\WithPagination;

class Producttable extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $products = product::where('name', 'like', '%' . $this->search . '%')->orderBy('_id', 'DESC')->paginate(10);
        return view('livewire.producttable', compact('products'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
