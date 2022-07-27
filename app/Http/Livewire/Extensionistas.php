<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Extensionistafornecedor;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Produto;
use App\Models\Models\Situacao;
use App\Models\Models\Telefone;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Extensionistas extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $situacao_id, $telefones;
    public function render()
    {
        $extensionista = Extensionistafornecedor::with('users.telefones.carteiras','extensionistas','situacaos')->orderBy('created_at', 'desc')->paginate(2);
        $this->situacao = Situacao::orderBy('created_at', 'desc')->get();
        return view('livewire.extensionistas', compact('extensionista'))->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->situacao_id = '';
    }

    public function edit($id)
    {
        $post = Extensionistafornecedor::findOrFail($id);
        $this->post_id = $id;
        $this->situacao_id = $post->situacao_id;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'situacao_id' => 'required',
        ]);
  
        $post = Extensionistafornecedor::find($this->post_id);
        $post->update([
            'situacao_id' => $this->situacao_id,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Situação actualizada com sucesso');
        $this->resetInputFields();
    }
}
