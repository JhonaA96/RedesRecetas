<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $recetas = auth()->user()->recetas; */
        $usuario = auth()->user();
        $meGusta = auth()->user()->meGusta;
        $recetas = Receta::where('user_id', $usuario->id)->paginate(5);
        return view('recetas.index', compact('recetas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Se valida que la información enviada mediante el formulario no este vacia */
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);
        
        /* Se obtiene la ruta de la imagen */
        $ruta_imagen = $request['imagen']->store("upload-recetas", 'public');

        /* Resize imagen */
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        /* Se envía la información a la DB */
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' =>  $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        /* Se obtiene si al usuario le gusta la receta  */
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        /* Cantidad de likes a la vista */
        $likes = $receta->likes->count();
        /* Se retorna la vista */
        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id','nombre']);
        
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        /* Se verifia el policy */
        $this->authorize('update', $receta);

        /* Se valida que la información enviada mediante el formulario no este vacia */
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        /* Se editan los valores */
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        /* Se carga nueva imagen */

        if(request('imagen')){
        /* Se obtiene la ruta de la imagen */
            $ruta_imagen = $request['imagen']->store("upload-recetas", 'public');

            /* Resize imagen */
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();
            $receta->imagen = $ruta_imagen;
        }
        /* Se guarda en la base de datos */
        $receta->save();

        /* Se redirección al index */
        return redirect()->action('RecetaController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        
        /* Ejecutar el policy */
        $this->authorize('delete', $receta);

        /* SSe elimina la receta */
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request){
        
        $busqueda = $request->get('buscar');
        $recetas = Receta::where('titulo', 'like', '%' . $busqueda .'%')->paginate(4);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
