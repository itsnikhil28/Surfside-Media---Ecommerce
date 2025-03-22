<?php

namespace App\Livewire;

use App\Models\brand;
use Livewire\Component;
use Livewire\WithPagination;

class Brandstable extends Component
{
    use WithPagination;

    public $search='';

    public function render()
    {
        $brands = brand::where('name','like','%'.$this->search.'%')->orderBy('_id','DESC')->paginate(10);
        return view('livewire.brandstable',compact('brands'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
