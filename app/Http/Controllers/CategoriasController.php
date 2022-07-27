<?php

namespace App\Http\Controllers;

use App\Models\Models\Categoria;
use App\Models\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->paginate(2);
        return view('categorias.index',compact('categoria','produto'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'descricao' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($icon = $request->file('icon')) {
            $destinationPath = 'assets/images/categoria';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }
    
        Categoria::create($input);
     
        return redirect()->route('categorias.index')
                        ->with('success','Categoria criada com sucesso.');
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
        $categorias = Categoria::findOrFail($id);
        $produto = Produto::orderBy('created_at', 'desc')->get();
        $categoria = Categoria::orderBy('created_at', 'desc')->get();
        return view('categorias.update',compact('categorias','categoria','produto'));
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
            'descricao' => 'required'
        ]);
  
        $input = $request->all();
        $categoria = Categoria::findOrFail($id);

        if ($icon = $request->file('icon')) {
            File::delete(public_path("assets/images/categoria/". $categoria->icon));
            $destinationPath = 'assets/images/categoria';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }else{
            unset($input['icon']);
        }
          
        Categoria::findOrFail($id)->update($input);
    
        return redirect()->route('categorias.index')
                        ->with('success','Categoria actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        File::delete(public_path("assets/images/categoria/". $categoria->icon));
        $categoria->delete();   
        return redirect()->route('categorias.index')
                        ->with('success','Categoria apagada com sucesso');
    }
}
