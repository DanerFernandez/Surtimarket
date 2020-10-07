@extends('layouts.app')

@section('content')
    @if (auth()->user()->id === 1)
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 text-center">
                <!-- Usuario Administrador -->
                <a href="{{ route('vista-nuevo-producto') }}">
                    <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                        <img src="..\resources\views\imagenes\add-80x80.png"/>
                        <hr class="my-1">
                        Nuevo Producto
                    </button>
                </a>
                <a href="{{ route('vista-editar-producto') }}">
                    <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                        <img src="..\resources\views\imagenes\edit-80x80.png"/>
                        <hr class="my-1">
                        Editar Producto
                    </button>
                </a>
                <!--
                <a href="{{ route('vista-escaso-producto') }}">
                    <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                        <img src="..\resources\views\imagenes\box-important-80x80.png"/>
                        <hr class="my-1">
                        Escaso Stock
                    </button>
                </a>
            -->
            </div>
            
        </div>
    @else
        <div class="text-center">
            <p>Usuario no autorizado.</p>
        </div>
    @endif
@endsection