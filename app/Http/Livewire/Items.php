<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Distrito;
use App\Models\Models\Endereco;
use App\Models\Models\Estoque;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Pais;
use App\Models\Models\Produto;
use App\Models\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Items extends Component
{
    protected $listeners = ['remove'];

    public $users_id, $produto_id, $pais_id, $provincia_id, $distrito_id, $endereco_id, $unidade_id, $quantidade, $transporte;
    public $pais, $provincias, $distritos, $quantidades;

    public $selectedPais = NULL;
    public $selectedProvincia = NULL;
    public $selectedDistrito = NULL;
    public $show = false;

    public function mount($id)
    {
        $this->itens = Produto::with('categorias')->findOrFail($id);
    
        $this->produtos = Produto::where('categoria_id', $this->itens->categoria_id)->get();
        /* dd($this->produtos); */
        $this->produto_id = $this->itens->id;
        $this->provincias = collect();
        $this->distritos = collect();
        $this->quantidades = collect();
    }

    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where(function ($query) {
            if (auth()->check()) {
                $query->where('users_id', Auth::user()->id);
            }
        })->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;

        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        /* $this->provincia = Provincia::orderBy('created_at', 'desc')->get(); */
        $this->distrito = Distrito::orderBy('created_at', 'desc')->get();
        $this->endereco = Endereco::where('users_id', Auth::user()->id)->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();

        return view('livewire.items', compact('produto', 'categoria'))->layout('layouts.app', compact('produto', 'categoria', 'item'));
    }

    public function store()
    {
        $estoque = Estoque::where('produto_id', $this->produto_id)->where('distrito_id', $this->distrito_id)->first();
        $validatedDate = $this->validate([
            'quantidade' => 'required',
        ]);
        $validatedDate['users_id'] = Auth::user()->id;
        $validatedDate['produto_id'] = $this->produto_id;
        $validatedDate['distrito_id'] = $this->distrito_id;
        $validatedDate['endereco_id'] = $this->endereco_id;
        $validatedDate['unidade_id'] = 'a0fb62b9-36f0-4f74-a2e1-83ea7240be76';
        $validatedDate['transporte'] = $this->transporte;
        $validatedDate['estado'] = 'reservado';
        if ($estoque) {
            if ($estoque->quantidade >= $this->quantidade) {
                $qts = $estoque->quantidade - $this->quantidade;
                $estoque->update(['quantidade' => $qts]);

                Itemcarrinha::create($validatedDate);
                $this->alertSuccess();
                return redirect(Route('inicio'));
            } else {
                $this->error();
            }
        } else {
            $this->errorproduto();
        }
    }

    public function transporte($id)
    {
        if ($id === true) {
            $this->show = true;
        } else {
            $this->show = false;
        }  
    }

    public function updatedSelectedPais($pais_id)
    {
        if (!is_null($pais_id)) {
                $this->provincias = Provincia::where('pais_id', $pais_id)->get();
                /* $this->provincias = Estoque::with('provincias')->where('pais_id', $pais_id)->where('produto_id', $this->produto_id)->get(); 
                dd($this->provincias); */
            }
    }

    public function updatedSelectedProvincia($provincia_id)
    {
        if (!is_null($provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $provincia_id)->get();
            /* $this->distritos = Estoque::with('distritos')->where('provincia_id', $provincia_id)->where('produto_id', $this->produto_id)->get();
            dd( $this->distritos); */
        }
    }

    public function updatedSelectedDistrito($distrito_id)
    {
        if (!is_null($distrito_id)) {
            if (Estoque::where('distrito_id', $distrito_id)) {
                $this->quantidades = Estoque::where('distrito_id', $distrito_id)->where('produto_id', $this->produto_id)->first();
                $this->distrito_id = $distrito_id;
            }
            
        }
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Item adicionado!',
            'text' => 'Por favor, verifica a carrinha.'
        ]);
    }

    public function error()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'error',
            'message' => 'Quantidade Inexistente!',
            'text' => 'Por favor, essa quantidade a plataforma não dispõe.'
        ]);
    }

    public function errorproduto()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'error',
            'message' => 'Produto não encontrado!',
            'text' => 'Por favor, essa quantidade a plataforma não dispõe.'
        ]);
    }

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'If deleted, you will not be able to recover this imaginary file!'
        ]);
    }

    public function remove()
    {
        /* Write Delete Logic */
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'User Delete Successfully!',
            'text' => 'It will not list on users table soon.'
        ]);
    }

    public function delete($id)
    {
        dd($id);
        /* Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.'); */
    }
}
