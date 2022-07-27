<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\Categoria;
use App\Models\Models\Estoque;
use App\Models\Models\Itemestoque;
use App\Models\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Produto::with('categorias')->orderBy('created_at', 'desc')->get();
    }

    public function pesquisa($nome)
    {
        return Produto::where('nome', 'like', '%' . $nome . '%')->orderBy('created_at', 'desc')->get();
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
            'categoria_id' => 'required',
            'nome' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'descricao' => 'required',
            'preco_retalho' => 'required',
            'preco_grosso' => 'required'
        ]);
  
        $input = $request->all();

        if($icon = $request->file('icon')){
            $destino = 'assets/images/produto';
            $perfil = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destino, $perfil);
            $input['icon'] = "$perfil";
        }
    
        //produto
        $produto = Produto::create($input);
        $inputEstoque = $input;
        $inputEstoque['produto_id'] = $produto->id;

        //Estoque
        $estoque = Estoque::create($inputEstoque);
        $inputItem = $inputEstoque;
        $inputItem['estoque_id'] = $estoque->id;
        /* $inputItem['users_id'] = Auth::user()->id; */
        //Item Estoque
        Itemestoque::create($inputItem);
        if($produto){
            return ["resultado"=>"Produto criada com sucesso"];
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
        return Produto::with('categorias')->findOrFail($id);
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
        $input = $request->all();
        $request->validate([
            'categoria_id' => 'required',
            'nome' => 'required',
            'descricao' => 'required',
            'preco_retalho' => 'required',
            'preco_grosso' => 'required'
        ]);
  
        $produto = Produto::findOrFail($id);
        if($icon = $request->file('icon')){
            File::delete(public_path("assets/images/produto/". $produto->icon));
            $destino = 'assets/images/produto';
            $perfil = date('YmHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destino, $perfil);
            $input['icon'] = "$perfil";
        } else {
            unset($input['icon']);
        }

        $produto->update($input);
        if($produto){
            return ["resultado"=>"Produto Actualizada com sucesso"];
        } else {
            return ["resultado"=>"Erro ao Actualizar"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

            File::delete(public_path("assets/images/produto/".$produto->icon));
            $produto->delete();
            return ["resultado" => "Apagado com sucesso!"];
    }
}
