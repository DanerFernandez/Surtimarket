<?php
    use App\Caja;
    $revisarCajaAbierta = Caja::where('estado', 1)->get();
    
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Surtimar'ket</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>

.btn-sq-lg {
  width: 150px !important;
  height: 150px !important;
}

.btn-sq {
  width: 100px !important;
  height: 100px !important;
}

.btn-sq-sm {
  width: 50px !important;
  height: 50px !important;
}

.btn-sq-xs {
  width: 25px !important;
  height: 25px !important;
}

.btn-purple {
    color: #ffffff;
    background-color: #916ebe;
}

.btn-purple:hover {
    color: #ffffff;
    background-color: #795ca0;
}

.scrollable-sm {
    height: 300px;
    overflow: scroll;
    overflow-x: hidden;
}

.scrollable {
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
}

.scrollable-lg {
    height: 550px;
    overflow-y: scroll;
    overflow-x: hidden;
}

#scroll-carrito::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

#scroll-carrito::-webkit-scrollbar
{
	width: 6px;
	background-color: #F5F5F5;
}

#scroll-carrito::-webkit-scrollbar-thumb
{
	background-color: #4d4d4d;
}

.sticky-table-header {
    position: sticky; top: 0; background-color: #f5eefe !important;
}



</style>
<body style="background-color: #f5eefe">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Surtimar'ket
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!--
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            -->
                        @else
                            @if (count($revisarCajaAbierta) === 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('vista-venta') }}">Venta</a>
                            </li>
                            @endif
                            @if (auth()->user()->id === 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vista-caja') }}">Caja</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vista-producto') }}">Producto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vista-personal') }}">Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vista-registro-ventas') }}">Registro Ventas</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown ml-3">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bolder" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="margin-left: 20px; margin-right: 20px">
            @yield('content')
        </main>
    </div>
</body>
</html>
