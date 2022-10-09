<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Role;
use App\Models\Models\Rota;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;
    public $nome, $post_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->nome = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nome' => 'required|unique:role,nome',
        ]);
        Role::create($validatedDate);
  
        session()->flash('message', 'Role criada com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Role::findOrFail($id);
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
  
        $post = Role::find($this->post_id);
        $post->update([
            'nome' => $this->nome,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Role actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'Role apagada com sucesso.');
    }

    public function render()
    {
        $role = Role::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.roles', compact('role'))->layout('layouts.appD');
    }
}
