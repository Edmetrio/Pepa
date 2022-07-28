<?php

namespace App\Http\Livewire;

use App\Models\Models\Encomenda;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Historicos extends Component
{
    use WithPagination;
    public function render()
    {
        $encomenda = Encomenda::with('produtos')->where('users_id', Auth::user()->id)->paginate(5);
        $ttt = 0.0;
        foreach($encomenda as $e)
        {
            foreach($e->produtos as $item)
            {
                $item->subtotal = $item->pivot->quantidade * $item->preco_retalho;
                $ttt += $item->subtotal;
            }
        }
        $encomenda->total = $ttt;
        /* dd($this->encomenda); */
        return view('livewire.historicos', compact('encomenda'))->layout('layouts.appD');
    }
}
