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
        foreach ($request->data as $producto){

            $auxiliar=Producto::find($producto['id']);

            if($auxiliar){
            $auxiliar->cantidad=$auxiliar->cantidad+$producto['vendido'];
            $auxiliar->save();
            }else{
            $nuevo=New Producto();
            $nuevo->nombre=$producto['nombre'];
            $nuevo->precio=$producto['precio'];
            $nuevo->cantidad=$producto['vendido'];
            $nuevo->save();
            }
        }
    }
}
