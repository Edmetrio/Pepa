<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Encomenda;
use App\Models\Models\Itemcarrinha;
use App\Models\Models\Itemencomenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Itemencomenda::with('encomendas','produtos','distritos','enderecos','unidades')->get();
        $tt = 0.0;
        foreach($item as $itens)
        {
           $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;
        $item->totaltransporte = $this->totaltransporte($item);
        $item->ttotal = $tt + $this->totaltransporte($item);
        /* dd($item); */
        return $item;
    }

    public $nome = 'Edmetrio';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
    
    public function store(Request $request)
    {
        $input = $request->all();
        $item = Itemcarrinha::with('produtos','users','distritos','enderecos','unidades')->where('users_id', Auth::user()->id)->get();
        
        foreach($item as $itens)
        {
           $itens->subtotal = $this->subtotal($itens);
        }
        $item->total = $this->totalencomenda($item);
        $input['valor'] = $item->total;
        $input['users_id'] = Auth::user()->id;
        $encomenda = Encomenda::create($input);
        foreach($item as $i)
        {
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
        return ["resultado" => "Encomenda Efectuada com sucesso!"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
