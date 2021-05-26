@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
    
@endsection('styles')

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">Regresar</a>
@endsection('botones')

@section('content')
    
    <h2 class="text-center mb-5">Editar Receta: {{$receta->titulo}}</h2>
    
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('recetas.update', ['receta' => $receta -> id]) }}" enctype="multipart/form-data" method="post" novalidate>
                @csrf

                @method('put')

                {{-- Titulo --}}
                <div class="form-group">
                    <label for="titulo">Título Receta</label>
                    <input type="text"
                            name="titulo"
                            class="form-control @error('titulo') is-invalid @enderror"
                            id="titulo"
                            placeholder="Titulo Receta"
                            value="{{$receta->titulo}}"
                    >
                    {{-- Mensaje error --}}
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select 
                        name="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror" 
                        id="categoria">

                        <option value="">-- Seleccione --</option>
                        {{-- Se muestran las categorias --}}
                        @foreach($categorias as $categoria)
                            <option 
                                value="{{$categoria->id}}" 
                                {{$receta->categoria_id == $categoria->id ? 'selected' : ''}}>
                                {{$categoria -> nombre}}
                            </option>
                        @endforeach

                    </select>
                    {{-- Mensaje de error --}}
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror('categoria')
                </div>

                {{-- Preparación --}}
                <div class="form-group mt-4">
                    <label for = "preparacion">Preparación</label>
                    <input id = "preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}">
                    <trix-editor 
                        input = "preparacion"
                        class = "form-control @error('preparacion') is-invalid @enderror"
                    ></trix-editor>
                    {{-- Mensaje de error --}}
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror('preparacion')
                </div>

                {{-- Ingredientes --}}
                <div class="form-group mt-4">
                    <label for = "ingredientes">ingredientes</label>
                    <input id = "ingredientes" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}">
                    <trix-editor 
                        input = "ingredientes"
                        class = "form-control @error('ingredientes') is-invalid @enderror"    
                    ></trix-editor>
                    {{-- Mensaje de error --}}
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror('ingredientes')
                </div>

                {{-- Imagen --}}
                <div class="form-group mt-4">
                    <label for = "imagen">Elige la Imagen</label>
                    <input 
                        type="file" 
                        name="imagen" 
                        id="imagen" 
                        class="form-control @error('imagen') is-invalid @enderror"
                    >

                    <div class="mt-4">
                        <p>Imagen Actual</p>
                        <img src="/storage/{{$receta->imagen}}" alt="" style="width: 300px">
                    </div>
                    {{-- Mensaje de error --}}
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror('imagen')
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar Receta">
                </div>
            </form>
        </div>
    </div>

@endsection('content')


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>

@endsection('scripts')