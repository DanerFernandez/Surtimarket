<?php
    use App\Caja;
    $revisarCajaAbierta = Caja::where('estado', 1)->get();
    
?>
<div class="row justify-content-center mt-4">
    <div class="col-md-12 text-center">
        <!-- Usuario Normal -->
        @if (count($revisarCajaAbierta) === 1)
        <a href="{{ url('vista-venta') }}">
            <button type="submit" class="btn btn-light btn-sq-lg m-3">
                <img src="..\resources\views\imagenes\cash-register-80x80.png"/>
                <hr class="my-1">
                Venta
            </button>
        </a>
        @else
        <button type="submit" class="btn btn-light btn-sq-lg m-3" disabled>
            <img src="..\resources\views\imagenes\cash-register-80x80.png"/>
            <hr class="my-1">
            Venta
        </button>
        @endif
        
        <!-- Usuario Administrador -->
        @if (auth()->user()->id === 1)
        <a href="{{ route('vista-caja') }}">
            <button type="submit" class="btn btn-light btn-sq-lg m-3">
                <img src="..\resources\views\imagenes\safe-80x80.png"/>
                <hr class="my-1">
                Caja
            </button>
        </a>
        <a href="{{ route('vista-producto') }}">
            <button type="submit" class="btn btn-light btn-sq-lg m-3">
                <img src="..\resources\views\imagenes\move-by-trolley-80x80.png"/>
                <hr class="my-1">
                Productos
            </button>
        </a>
        <a href="{{ route('vista-personal') }}">
            <button type="submit" class="btn btn-light btn-sq-lg m-3">
                <img src="..\resources\views\imagenes\conference-call-80x80.png"/>
                <hr class="my-1">
                Personal
            </button>
        </a>
        <a href="{{ route('vista-registro-ventas') }}">
            <button type="submit" class="btn btn-light btn-sq-lg m-3">
                <img src="..\resources\views\imagenes\cashbook-80x80.png"/>
                <hr class="my-1">
                Registro
            </button>
        </a>
        @endif
    </div>
</div>