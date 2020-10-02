@extends('layouts.app')

@section('content')
<?php
    use App\Caja;
    $revisarCajaAbierta = Caja::where('estado', 1)->get();
    
?>
    @if (count($revisarCajaAbierta) === 1)
        <div class="row justify-content-center">
            <div class="col-md-12">
                <venta-component/>
            </div>
        </div>
    @else
        <div class="text-center">
            <p>No hay caja abierta.</p>
        </div>
    @endif
@endsection