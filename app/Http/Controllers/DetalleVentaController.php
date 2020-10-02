<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleVenta;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $arrayCarrito = (object)$request->carrito;
        foreach ($arrayCarrito as $key => $value) {
            $ObjectCarritoConvertido = (object)$value;

            $detalle_venta = new DetalleVenta();
            $detalle_venta->id_venta = $request->id_venta;
            $detalle_venta->id_producto = $ObjectCarritoConvertido->codigo;
            $detalle_venta->cantidad = $ObjectCarritoConvertido->cantidad;
            $detalle_venta->importe = $ObjectCarritoConvertido->importe;
            $detalle_venta->save();
        }
        return 'Venta Registrada' ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DetalleVenta::where('id_venta', $id)->get();
    }

    public function detalleVentaProductos(Request $request)
    {
        $detalle_venta = DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')
        ->select('productos.nombre','cantidad','importe')
        ->where('detalle_ventas.id_venta','=',$request->id)
        ->orderBy('productos.nombre', 'asc')
        ->get();

        return $detalle_venta;
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
        //
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
}
