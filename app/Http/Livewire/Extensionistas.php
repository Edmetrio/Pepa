<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Extensionistafornecedor;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Situacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Extensionistas extends Component
{
    public $updateMode = false;
    public $situacao_id;
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

        $this->extensionista = Extensionistafornecedor::with('users','extensionistas','situacaos')->orderBy('created_at', 'desc')->get();
        $this->situacao = Situacao::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.extensionistas')->layout('layouts.app', compact('produto','categoria','item'));
    }

    private function resetInputFields()
    {
        $this->situacao_id = '';
    }

    public function edit($id)
    {
        $post = Extensionistafornecedor::findOrFail($id);
        $this->post_id = $id;
        $this->situacao_id = $post->situacao_id;
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
            'situacao_id' => 'required',
        ]);
  
        $post = Extensionistafornecedor::find($this->post_id);
        $post->update([
            'situacao_id' => $this->situacao_id,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Situação actualizada com sucesso');
        $this->resetInputFields();
    }
}
