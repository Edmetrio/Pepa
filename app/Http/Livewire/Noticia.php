<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Noticia extends Component
{
    public function render()
    {
        return view('livewire.noticia')->layout('layouts.appD');
    }
}
