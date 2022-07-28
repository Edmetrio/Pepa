<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Inicios extends Component
{
    use WithPagination;
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
        $produto = Produto::orderBy('created_at', 'asc')->paginate(4);
        $produtos = Produto::orderBy('created_at', 'desc')->paginate(8);
        /* $this->produtos = Produto::orderBy('created_at', 'desc')->get(); */
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.inicios', compact('categoria','produto','produtos'))->layout('layouts.app', compact('produto','categoria','item'));
    }

    public function delete($id)
    {
        $item = Itemcarrinha::findOrFail($id);
        $item->delete();
        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Item apagado!',
            'text' => 'O Item foi apagado com sucesso.'
        ]);
    }

}
