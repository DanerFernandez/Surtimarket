@extends('layouts.app')

@section('content')
    @if (auth()->user()->id === 1)
        <div class="row justify-content-center">
            <div class="col-md-4">
                <anular-venta-caja-component/>
            </div>
        </div>
    @else
        <div class="text-center">
            <p>Usuario no autorizado.</p>
        </div>
    @endif
@endsection