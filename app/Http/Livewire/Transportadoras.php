<?php

namespace App\Http\Livewire;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Itemtransportadora;
use App\Models\Models\Produto;
use App\Models\Models\Situacaotrans;
use App\Models\Models\Transportadora;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Transportadoras extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $situacaotrans_id;
    public function render()
    {
        $transportadora = Itemtransportadora::with('users','transportadoras', 'situacaos')->orderBy('created_at', 'desc')->paginate(5);
        $this->situacao = Situacaotrans::orderBy('created_at', 'desc')->get();
        return view('livewire.transportadoras', compact('transportadora'))->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->situacaotrans_id = '';
    }

    public function edit($id)
    {
        $post = Itemtransportadora::findOrFail($id);
        $this->post_id = $id;
        $this->situacaotrans_id = $post->situacaotrans_id;
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
            'situacaotrans_id' => 'required',
        ]);
        $post = Itemtransportadora::find($this->post_id);
        $post->update([
            'situacaotrans_id' => $this->situacaotrans_id,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Situação actualizada com sucesso');
        $this->resetInputFields();
    }
}
