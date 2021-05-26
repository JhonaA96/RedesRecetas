<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    /* Los campos a agregar */
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id',
    ];
    
    /* Se obtienen los datos de categoria de la receta por una llave foranea */
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    /* Se obtienen la información del usuario via llave foranea */
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }
    /* Likes de la receta */
     public function likes(){
         return $this->belongsToMany(User::class,'likes_receta');
     }

}
