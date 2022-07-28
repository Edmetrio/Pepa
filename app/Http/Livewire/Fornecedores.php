<?php

namespace App\Http\Livewire;

use App\Mail\FormularioMail;
use App\Models\Models\Distrito;
use App\Models\Models\Endereco;
use App\Models\Models\Fornecedor;
use App\Models\Models\Pais;
use App\Models\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Fornecedores extends Component
{
    public $users_id, $pais_id, $distrito_id, $nome, $quantidade, $categoria, $produto, $montante, $observacao;
    public $selectedPais = NULL;
    public $selectedProvincia = NULL;

    public function mount()
    {
        $this->pais = Pais::orderBy('created_at', 'desc')->get();
        $this->provincias = collect();
        $this->distritos = collect();
    }

    public function render()
    {
        $f = Fornecedor::with('users.telefones','users.enderecos','distritos.provincias.pais')->get();
        return view('livewire.fornecedores')->layout('layouts.appD');
    }

    private function resetInputFields()
    {
        $this->quantidade = '';
        $this->montante = '';
        $this->selectedPais = '';
        $this->selectedProvincia = '';
        $this->categoria = '';
        $this->produto = '';
        $this->nome = '';
        $this->observacao = '';
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

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Formulário preenchido com sucesso!',
            'text' => 'Por favor, verifica o seu e-mail.'
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'selectedPais' => 'required',
            'selectedProvincia' => 'required',
            'distrito_id' => 'required',
            'nome' => 'required',
            'categoria' => 'required',
            'produto' => 'required',
            'quantidade' => 'required',
            'montante' => 'required',
            'observacao' => 'required'
        ]);
        
        $input = $validatedDate;
        $input['users_id'] = Auth::user()->id;

        $f = Fornecedor::create($input);
        Endereco::create($input);

        $details = Fornecedor::with('users.enderecos','users.telefones','distritos.provincias.pais')->findOrFail($f->id);

        Mail::to('admin@firsteducation.edu.mz')->send(new FormularioMail($details));
        Mail::to('extensionista@firsteducation.edu.mz')->send(new FormularioMail($details));
        $this->alertSuccess();
  
        $this->resetInputFields(); 
    }
}
