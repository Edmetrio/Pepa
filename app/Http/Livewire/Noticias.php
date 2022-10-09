<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Noticia;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Noticias extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->noticias = Noticia::orderBy('created_at', 'desc')->get();
    }

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
        $noticia = Noticia::orderBy('created_at', 'desc')->paginate(6);
        return view('livewire.noticias', compact('noticia'))->layout('layouts.app', compact('produto','categoria','item'));
    }
}
