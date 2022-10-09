<?php

namespace App\Http\Livewire;

use App\Models\Models\Pais;
use App\Models\Models\Provincia;
use Livewire\Component;
use Livewire\WithPagination;

class Provincias extends Component
{
    use WithPagination;
    public $pais_id, $nome, $provincia_id;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->nome= '';
        $this->pais_id = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'pais_id' => 'required',
            'nome' => 'required',
        ]);
        Provincia::create($validatedDate);
  
        session()->flash('message', 'Província criada com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Provincia::findOrFail($id);
        $this->provincia_id = $id;
        $this->pais_id = $post->pais_id;
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
            'pais_id' => 'required',
            'nome' => 'required',
        ]);
  
        $post = Provincia::find($this->provincia_id);
        $post->update([
            'pais_id' => $this->pais_id,
            'nome' => $this->nome,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'ProvÍncia actualizada com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Provincia::find($id)->delete();
        session()->flash('message', 'Província apagada com sucesso.');
    }

    public function render()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $provincia = Provincia::with('pais')->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.provincias', compact('provincia'))->layout('layouts.appD');
    }
}
