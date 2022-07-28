<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Estoque;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Null_;

class Importados extends Component
{

    public $categorias;
    public $selectedCategoria = NULL;
    public $pais;
    public $provincias;
    public $distritos;

    public $selectedPais = NULL;
    public $selectedProvincias = NULL;
    public $selectedDistritos= NULL;

    public function mount()
    {
        $this->categoria = Categoria::orderBy('created_at', 'desc')->get();
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
        
    }

    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query){
            if(auth()->check()){
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;

        $produto = Produto::with('distritos')->orderBy('created_at', 'desc')->get();
        
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.importados', compact('produto'))->layout('layouts.app', compact('produto','categoria','item'));
    }

    public function updatedSelectedCategoria($categoria_id)
    {
        if (!is_null($categoria_id)) {
            $this->produto = Produto::where('categoria_id', $categoria_id)->get();
        }
    }

    public function updatedSelectedPais($pais_id)
    {
        if (!is_null($pais_id)) {
            $this->provincias = Provincia::where('pais_id', $pais_id)->get();
        }
    }

    public function updatedSelectedProvincias($provincia_id)
    {
        if (!is_null($provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $provincia_id)->get();
        }
    }

    public function updatedSelectedDistritos($distrito_id)
    {
        if (!is_null($distrito_id)) {
            $this->produtos = Estoque::with('produtos')->where('distrito_id', $distrito_id)->get();
            /* dd($this->produtos); */
        }
    }

}
