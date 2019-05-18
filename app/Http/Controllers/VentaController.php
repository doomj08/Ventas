<?php

namespace App\Http\Controllers;

use App\Factura;
use App\producto;
use App\Venta;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    //
    public function index(){
        return view('ventas');
    }
    public function comprar(Request $request){
        $factura=new Factura();
        $factura->cliente_id=1;
        $factura->user_id=Auth::id();
        $factura->save();

        foreach ($request->data as $producto){
            $auxiliar=Producto::find($producto['id']);
            $auxiliar->cantidad=$auxiliar->cantidad-$producto['vendido'];
            $auxiliar->save();

            $venta=new Venta();
            $venta->producto_id=$auxiliar->id;
            $venta->cantidad=$producto['vendido'];
            $venta->factura_id=$factura->id;
            $venta->save();
        }
        return response($factura->id,200);
        }

        public function factura($id){
        $factura=Factura::find($id);
        $ventas=Venta::where('factura_id',$id)->get();
            $total=0;
            foreach ($ventas as $venta){
                $total=$total+$venta->cantidad*$venta->producto->precio;
            }
//return $ventas;
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('factura',compact(['ventas','total','id','factura'])));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        }

}
