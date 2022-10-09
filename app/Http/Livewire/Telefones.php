<?php

namespace App\Http\Livewire;

use App\Models\Models\Carteira;
use App\Models\Models\Categoria;
use App\Models\Models\Telefone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Telefones extends Component
{
    public $updateMode = false;
    public $users_id, $carteira_id, $numero, $carteira;

    public function render()
    {
        $this->carteira = Carteira::orderBy('created_at', 'desc')->get();
        $this->telefone = Telefone::with('carteiras')->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
      
        return view('livewire.telefones')->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->carteira_id = '';
        $this->numero = '';
        $this->users_id = '';
    }

    public function edit($id)
    {
        $post = Telefone::with('carteiras')->findOrFail($id);
        /* dd($post); */
        $this->post_id = $id;
        $this->carteira_id = $post->carteira_id;
        $this->numero = $post->numero;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'carteira_id' => 'required',
            'numero' => 'required',
        ]);
        $validatedDate['users_id'] = Auth::user()->id;
        Telefone::create($validatedDate);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Telefone adicionado com sucesso');
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'carteira_id' => 'required',
            'numero' => 'required'
        ]);
  
        $post = Telefone::find($this->post_id);
        $post->update($validatedDate);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Telefone actualizado com sucesso');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Telefone::find($id)->delete();
        session()->flash('message', 'Telefone apagado com sucesso.');
    }
}
