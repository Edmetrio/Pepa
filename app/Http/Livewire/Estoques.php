<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Estoque;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use Livewire\Component;
use Livewire\WithPagination;

class Estoques extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $pais_id, $provincia_id, $distrito_id, $quantidade, $produto_id;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;
    public $selectedCategoria = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->categoria = Categoria::orderBy('created_at', 'desc')->get();
        $this->produtos = collect();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        $estoque = Estoque::with('pais','provincias','distritos','produtos')->paginate(5);
        return view('livewire.estoques', compact('estoque'))->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->quantidade = '';
        $this->valor = '';
        $this->selectedPais = '';
        $this->selectedProvincia = '';
        $this->selectedCategoria = ' ';
        $this->produto_id = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'selectedPais' => 'required',
            'selectedProvincia' => 'required',
            'distrito_id' => 'required',
            'selectedCategoria' => 'required',
            'produto_id' => 'required',
            'quantidade' => 'required',
        ]);
        
        $input = $validatedDate;
        $input['pais_id'] = $this->selectedPais;
        $input['provincia_id'] = $this->selectedProvincia;
        $input['categoria_id'] = $this->selectedCategoria;
        /* dd($input); */
        Estoque::create($input);

        session()->flash('message', 'Estoque criada com sucesso!');
  
        $this->resetInputFields(); 
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

    public function updatedSelectedCategoria($categoria_id)
    {
        if (!is_null($categoria_id)) {
                $this->produtos = Produto::where('categoria_id', $categoria_id)->get(); 
        }
    }
}
