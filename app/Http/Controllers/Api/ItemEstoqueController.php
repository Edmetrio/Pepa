<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Estoque;
use App\Models\Models\Itemestoque;
use App\Models\User;
use Illuminate\Http\Request;

class ItemEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('estoques.produtos')->orderBy('created_at', 'desc')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* $request->validate([
            'quantidade' => 'required',
            'valor' => 'required',
        ]); */
        /* dd($request->all()); */
        $input = $request->all();
        $estoque = Estoque::where('produto_id', $request->produto_id)->where('distrito_id', $request->distrito_id)->first();
        $input['users_id'] = '5dc51703-d195-43fd-a3de-0c74ba9c8ad6';
        if (isset($estoque)) {
            $input['estoque_id'] = $estoque->id;
            $quantidade = $estoque->quantidade + $request->quantidade;
            $estoque->update(['quantidade' => $quantidade]);
            Itemestoque::create($input);
            return ["resultado" => "Entrada do produto no estoque com sucesso"];
        } else {
            $estoquee = Estoque::create($request->all());
            $input['estoque_id'] = $estoquee->id;
            Itemestoque::create($input);
            return ["resultado" => "Entrada e criação do estoque com sucesso"];
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
