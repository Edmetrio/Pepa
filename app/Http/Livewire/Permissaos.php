<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Permissao;
use App\Models\Models\Produto;
use App\Models\Models\Role;
use App\Models\Models\Rota;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Permissaos extends Component
{
    public $role_id, $rota_id, $post_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->role_id = '';
        $this->rota_id = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'role_id' => 'required',
            'rota_id' => 'required',
        ]);
        Permissao::create($validatedDate);
  
        session()->flash('message', 'Permissão criada com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Permissao::findOrFail($id);
        $this->post_id = $id;
        $this->role_id = $post->role_id;
        $this->rota_id = $post->rota_id;
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
            'role_id' => 'required',
            'rota_id' => 'required',
        ]);
  
        $post = Permissao::find($this->post_id);
        $post->update([
            'role_id' => $this->role_id,
            'rota_id' => $this->rota_id,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Permissão actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Permissao::find($id)->delete();
        session()->flash('message', 'Permissão apagada com sucesso.');
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

        $this->permissao = Permissao::with('rotas','roles')->orderBy('created_at', 'desc')->get();
        /* dd($this->permissao); */
        $this->rota = Rota::orderBy('created_at', 'desc')->get();
        $this->role = Role::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.permissaos')->layout('layouts.app', compact('produto','categoria','item'));
    }
}
