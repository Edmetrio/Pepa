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
use Livewire\WithPagination;

class Permissaos extends Component
{
    use WithPagination;
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
        $permissao = Permissao::with('rotas','roles')->orderBy('created_at', 'desc')->paginate(5);
        $this->rota = Rota::orderBy('created_at', 'desc')->get();
        $this->role = Role::orderBy('created_at', 'desc')->get();
        return view('livewire.permissaos', compact('permissao'))->layout('layouts.appD');
    }
}
