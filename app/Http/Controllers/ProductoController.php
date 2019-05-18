<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Producto;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    //
    public function getproductos(){
        $productos=Producto::get();

        foreach ($productos as $producto){
            $producto->vendido=0;
        }

        return response()->json($productos);
    }
    public function index(){
        return view('suministros');

    }
    public function cargar(Request $request){
        foreach ($request->data as $producto){
            $auxiliar=Producto::find($producto['id']);
            $auxiliar->cantidad=$auxiliar->cantidad+$producto['vendido']; //esta linea se reutilizó del proceso de ventas. Por tal motivo se llama $producto['vendido']
            $auxiliar->save();
        }
        return response('Carga realizada correctamente',200);
    }

    public function comprarSuministros(Request $request){
        return response('error',404);
        $factura=new Factura();
        $factura->cliente_id=1;
        $factura->user_id=Auth::id();
        $factura->save();

        foreach ($request->data as $producto){
            $auxiliar=Producto::find($producto['id']);
            $auxiliar->cantidad=$auxiliar->cantidad+$producto['vendido'];
            $auxiliar->save();

            /*$venta=new Venta();
            $venta->producto_id=$auxiliar->id;
            $venta->cantidad=$producto['vendido'];
            $venta->factura_id=$factura->id;
            $venta->save();*/
        }
        return response($factura->id,200);
    }
}
