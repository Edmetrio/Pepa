<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Rota;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Rotas extends Component
{
    use WithPagination;
    public $nome, $post_id;
    public $updateMode = false;
    public $search = '';

    private function resetInputFields()
    {
        $this->nome = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nome' => 'required|unique:rota, nome',
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
        $rota = Rota::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.rotas', compact('rota'))->layout('layouts.appD');
    }
}
