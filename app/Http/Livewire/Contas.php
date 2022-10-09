<?php

namespace App\Http\Livewire;

use App\Models\Models\Carteira;
use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Encomenda;
use App\Models\Models\Endereco;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Itemencomenda;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use App\Models\Models\Telefone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Contas extends Component
{
    public $pais_id, $provincia_id, $distrito_id, $nome, $carteira_id, $numero;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;
    public $historico = false, $contacto = false, $pagamento = false, $endereco = false;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        $this->encomenda = Encomenda::with('produtos')->where('users_id', Auth::user()->id)->get();
        $ttt = 0.0;
        foreach($this->encomenda as $e)
        {
            /* dd($e); */
            foreach($e->produtos as $item)
            {
                $item->subtotal = $item->pivot->quantidade * $item->preco_retalho;
                $ttt += $item->subtotal;
            }
        }
        $this->encomenda->total = $ttt;
        /* dd($this->encomenda); */

        $this->itemencomenda = Itemencomenda::with('encomendas','produtos','distritos','enderecos','unidades')->get();
        $tt = 0.0;
        foreach($this->itemencomenda as $itens)
        {
           $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $this->itemencomenda->total = $tt;
        /* dd($this->itemencomenda); */
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

        $this->telefone = Telefone::with('carteiras')->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $this->endereco = Endereco::with('distritos.provincias.pais')->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        /* dd($this->endereco); */
        $this->carteira = Carteira::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.contas')->layout('layouts.app', compact('produto', 'categoria', 'item'));
    }

    public function press()
    {
        if (isset($this->contacto)) {
            $this->contacto = true;
        } else {
            dd('false');
        }
        
    }

    public function item()
    {
        $this->item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query){
            if(auth()->check()){
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($this->item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $this->item->total = $tt;
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

    public function addEndereco()
    {
        $validatedDate = $this->validate([
            'nome' => 'required',
            'distrito_id' => 'required'
        ]);

        Endereco::create($validatedDate);
    }

    public function storeT()
    {
        $validatedDate = $this->validate([
            'numero' => 'required',
            'carteira_id' => 'required'
        ]); 
        dd($validatedDate);
    }
}
