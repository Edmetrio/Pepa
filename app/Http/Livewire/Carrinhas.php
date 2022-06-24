<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Carrinhas extends Component
{
    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where('users_id', Auth::user()->id)->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;
        /* dd($item); */
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('livewire.carrinhas', compact('categoria','produto','item'))->layout('layouts.app', compact('produto', 'categoria','item'));
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

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Tem certeza?', 
                'text' => 'If deleted, you will not be able to recover this imaginary file!'
            ]);
    }

    public function remove()
    {
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'User Delete Successfully!', 
                'text' => 'It will not list on users table soon.'
            ]);
    }
}
