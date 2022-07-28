<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class FormCategorias extends Component
{
    use WithFileUploads;
    public $nome, $icon, $descricao, $post_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->nome = '';
        $this->icon = '';
        $this->descricao = '';
    }

    public function store()
    {
        $validateDate = $this->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048'
        ]);
        $validateDate['icon'] = $this->icon->store('files', 'public');
        dd($validateDate);
        
  
        session()->flash('message', 'Permissão criada com sucesso!');
  
        $this->resetInputFields(); 
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

        $this->categoria = Categoria::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.form-categorias')->layout('layouts.app', compact('produto','categoria','item'));
    }
}
