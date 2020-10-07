<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Producto;
use App\DetalleVenta;

class VentaController extends Controller
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
        $venta = new Venta();
        $venta->id_usuario = auth()->id();
        $venta->id_caja = $request->id_caja;
        $venta->total = $request->total;
        $venta->metodoPago = $request->metodoPago;
        $venta->detalleMetodoPago = $request->detalleMetodoPago;
        $venta->estado = $request->estado;
        $venta->save();

        return $venta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return $venta;
    }

    public function VentaUsers(Request $request){
        $venta = Venta::join('users','users.id','=','ventas.id_usuario')
        ->select('users.name','ventas.id_caja','total','metodoPago','detalleMetodoPago','estado')
        ->where('ventas.id','=',$request->id)
        ->get();

        return $venta[0];
    }

    public function obtenerHoraPeru($id){
        $create_at = Venta::select('created_at')->findOrFail($id)->created_at;
        $hora = ($create_at)->timezone('America/Lima')->toDateTimeString();
        $nuevaHora = explode( ' ', $hora );
        return $nuevaHora;
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

    public function anularTicketVenta(Request $request)
    {

        $detalleVenta = DetalleVenta::select('id_producto','cantidad')->where('id_venta',$request->id)->get();
        $asd = '';
        foreach ($detalleVenta as $key => $value) {
            $producto = Producto::findOrFail($value->id_producto);
            $producto->stock = $producto->stock + $value->cantidad;
            $producto->save();
        }
        

        $ticket = Venta::findOrFail($request->id);

        $ticket->estado = 0;
        $ticket->save();

        
        return 'Ticket anulado correctamente';
    }
}
