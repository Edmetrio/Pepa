<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'distrito_id' => 'required',
            'endereco' => 'required',
            'categoria' => 'required',
            'produto' => 'required',
            'quantidade' => 'required',
            'montante' => 'required',
            'observacao' => 'required',
        ]);

        dd(Auth::user()->id);
        $input = $request->all();
        $input['users_id'] = 'd2b4caf8-67b6-4429-b120-f9540608d9e1';
        
  
        $fornecedor = Fornecedor::create($input);
        if($fornecedor){
            return ["resultado"=>"Fornecedor criado com sucesso"];
        } else {
            return ["resultado"=>"Erro ao Adicionar"];
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
