<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Distritoestoque;
use App\Models\Models\Estoque;
use App\Models\Models\Pais;
use App\Models\Models\Paisestoque;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use App\Models\Models\Provinciaestoque;
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
        $estoque = Estoque::with('pais', 'provincias', 'distritos', 'produtos')->paginate(5);
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
        //Verificar Existência de Produto e Distrito
        if (Estoque::where('distrito_id', $this->distrito_id)->where('produto_id', $this->produto_id)->exists()) {
            session()->flash('message', 'Estoque Existente!');
        } else {
            //Criação do Estoque
            $estoque = Estoque::create($input);
            $inputEstoque = $input;
            $inputEstoque['estoque_id'] = $estoque->id;

            $estoqueId = Estoque::findOrFail($estoque->id);

            if (Paisestoque::where('pais_id', $estoqueId->pais_id)->exists()) {
                session()->flash('message', 'País Inexistente!');
            } else {
                Paisestoque::create($inputEstoque);
            }

            if (Provinciaestoque::where('provincia_id', $estoqueId->provincia_id)->exists()) {
                session()->flash('message', 'Província Existente!');
            } else {
                Provinciaestoque::create($inputEstoque);
            }

            if (Distritoestoque::where('pais_id', $estoqueId->pais_id)
            ->where('provincia_id', $estoqueId->provincia_id)
            ->where('distrito_id', $estoqueId->distrito_id)
            ->exists()) 
            {
                session()->flash('message', 'País Existente!');
            } else {
                Distritoestoque::create($inputEstoque);
            }
            
            session()->flash('message', 'Estoque criado com sucesso!');
            
            /* if (Distritoestoque::where('pais_id', $estoqueId->pais_id)
                ->where('provincia_id', $estoqueId->provincia_id)
                ->where('distrito_id', $estoqueId->distrito_id)
                ->exists()
            ) {
            session()->flash('message', 'Produto e Distrito Existente!');
            } else {
                Distritoestoque::create($inputEstoque);
            }
            session()->flash('message', 'Estoque criado com sucesso!'); */
        }

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
