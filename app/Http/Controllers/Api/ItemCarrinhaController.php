<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Estoque;
use App\Models\Models\Itemcarrinha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemCarrinhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Itemcarrinha::with('produtos', 'users', 'distritos', 'enderecos', 'unidades')->where('users_id', Auth::user()->id)->get();
        $tt = 0.0;
        foreach ($item as $itens) {
            $itens->subtotal = $itens->quantidade * $itens->produtos->preco_retalho;
            $tt += $itens->subtotal;
        }
        $item->total = $tt;
        return $item;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $estoque = Estoque::where('produto_id', $request->produto_id)->where('distrito_id', $request->distrito_id)->first();
        $request->validate([
            'produto_id' => 'required',
            'distrito_id' => 'required',
            'quantidade' => 'required',
        ]);
        if ($estoque) {
            if ($estoque->quantidade >= $request->quantidade) {
                $qts = $estoque->quantidade - $request->quantidade;
                $estoque->update(['quantidade' => $qts]);
                $input = $request->all();
                $input['users_id'] = Auth::user()->id;
                Itemcarrinha::create($input);
                return ["resultado" => "Produto adicionado! Verifica carrinha"];
            } else {
                return ["resultado" => "Quantidade Inexistente no Estoque"];
            }
        } else {
            return ["resultado" => "Produto não encontrado no Estoque"];
        }

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
        $item = Itemcarrinha::findOrFail($id);
        $estoque = Estoque::where('produto_id', $item->produto_id)->where('distrito_id', $item->distrito_id)->first();
        $total = 0.0;
        if ($item->quantidade > $request->quantidade) {
            $qts = $item->quantidade + $request->quantidade;
            $total = $qts;
        } else {
            $qts = $item->quantidade - $request->quantidade;
            $total = $qts;
        }
        dd($total);
        
    }   

    public function destroy($id)
    {
        $item = Itemcarrinha::findOrFail($id);
        $estoque = Estoque::where('produto_id', $item->produto_id)->where('distrito_id', $item->distrito_id)->first();
        $estoque->update(['quantidade' => $item->quantidade]);
        Itemcarrinha::findOrFail($id)->delete();
        return ["resultado" => "Produto removido da carrinha"];
    }
}
