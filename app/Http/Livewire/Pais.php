<?php

namespace App\Http\Livewire;

use App\Models\Models\Pais as ModelsPais;
use Livewire\Component;
use Livewire\WithPagination;

class Pais extends Component
{
    use WithPagination;
    public $nome, $pais_id;
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
        ModelsPais::create($validatedDate);
  
        session()->flash('message', 'Pais criado com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $pais = ModelsPais::findOrFail($id);
        $this->pais_id = $id;
        $this->nome = $pais->nome;
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
  
        $post = ModelsPais::find($this->pais_id);
        $post->update([
            'nome' => $this->nome,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'País actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        ModelsPais::find($id)->delete();
        session()->flash('message', 'País apagado com sucesso.');
    }

    public function render()
    {
        $pais = ModelsPais::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.pais', compact('pais'))->layout('layouts.appD');   
    }
}
