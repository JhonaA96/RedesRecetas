@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
    
@endsection('styles')

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">Regresar</a>
@endsection('botones')

@section('content')
    <h1 class="text-center">Editar mi Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action="{{route('perfiles.update', ['perfil' => $perfil->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                {{-- Campo Nombre --}}
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text"
                            name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            id="nombre"
                            placeholder="Tu Nombre "
                            value="{{$perfil->usuario->name}}"
                    >
                    {{-- Mensaje error --}}
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Campo url --}}
                <div class="form-group">
                    <label for="url">Sitio Web</label>
                    <input type="text"
                            name="url"
                            class="form-control @error('url') is-invalid @enderror"
                            id="url"
                            placeholder="Tu Sitio Web "
                            value="{{$perfil->usuario->url}}"
                    >
                    {{-- Mensaje error --}}
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Campo Biografía --}}
                <div class="form-group mt-4">
                    <label for = "biografia">Biografía</label>
                    <input id = "biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">
                    <trix-editor 
                        input = "biografia"
                        class = "form-control @error('biografia') is-invalid @enderror"
                    ></trix-editor>
                    {{-- Mensaje de error --}}
                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Campo Imagen --}}
                <div class="form-group mt-4">
                    <label for = "imagen">Tu imagen</label>
                    <input 
                        type="file" 
                        name="imagen" 
                        id="imagen" 
                        class="form-control @error('imagen') is-invalid @enderror"
                    >

                    @if($perfil->imagen)
                        <div class="mt-4">
                            <p>Imagen Actual</p>
                            <img src="/storage/{{$perfil->imagen}}" alt="" style="width: 300px">
                        </div>
                        {{-- Mensaje de error --}}
                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror('imagen')
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar Perfil">
                </div>
            </form>
        </div>
    </div>

@endsection('content')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection('scripts')