<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Component;

class UserFooter extends Component
{
    public function render()
    {
        $categories = category::orderby('created_at')->get();
        return view('livewire.user-footer',compact('categories'));
    }
}
