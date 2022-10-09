<?php

namespace App\Http\Livewire;

use App\Models\Models\Estoque;
use App\Models\Models\Itemcarrinha;
use App\Models\User;
use Livewire\Component;

class Itemcarrinhas extends Component
{
    public $users, $produto;
    public $Mode = true;

    public $selectedUsers = NULL;

    public function mount()
    {
        $this->user = User::orderBy('created_at', 'desc')->get();
    }

    public function delete($id)
    {
        $item = Itemcarrinha::findOrFail($id);
        $estoque = Estoque::where('distrito_id', $item->distrito_id)->where('produto_id', $item->produto_id)->first();
        if($estoque)
        {
            $qts = $item->quantidade + $estoque->quantidade;
            $estoque->update([
                'quantidade' => $qts,
            ]);
            $item->delete();
            session()->flash('message', 'Item Removido da Carrinha.');
        } else {
            session()->flash('message', 'Item Carrinha não encontrado.');
        }
    }

    public function render()
    {
        $item = Itemcarrinha::with('users','produtos','distritos.provincias.pais','enderecos','unidades')->orderBy('created_at', 'desc')->paginate(5);
        /* dd($item); */
        return view('livewire.itemcarrinhas', compact('item'))->layout('layouts.appD');
    }

    /* public function delete($id)
    {
        $user = User::findOrFail($id);
        dd($user);
        session()->flash('message', 'País apagado com sucesso.');
    } */


    public function updatedSelectedUsers($users_id)
    {
        if (!is_null($users_id)) {
            $this->Mode = false;
            $this->users = Itemcarrinha::with('users','produtos','distritos.provincias.pais','enderecos','unidades')->where('users_id', $users_id)->orderBy('created_at', 'desc')->get();       
        }
    }
}
