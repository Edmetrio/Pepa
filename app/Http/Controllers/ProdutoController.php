<?php

namespace App\Http\Controllers;

use App\Models\Models\Categoria;
use App\Models\Models\Itemcarrinha;
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
        $produto = Produto::with('categorias')->orderBy('created_at', 'desc')->paginate(6);
        return view('produtos.index',compact('produto'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('produtos.create', compact('produto','categoria'));
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
            'nome' => 'required',
            'categoria_id' => 'required',
            'descricao' => 'required',
            'preco_retalho' => 'required',
            'preco_grosso' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($icon = $request->file('icon')) {
            $destinationPath = 'assets/images/produto';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }
    
        Produto::create($input);
     
        return redirect()->route('produtos.index')
                        ->with('success','Produto criado com sucesso.');
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
        $produto = Produto::findOrFail($id);
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('produtos.update', compact('produto','categoria'));
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
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required',
            'descricao' => 'required',
            'preco_retalho' => 'required',
            'preco_grosso' => 'required',
        ]);
  
        $input = $request->all();
        $produto = Produto::findOrFail($id);

        if ($icon = $request->file('icon')) {
            File::delete(public_path("assets/images/produto/". $produto->icon));
            $destinationPath = 'assets/images/produto';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }else{
            unset($input['icon']);
        }
          
        Produto::with('categorias')->findOrFail($id)->update($input);
    
        return redirect()->route('produtos.index')
                        ->with('success','Produto actualizado com sucesso');
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
        return redirect()->route('produtos.index')
                        ->with('success','Produto apagado com sucesso');
    }
}
