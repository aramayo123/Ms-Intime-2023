<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Ticket;
use App\Mail\FacturaMailable;
use App\MisClases\Parse;

use Illuminate\Support\Facades\Mail;
class ShopController extends Controller
{
    //
    public function Index(){
        $productos = Producto::All();
        return view('shop.index', [
            'productos' => $productos,
        ]);
    }
    public function Confirmar(Request $request){
        $rules = [
            'direccion' => ['required', 'max:100', 'min:10'],
            'telefono' => ['required','numeric', 'min:8'],
            'id_productos' => ['required'],
            'cantidad_productos' => ['required'],
            'colors_productos' => ['required'],
            'talles_productos' => ['required'],
        ];
        $customMessages = [
            'direccion.required' => 'Necesitamos que completes la direccion',
            'direccion.max' => 'Direccion demaciado larga',
            'direccion.min' => 'Direccion demaciado corto',
            'telefono.required' => 'Necesitamos que agreges un numero de contacto',
            'telefono.min' => 'Telefono demaciado corto',
            'telefono.numeric' => 'Solo numeros por favor',
        ];
        $request->validate($rules, $customMessages);
        

        /*
        $productos = [];
        $cantidad_aux = $request->cantidad_productos;
        $Aux = "";
        $cantidades = [];
        for ($i = 0; $i < strlen($cantidad_aux); $i++) {
            if($cantidad_aux[$i] != ' '){
                $Aux .= $cantidad_aux[$i];
                if($i == strlen($cantidad_aux)-1){
                    array_push($cantidades, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($cantidades, $Aux);
                $Aux = "";
            }
        }

        $colores_aux = $request->colors_productos;
        $Aux = "";
        $colores = [];
        for ($i = 0; $i < strlen($colores_aux); $i++) {
            if($colores_aux[$i] != '|'){
                $Aux .= $colores_aux[$i];
                if($i == strlen($colores_aux)-1){
                    array_push($colores, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($colores, $Aux);
                $Aux = "";
            }
        }
        $talles_aux = $request->talles_productos;
        $Aux = "";
        $talles = [];
        for ($i = 0; $i < strlen($talles_aux); $i++) {
            if($talles_aux[$i] != '|'){
                $Aux .= $talles_aux[$i];
                if($i == strlen($talles_aux)-1){
                    array_push($talles, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($talles, $Aux);
                $Aux = "";
            }
        }

        $id_productosAux = $request->id_productos;
        $idAux = "";
        $totalProductos = 0;
        for ($i = 0; $i < strlen($id_productosAux); $i++) {
            if($id_productosAux[$i] != ' '){
                $idAux .= $id_productosAux[$i];
                if($i == strlen($id_productosAux)-1){
                    $prodaux = Producto::findOrFail($idAux);
                    $prodaux->cantidad = $cantidades[$totalProductos];
                    $prodaux->colors = $colores[$totalProductos];
                    $prodaux->talles = $talles[$totalProductos];
                    array_push($productos, $prodaux);
                    $idAux = "";
                }
            }else{
                $prodaux = Producto::findOrFail($idAux);
                $prodaux->cantidad = $cantidades[$totalProductos];
                $prodaux->colors = $colores[$totalProductos];
                $prodaux->talles = $talles[$totalProductos];
                array_push($productos, $prodaux);
                $totalProductos++;
                $idAux = "";
            }
        }
        $productos = new Parse($request->id_productos, $request->cantidad_productos,$request->colors_productos, $request->talles_productos);
        // tenemos los productos encontrados como queremos
        $direccion = $request->direccion;
        $telefono = $request->telefono;
        $detalles = $request->detalles;

        
        //$correo = new FacturaMailable($productos->getProductos(),$direccion,$telefono,$detalles);
        //Mail::to("aramayo420@gmail.com")->send($correo);
        $correo = new FacturaMailable($productos->getProductos(),$direccion,$telefono,$detalles);
        Mail::to("aramayo420@gmail.com")->send($correo);

        return "Esto es una simulacion para no abrir puertos y mostrar lo del pago xD";
        */
        //$pdf = Pdf::loadView('pdf.index', compact('productos'));
        //return $pdf->stream();
        //return $pdf->download('invoice.pdf');
        // para q no lo deje volver hdp
        
        $total_precios = 0;
        $total_cantidades = 0;

        $cantidad_aux = $request->cantidad_productos;
        $colors_productos = $request->colors_productos;
        $talles_productos = $request->talles_productos;
        $detalles = $request->detalles;


        $Aux = "";
        $cantidades = [];
        for ($i = 0; $i < strlen($cantidad_aux); $i++) {
            if($cantidad_aux[$i] != ' '){
                $Aux .= $cantidad_aux[$i];
                if($i == strlen($cantidad_aux)-1){
                    array_push($cantidades, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($cantidades, $Aux);
                $Aux = "";
            }
        }
    
        $id_productosAux = $request->id_productos;
        $idAux = "";
        $totalProductos = 0;
        for ($i = 0; $i < strlen($id_productosAux); $i++) {
            if($id_productosAux[$i] != ' '){
                $idAux .= $id_productosAux[$i];
                if($i == strlen($id_productosAux)-1){
                    $prodaux = Producto::findOrFail($idAux);
                    $total_precios += (int)$prodaux->price * (int)$cantidades[$totalProductos];
                    $total_cantidades += (int)$cantidades[$totalProductos];
                    $idAux = "";
                }
            }else{
                $prodaux = Producto::findOrFail($idAux);
                $total_precios += (int)$prodaux->price * (int)$cantidades[$totalProductos];
                $total_cantidades += (int)$cantidades[$totalProductos];
                $totalProductos++;
                $idAux = "";
            }
        }

        return view('shop.confirmar',[
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'id_productos' => $request->id_productos,
            'cantidad_productos' => $request->cantidad_productos,
            'total_precios' => $total_precios,
            'total_cantidades' => $total_cantidades,
            'total_colors' => $colors_productos,
            'total_talles' => $talles_productos,
            'detalles'=> $detalles,
        ]);
    }
    public function Procesar(){
        $productos = Producto::All();
        return view('shop.procesar', [
            'productos' => $productos,
        ]);
    }
    public function LimpiarStorage(){
        return view('shop.limpiarStorage');
    }

    public function Show($id){
        $productos = Producto::All();
        $producto = Producto::findOrFail($id);
        return view('shop.show', [
            'producto' => $producto,
            'productos' => $productos,
        ]);
    }
    
    public function updateTicket(Request $request){
        $ticket = Ticket::findOrFail($request->id);
        $ticket->status_product = "Entregado";
        $ticket->update();



        $productos = Producto::All();
        $aux = Ticket::All();
        $tickets = [];
        $tickets_aproved_pending = [];
        $tickets_finish = [];
        foreach ($aux as $ticket){
            if($ticket->status == "El pago ha sido aprobado y acreditado" && $ticket->status_product == "Sin entregar")
                array_push($tickets_aproved_pending, $ticket);

            if($ticket->status == "El pago ha sido aprobado y acreditado" && $ticket->status_product == "Entregado")
                array_push($tickets_finish, $ticket);

            if($ticket->status != "El pago ha sido aprobado y acreditado" && $ticket->status_product != "Entregado")
                array_push($tickets, $ticket);
        }
        return view('productos.index', [
            'productos' => $productos,
            'tickets_aproved_pending' => $tickets_aproved_pending,
            'tickets_finish' => $tickets_finish,
            'tickets' => $tickets,
        ]);
    }
}
