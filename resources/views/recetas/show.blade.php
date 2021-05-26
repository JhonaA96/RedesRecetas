@extends('layouts.app')

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">Regresar</a>
@endsection('botones')

@section('content')
    <article class="contenido-receta bg-white p-5">

        {{-- Título de la receta --}}
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{$receta->imagen}}" alt="" class="w-100">
        </div>

        <div class="receta-meta mt-2">
            {{-- Categoría en la que se creo la recte --}}
            <p>
                <span class="font-weight-bold text-primary mt-3">Escrito en:</span>
                <a 
                    href="{{route('categorias.show', ['categoriaReceta' => $receta->categoria->id])}}"
                    class="text-dark">
                        {{$receta->categoria->nombre}}
                </a>
                
            </p>

            {{-- Autor de la receta --}}
            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                <a 
                    href="{{route('perfiles.show', ['perfil' => $receta->autor->id])}}"
                    class="text-dark">
                        {{$receta->autor->name}}
                </a>
            </p>

            {{-- Fecha de creación --}}
            <p>
                <span class="font-weight-bold text-primary">Fecha:</span>
                @php
                    $fecha = $receta->created_at
                @endphp
                <fecha-receta fecha ='{{$fecha}}'></fecha-receta>
                
            </p>

            {{-- Ingredientes --}}
            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $receta->ingredientes !!}
            </div>

            {{-- Preparacion --}}
            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparación</h2>
                {!! $receta->preparacion !!}
            </div>
            
            <div class="justify-content-center row text-center">
                <like-button
                    receta-id = "{{$receta->id}}"
                    like = "{{$like}}"
                    likes = "{{$likes}}"
                ></like-button>
            </div>
            

        </div>
    </article>
@endsection('content')