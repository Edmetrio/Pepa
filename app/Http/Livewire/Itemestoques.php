<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Estoque;
use App\Models\Models\Fornecedor;
use App\Models\Models\Itemestoque;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use App\Models\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Itemestoques extends Component
{   
    public $updateMode = false;
    public $pais_id, $provincia_id, $distrito_id, $quantidade, $produto_id, $valor, $usersFor_id;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;
    public $selectedCategoria = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->categoria = Categoria::orderBy('created_at', 'desc')->get();
        $user = Role::where('nome', 'fornecedor')->first();
        $this->fornecedor = User::where('role_id', $user ->id)->orderBy('created_at', 'desc')->get();
        $this->produtos = collect();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        $itemestoque = Itemestoque::with('userss','estoques.produtos','usersc')->orderBy('created_at', 'desc')->get();
        /* dd($itemestoque); */
        return view('livewire.itemestoques', compact('itemestoque'))->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->quantidade = '';
        $this->valor = '';
        $this->selectedPais = '';
        $this->selectedProvincia = '';
        $this->selectedCategoria = ' ';
        $this->produto_id = '';
        $this->usersFor_id = '';
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
            'usersFor_id' => 'required',
            'valor' => 'required',
        ]);
        $input = $validatedDate;
        $estoque = Estoque::with('produtos','distritos')->where('distrito_id', $this->distrito_id)->where('produto_id', $this->produto_id)->first();
        if ($estoque) {
            $input['estoque_id'] = $estoque->id;
            $input['users_id'] = Auth::user()->id;
            Itemestoque::create($input);
            $qts = $estoque->quantidade + $this->quantidade;
            $estoque->update(['quantidade' => $qts]);
            session()->flash('message', 'Estoque aumentado!');
        } else {
            session()->flash('message', 'Produto e Distrito não encontrado!');
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
