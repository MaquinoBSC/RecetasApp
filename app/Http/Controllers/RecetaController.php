<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recetas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_recetas')->get()->pluck('nombre', 'id')->dd();
        $categorias= DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request['imagen']->store('upload-recetas', 'public') );

        $data= request()->validate([
            'titulo'=> 'required|min:6|max:40',
            'ingredientes'=> 'required',
            'preparacion'=> 'required',
            'imagen'=> 'required|image',
            'categoria'=> 'required',
        ]);

        // Obtener la ruta de la imagen ya en el servidor
        $path_imagen= $request['imagen']->store('upload-recetas', 'public');

        // Rezise de la imagen
        $img= Image::make( public_path("storage/{$path_imagen}"))->fit(1000, 550);
        $img->save();

        DB::table('recetas')->insert([
            'titulo'=> $data['titulo'],
            'ingredientes'=> $data['ingredientes'],
            'preparacion'=> $data['preparacion'],
            'imagen'=> $path_imagen,
            'user_id'=> Auth::user()->id,
            'categoria_id'=> $data['categoria'],
        ]);

        //Redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
