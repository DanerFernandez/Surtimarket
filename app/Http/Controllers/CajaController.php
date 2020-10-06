<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
use App\Venta;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtiene las cajas cerradas
        return Caja::orderby('id','desc')->take(30)->where('estado', 0)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Caja::where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = new Caja();
        $caja->fecha_inicio = $request->fecha_inicio;
        $caja->hora_inicio = $request->hora_inicio;
        $caja->fecha_cierre = $request->fecha_cierre;
        $caja->hora_cierre = $request->hora_cierre;
        $caja->estado = $request->estado;
        $caja->save();

        return $caja;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Caja::findOrFail($id);
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
        $caja = Caja::find($id);
        $caja->fecha_inicio = $request->fecha_inicio;
        $caja->hora_inicio = $request->hora_inicio;
        $caja->fecha_cierre = $request->fecha_cierre;
        $caja->hora_cierre = $request->hora_cierre;
        $caja->estado = $request->estado;
        $caja->save();
        return $caja;
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

    public function verCajaVentasAprobadas(Request $request)
    {
        return Venta::orderby('id','asc')->where('id_caja', $request->id)->where('estado', 1)->get();
    }

    public function verCajaVentasGlobal(Request $request)
    {
        $ventas = Venta::join('users','users.id','=','ventas.id_usuario')
        ->select('ventas.id','users.name','ventas.id_caja','ventas.total',
        'ventas.metodoPago','ventas.detalleMetodoPago','ventas.estado','ventas.created_at','ventas.updated_at')
        ->where('ventas.id_caja','=', $request->id)
        ->orderBy('ventas.id','desc')
        ->get();
        return $ventas;

        /*
        $detalle_venta = DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')
        ->select('productos.nombre','cantidad','importe')
        ->where('detalle_ventas.id_venta','=',$request->id)
        ->orderBy('productos.nombre', 'asc')
        ->get();

        return $detalle_venta;
        */
    }

    public function ObtenerDatosDetalleCaja(Request $request)
    {
        $totalVenta_Caja = Venta::where('id_caja', $request->id)->where('estado', 1)->get()->sum('total');

        $sumarVenta_Efectivo = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Efectivo')->get()->sum('total');
        $sumarVenta_Tarjeta = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Tarj. Cred/Deb')->get()->sum('total');
        $sumarVenta_BilleteraMovil = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Billetera Movil')->get()->sum('total');

        $cantidadVenta_Efectivo = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Efectivo')->get()->count();
        $cantidadVenta_Tarjeta = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Tarj. Cred/Deb')->get()->count();
        $cantidadVenta_BilleteraMovil = Venta::where('id_caja', $request->id)->where('estado', 1)->where('metodoPago','Billetera Movil')->get()->count();

        $respuesta = '{
            "TotalVentaCaja": '.$totalVenta_Caja.',
            "SumaVentaEfectivo": '.$sumarVenta_Efectivo.',
            "SumaVentaTarjeta": '.$sumarVenta_Tarjeta.',
            "SumaVentaBilleteraMovil": '.$sumarVenta_BilleteraMovil.',
            "CantidadVentaEfectivo": '.$cantidadVenta_Efectivo.',
            "CantidadVentaTarjeta": '.$cantidadVenta_Tarjeta.',
            "CantidadVentaBilleteraMovil": '.$cantidadVenta_BilleteraMovil.'
        }';
        return $respuesta;
    }
    

}
