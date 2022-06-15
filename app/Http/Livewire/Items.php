<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Endereco;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Items extends Component
{
    public $produto_id, $distrito_id, $endereco_id, $unidade_id, $quantidade, $transporte;

    

    public function mount($id)
    {
        $this->itens = Produto::with('categorias')->findOrFail($id);
    }

    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query) {
            if (auth()->check()) {
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;

        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincia = Provincia::orderBy('created_at', 'desc')->get();
        $this->distrito = Distrito::orderBy('created_at', 'desc')->get();
        $this->endereco = Endereco::where('users_id', Auth::user()->id)->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.items', compact('produto', 'categoria'))->layout('layouts.app', compact('produto', 'categoria', 'item'));
    }

    public function store()
    {
        dd($this);
    }

    public function delete($id)
    {
        dd($id);
        /* Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.'); */
    }
}
