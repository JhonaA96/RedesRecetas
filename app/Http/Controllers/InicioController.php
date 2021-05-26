<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        /* Se obtienen las recetas más nuevas */
        $nuevas = Receta::latest()->take(5)->get();

        /* Obtener todas las categorías */
        $categorias = CategoriaReceta::all();

        /* se agrupan recetas por categoria */
        $recetas = [];
        foreach($categorias as $categoria){
            $recetas[Str::slug($categoria->nombre)][]= Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        /* recetas por likes */
        $votadas = Receta::withCount('likes')->orderBY('likes_count', 'DESC')->take(3)->get();

        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
