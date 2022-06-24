<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Rota;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Rotas extends Component
{
    public $nome, $post_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->nome = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nome' => 'required',
        ]);
        Rota::create($validatedDate);
  
        session()->flash('message', 'Rota criada com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Rota::findOrFail($id);
        $this->post_id = $id;
        $this->nome = $post->nome;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'nome' => 'required',
        ]);
  
        $post = Rota::find($this->post_id);
        $post->update([
            'nome' => $this->nome,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Rota actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Rota::find($id)->delete();
        session()->flash('message', 'Rota apagada com sucesso.');
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

        $this->rota = Rota::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.rotas')->layout('layouts.app', compact('produto','categoria','item'));
    }
}
