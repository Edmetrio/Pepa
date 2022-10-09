<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Noticia;
use App\Models\Models\Noticiacomentario;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Itemcomentarios extends Component
{
    use WithPagination;
    public $search = '';
    public $mensagem;
    public function mount($id)
    {
        /* dd($id); */
        $this->noticias = Noticia::findOrFail($id);
        /* dd($this->noticias->id); */
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
        $ultima = Noticia::whereNotIn('id', [$this->noticias->id])->orderBy('created_at', 'desc')->get();
        $ultimas = Noticia::whereNotIn('id', [$this->noticias->id])->where('nome', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc')->get();
        /* dd($ultimas); */
        $comentarios = Noticiacomentario::with('users')->where('noticia_id', $this->noticias->id)->paginate(1);
        /* dd($comentarios); */
        return view('livewire.itemcomentarios', compact('comentarios','ultimas'))->layout('layouts.app', compact('produto','categoria','item'));
    }

    public function limpar()
    {
        $this->mensagem = '';
    }
    public function store()
    {
        $validatedDate = $this->validate([
            'mensagem' => 'required'
        ]);

        $validatedDate['users_id'] = Auth::user()->id;
        $validatedDate['noticia_id'] = $this->noticias->id;

        Noticiacomentario::create($validatedDate);
        $this->limpar();
        session()->flash('status', 'Comentário adicionado!');
    }
}
