<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Produtos extends Component
{
    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query){
            if(auth()->check()){
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.produtos', compact('produto'))->layout('layouts.app', compact('produto','categoria','item'));
    }
}
