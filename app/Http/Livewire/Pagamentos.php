<?php

namespace App\Http\Livewire;

use App\Mail\PagamantoMail;
use App\Models\Models\Categoria;
use App\Models\Models\Encomenda;
use App\Models\Models\Formapagamento;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Itemencomenda;
use App\Models\Models\Itemtransportadora;
use App\Models\Models\Produto;
use App\Models\Models\Transportadora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Pagamentos extends Component
{
    public $formapagamento_id, $numero, $transporte, $code;
    public $mostrar = false;
    public $selectedState = NULL;

    public function render()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where('users_id', Auth::user()->id)->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;
        $item->totaltransporte = $this->totaltransporte($item);
        $item->ttotal = $tt + $this->totaltransporte($item);
        /* dd($item); */
        $this->pagamento = Formapagamento::orderBy('created_at', 'desc')->get();
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();

        return view('livewire.pagamentos', compact('item'))->layout('layouts.app', compact('produto', 'categoria', 'item'));
    }

    /* public function gerador()
    {
        do {
            $code = random_int(1, 9999);
        } while (Encomenda::where('numero', $code));
        return $code;
    } */

    public function subtotal($item)
    {
        return $item->produtos->preco_retalho * $item->quantidade;
    }

    public function transporte($item)
    {
        $tt = 0.0;
        if ($item->transporte === '1') {
            $subtotal = $item->produtos->preco_retalho * $item->quantidade;
            $total = $subtotal * 0.2;
            $tt += $total; 
        } else {
           
        }
        return $tt;
    }

    public function totalencomenda($item)
    {
        $total = 0.0;
        foreach ($item as $i) {
            $total += $this->subtotal($i);
        }
        return $total;
    }

    public function totaltransporte($item)
    {
        $total = 0.0;
        foreach($item as $it)
        {
            $total += $this->transporte($it);
        }
        return $total;
    }

    

    public function store()
    {
        $validatedDate = $this->validate([
            'formapagamento_id' => 'required',
        ]);


        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where('users_id', Auth::user()->id)->get();

        foreach ($item as $itens) {
            $itens->subtotal = $this->subtotal($itens);
            $itens->transporte = $this->transporte($itens);
            
        }
        $item->total = $this->totalencomenda($item);
       /*  dd($item); */
        /* $code = random_int(100, 99); */
      
        $validatedDate['valor'] = $item->total;
        $validatedDate['users_id'] = Auth::user()->id;
        $validatedDate['numero'] = random_int(1, 9999);
        $validatedDate['moeda_id'] = '876169f2-260c-46fc-833e-9d155f3894k9';
        $encomenda = Encomenda::create($validatedDate);
        foreach ($item as $i) {

            $transportadora = Transportadora::with('users', 'distritos')->where('distrito_id', $i->distrito_id)->first();
            if ($i->transporte === '1') {
                Itemtransportadora::create([
                    'users_id' => Auth::user()->id,
                    'transportadora_id' => $transportadora->id,
                    'situacaotrans_id' => 'k9fb62b9-36f0-4f74-a2e1-83ea7240be76',
                ]);
            }
            $details = $i;
            Mail::to('admin@firsteducation.edu.mz')->send(new PagamantoMail($details));
            Mail::to('transportadora@firsteducation.edu.mz')->send(new PagamantoMail($details));

            Itemencomenda::create([
                'encomenda_id' => $encomenda->id,
                'produto_id' => $i->produto_id,
                'distrito_id' => $i->distrito_id,
                'endereco_id' => $i->endereco_id,
                'unidade_id' => $i->unidade_id,
                'quantidade' => $i->quantidade,
                'transporte' => $i->transporte
            ]);
            $i->delete();
        }
        $this->alertSuccess();
        return redirect(Route('inicio'));
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Encomenda efectuada!',
            'text' => 'Por favor, verifica o seu histórico.'
        ]);
    }
}
