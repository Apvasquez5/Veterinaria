<?php

namespace App\Http\Livewire\Pets;

use Livewire\Component;

class Pets extends Component
{
    public function render()
    {
        return view('livewire.pets.pets')->layout('layouts.app');
    }
}
