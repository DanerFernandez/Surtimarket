<?php

use Illuminate\Support\Facades\Route;

//Ruta Raiz
Route::get('/', function () {
    return view('auth.login');
});
//-----------------------------------
//Rutas de Autenticacion
Auth::routes();
//-----------------------------------
//Ruta cuando se inicie sesion
Route::get('/home', 'HomeController@index')->name('home');
//-----------------------------------
//Rutas con recursos
Route::resource('/usuario', 'UsuarioController')->middleware('auth');
Route::resource('/producto', 'ProductoController')->middleware('auth');
Route::resource('/caja', 'CajaController')->middleware('auth');
Route::resource('/venta', 'VentaController')->middleware('auth');
Route::resource('/detalle-venta', 'DetalleVentaController')->middleware('auth');
//-----------------------------------
//Ruta de Vista Caja
Route::get('/vista-caja', function () {
    return view('auth.caja.caja');
})->name('vista-caja')->middleware('auth');

    Route::get('/anular-venta-caja', function () {
        return view('auth.caja.anularVentaCaja');
    })->name('anular-venta-caja')->middleware('auth');

    Route::get('/ticket-cerrar-caja', function () {
        return view('auth.caja.ticketCerrarCaja');
    })->name('ticket-cerrar-caja')->middleware('auth');

//-----------------------------------
//Ruta Vista Venta
Route::get('/vista-venta', function (){
    return view('auth.venta');
})->name('vista-venta')->middleware('auth');
//-----------------------------------
//Rutas de PRODUCTO
Route::get('/vista-producto', function (){
    return view('auth.producto.producto');
})->name('vista-producto')->middleware('auth');

    Route::get('/vista-nuevo-producto', function (){
        return view('auth.producto.productoCrear');
    })->name('vista-nuevo-producto')->middleware('auth');

    Route::get('/vista-editar-producto', function (){
        return view('auth.producto.productoEditar');
    })->name('vista-editar-producto')->middleware('auth');

    Route::get('/vista-escaso-producto', function (){
        return view('auth.producto.productoEscaso');
    })->name('vista-escaso-producto')->middleware('auth');
//-----------------------------------
//Rutas de PERSONAL
Route::get('/vista-personal', function (){
    return view('auth.personal.personal');
})->name('vista-personal')->middleware('auth');

    Route::get('/vista-personal-registrar', function (){
        return view('auth.personal.personalRegistrar');
    })->name('vista-personal-registrar')->middleware('auth');

    Route::get('/vista-personal-editar', function (){
        return view('auth.personal.personalEditar');
    })->name('vista-personal-editar')->middleware('auth');
//-----------------------------------
//Ruta de Registro ventas
Route::get('/vista-registro-ventas', function (){
    return view('auth.registro-ventas');
})->name('vista-registro-ventas')->middleware('auth');
//-----------------------------------
//Ruta para el ticket de venta
Route::get('/ticket-venta', function (){
    return view('auth.ticketVenta');
})->name('ticket-venta')->middleware('auth');
//-----------------------------------
//Metodos personalizados que cree
Route::post('/busquedaNombreProducto','ProductoController@busquedaNombreProducto')->middleware('auth');
Route::put('/editar-stock-producto','ProductoController@reducirStock')->middleware('auth');
Route::post('/aumentar-stock-producto','ProductoController@aumentarStock')->middleware('auth');
Route::post('/escaso-stock','ProductoController@escasoStock')->middleware('auth');

Route::post('/venta-users','VentaController@VentaUsers')->middleware('auth');
Route::get('/hora-peru/{id}','VentaController@obtenerHoraPeru')->middleware('auth');
Route::post('/anular-ticket-venta','VentaController@anularTicketVenta')->middleware('auth');

Route::post('/detalleventa-productos','DetalleVentaController@detalleVentaProductos')->middleware('auth');


Route::post('/ver-caja','CajaController@verCajaVentasAprobadas')->middleware('auth');
Route::post('/obtener-datos-detalle-caja','CajaController@ObtenerDatosDetalleCaja')->middleware('auth');
Route::post('/ver-caja-ventas-global','CajaController@verCajaVentasGlobal')->middleware('auth');


Route::post('/editar-datos-usuario','UsuarioController@editarDatosUsuario')->middleware('auth');

//-----------------------------------
