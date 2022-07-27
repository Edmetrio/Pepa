<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Itemestoque;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use App\Models\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Entradas extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $pais_id, $provincia_id, $distrito_id, $quantidade, $valor, $users_id, $produto_id;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;
    public $selectedCategoria = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->categoria = Categoria::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
        $this->distritos = collect();
        $this->produtos = collect();
    }

    public function render()
    {
        $user = Role::where('nome', 'fornecedor')->first();
        $this->users = User::where('role_id', $user->id)->get();
        $item = Itemestoque::with('usersFor','users', 'estoques.produtos')->get();
        return view('livewire.entradas', compact('item'))->layout('layouts.appD');
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
