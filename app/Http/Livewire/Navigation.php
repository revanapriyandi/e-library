<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    protected $listeners = ['refreshnavigation'];
    public function refreshnavigation()
    {
    }
    public function render()
    {
        return view('navigation');
    }
}
