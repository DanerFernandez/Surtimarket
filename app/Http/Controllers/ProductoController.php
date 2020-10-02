<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busquedaNombreProducto(Request $request){
        return Producto::orderby('nombre','asc')->take(10)->where('nombre', 'like', '%'.$request->nombre.'%')->get();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoProducto = new Producto();
        $nuevoProducto->id = $request->codigoProducto;
        $nuevoProducto->nombre = $request->nombreProducto;
        $nuevoProducto->descripcion = $request->descripcionProducto;
        $nuevoProducto->precio = $request->precioProducto;
        $nuevoProducto->stock = $request->stockProducto;
        $nuevoProducto->stock_minimo = $request->stockMinimoProducto;
        $nuevoProducto->save();

        return $nuevoProducto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Producto::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->save();
        return $producto;
    }

    public function reducirStock(Request $request){
        $arrayCarrito = (object) $request->carritoCompra;

        foreach ($arrayCarrito as $key => $value) {
            $ObjectCarritoConvertido = (object)$value;
            $stock = Producto::findOrFail($ObjectCarritoConvertido -> codigo);
            $stock->stock = $stock->stock - $ObjectCarritoConvertido->cantidad;
            $stock->save();
        }
        return 'Stock reducido correctamente. ';
    }

    public function aumentarStock(Request $request){
        $aumentarStock = Producto::findOrFail($request->codigo);
        $aumentarStock->stock = $request->stock + $request->aumentar;
        $aumentarStock->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function escasoStock()
    {
        return Producto::whereRaw('stock <= stock_minimo')->get();

        //SELECT * FROM `productos` WHERE `stock`<`stock_minimo`
        //return Caja::orderby('id','desc')->take(30)->where('estado', 0)->get();
    }
}
