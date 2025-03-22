<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Adminheaderdetails extends Component
{
    public function render()
    {
        $user = User::findorfail(session('id'));
        return view('livewire.adminheaderdetails',compact('user'));
    }
}
