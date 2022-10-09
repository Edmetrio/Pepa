<?php

namespace App\Http\Livewire;

use App\Models\Models\Distrito;
use App\Models\Models\Pais;
use App\Models\Models\Provincia;
use Livewire\Component;

class Distritos extends Component
{
    public $updateMode = false;
    public $pais_id, $provincia_id, $nome;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
    }
    public function render()
    {
        $distrito = Distrito::with('provincias.pais')->orderBy('created_at', 'desc')->paginate(5);
        /* dd($distrito); */
        return view('livewire.distritos', compact('distrito'))->layout('layouts.appD'); 
    }

    private function resetInputFields()
    {

        $this->nome = '';
        $this->selectedPais = '';
        $this->selectedProvincia = '';
        
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'selectedPais' => 'required',
            'selectedProvincia' => 'required',
            'nome' => 'required',
        ]);
        $validatedDate['provincia_id'] = $this->selectedProvincia;
        $input = $validatedDate;
        Distrito::create($input);
  
        session()->flash('message', 'Província criada com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Distrito::findOrFail($id);
        $this->distrito_id = $id;
        $this->provincia_id = $post->provincia_id;
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
            'selectedProvincia' => 'required',
            'nome' => 'required'
        ]);
  
        $post = Distrito::find($this->distrito_id);
        $post->update($validatedDate);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Distrito actualizado com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Distrito::find($id)->delete();
        session()->flash('message', 'Distrito apagado com sucesso.');
    }

    public function updatedSelectedPais($pais_id)
    {
        if (!is_null($pais_id)) {
                $this->provincias = Provincia::where('pais_id', $pais_id)->get(); 
        }
    }
}
