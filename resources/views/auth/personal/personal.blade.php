@extends('layouts.app')

@section('content')

<?php
    use App\User;
    $obtenerTodosUsuario = User::all();
    
    $prueba = Hash::make('claveprueba');
?>
@if (auth()->user()->id === 1)
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 text-center">
                <!-- Usuario Administrador -->
                <a href="{{ route('vista-personal-registrar') }}">
                    <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                        <img src="..\resources\views\imagenes\add-user-male-80x80.png"/>
                        <hr class="my-1">
                        Registrar Personal
                    </button>
                </a>
                <a href="{{ route('vista-personal-editar') }}">
                    <button type="submit" class="btn btn-light btn-sq-lg mx-3">
                        <img src="..\resources\views\imagenes\edit-user-female-80x80.png"/>
                        <hr class="my-1">
                        Editar Personal
                    </button>
                </a>
            </div>
        </div>
    @else
        <div class="text-center">
            <p>Usuario no autorizado.</p>
        </div>
    @endif
@endsection