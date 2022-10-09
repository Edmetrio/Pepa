<?php

namespace App\Http\Controllers;

use App\Models\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticia = Noticia::orderBy('created_at', 'desc')->paginate(6);
        return view('noticias.index',compact('noticia'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
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
            'simbolo' => 'required',
            'link' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($icon = $request->file('icon')) {
            $destinationPath = 'assets/images/noticia';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }

        if ($simbolo = $request->file('simbolo')) {
            $destinationPath = 'assets/images/noticia';
            $profileImage = date('YmdHis') . "." . $simbolo->getClientOriginalExtension();
            $simbolo->move($destinationPath, $profileImage);
            $input['simbolo'] = "$profileImage";
        }
    
        Noticia::create($input);
     
        return redirect()->route('noticia.index')
                        ->with('success','Noticia criada com sucesso.');
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
        $noticias = Noticia::findOrFail($id);
        return view('noticias.update',compact('noticias'));
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
            'descricao' => 'required',
            /* 'simbolo' => 'required', */
            'link' => 'required'
        ]);
  
        $input = $request->all();
        $noticia = Noticia::findOrFail($id);

        if ($icon = $request->file('icon')) {
            File::delete(public_path("assets/images/noticia/". $noticia->icon));
            $destinationPath = 'assets/images/noticia';
            $profileImage = date('YmdHis') . "." . $icon->getClientOriginalExtension();
            $icon->move($destinationPath, $profileImage);
            $input['icon'] = "$profileImage";
        }else{
            unset($input['icon']);
        }

        if ($simbolo = $request->file('simbolo')) {
            File::delete(public_path("assets/images/noticia/". $noticia->simbolo));
            $destinationPath = 'assets/images/noticia';
            $profileImage = date('YmdHis') . "." . $simbolo->getClientOriginalExtension();
            $simbolo->move($destinationPath, $profileImage);
            $input['simbolo'] = "$profileImage";
        }else{
            unset($input['simbolo']);
        }
          
        Noticia::findOrFail($id)->update($input);
    
        return redirect()->route('noticia.index')
                        ->with('success','Notícia actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);
        File::delete(public_path("assets/images/noticia/". $noticia->icon));
        $noticia->delete();
        return redirect()->route('noticia.index')
                        ->with('success','Notícia apagada com sucesso');
    }
}
