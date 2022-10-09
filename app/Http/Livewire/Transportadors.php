<?php

namespace App\Http\Livewire;

use App\Models\Models\Distrito;
use App\Models\Models\Pais;
use App\Models\Models\Provincia;
use App\Models\Models\Transportadora;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transportadors extends Component
{
    public $updateMode = false;
    public $pais_id, $provincia_id, $distrito_id, $nome;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        $transportador = Transportadora::orderBy('created_at', 'desc')->get();
        return view('livewire.transportadors', compact('transportador'))->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->distrito_id = '';
        $this->nome = '';
        $this->users_id = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'distrito_id' => 'required',
            'nome' => 'required',
        ]);

        $validatedDate['users_id'] = Auth::user()->id;
        Transportadora::create($validatedDate);
  
        session()->flash('message', 'Transpotador criado com sucesso!');
  
        $this->resetInputFields(); 
    }

    public function edit($id)
    {
        $post = Transportadora::findOrFail($id);
        $this->post_id = $id;
        $this->distrito_id = $post->distrito_id;
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
            'distrito_id' => 'required',
            'nome' => 'required'
        ]);
  
        $post = Transportadora::find($this->post_id);
        $post->update($validatedDate);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Transportador actualizado com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Transportadora::find($id)->delete();
        session()->flash('message', 'Transportador apagado com sucesso.');
    }

    public function updatedSelectedPais($pais_id)
    {
        if (!is_null($pais_id)) {
                $this->provincias = Provincia::where('pais_id', $pais_id)->get(); 
        }
    }

    public function updatedSelectedProvincia($provincia_id)
    {
        if (!is_null($provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $provincia_id)->get();
        }
    }
}
