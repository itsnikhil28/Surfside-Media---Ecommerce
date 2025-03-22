<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Component;
use Livewire\WithPagination;

class Categorytable extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $categories = category::where('name', 'like', '%' . $this->search . '%')->orderBy('_id', 'DESC')->paginate(10);
        return view('livewire.categorytable', compact('categories'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
