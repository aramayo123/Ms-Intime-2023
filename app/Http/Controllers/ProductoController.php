<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Ticket;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'title' => ['required', 'max:25', 'min:3'],
            'description' => ['required', 'max:255', 'min:3'],
            'price' => ['required', 'numeric'], 
            'price_send' => ['required', 'numeric'], 
            'image_1' => ['mimes:jpeg,jpg,png'],
            'image_2' => ['mimes:jpeg,jpg,png'],
            'image_3' => ['mimes:jpeg,jpg,png'],
        ];
        $customMessages = [
            'title.required' => 'El titulo no se puede dejar vacío',
            'description.required' => 'La descripcion no se puede dejar vacía',
            'price.required' => 'El precio no se puede dejar vacío',
            'price_send.required' => 'El precio de envio no se puede dejar vacío',
            // para todos XD
            'max:25' => 'El campo :attribute no puede superar los 25 caracteres',
            // personalizado
            'title.min' => 'El titulo debe superar los :min caracteres',
            'numeric' => 'El campo :attribute debe contener solo numeros',
            'mimes:jpeg,jpg,png' => 'El campo :attribute solo admite archivos tipo: jpeg,jpg,png',
        ];
        $request->validate($rules, $customMessages);


        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $price_send = $request->price_send;
        $colores = "";
        $talles = "";
        $colores_arr = [
            $request->color_red,
            $request->color_green,
            $request->color_yellow,
            $request->color_blue,
            $request->color_white,
            $request->color_black
        ];
        $talles_arr = [
            $request->talle_s,
            $request->talle_m,
            $request->talle_xx
        ];

        for ($i = 0; $i < count($colores_arr); $i++) {
            if($colores_arr[$i])
                $colores .= "1 ";
            else
                $colores .= "0 ";
        }

        for ($i = 0; $i < count($talles_arr); $i++) {
            if($talles_arr[$i])
                $talles .= "1 ";
            else
                $talles .= "0 ";
        }

        $producto = new Producto();
        $producto->title = $title;
        $producto->description = $description;
        $producto->price = $price;
        $producto->price_send = $price_send;
        $producto->colors = $colores;
        $producto->talles = $talles;

        $image_1 = "";
        $image_2 = "";
        $image_3 = "";
        // cargamos las imagenes
        if($request->image_1 != null){
            $image_1 = time().".".$request->image_1->extension();
            $request->image_1->move(public_path("img_products"),$image_1);
        }
        if($request->image_2 != null){
            $image_2 = (time()+1).".".$request->image_2->extension();
            $request->image_2->move(public_path("img_products"),$image_2);
        }
        if($request->image_3 != null){
            $image_3 = (time()+2).".".$request->image_3->extension();
            $request->image_3->move(public_path("img_products"),$image_3);
        }
        // guardamos en la bd
        $producto->image_1 = $image_1;
        $producto->image_2 = $image_2;
        $producto->image_3 = $image_3;

        $producto->save();











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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //\
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $producto = Producto::findOrFail($id);
        return view('productos.editar', [
            'producto' => $producto,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'title' => ['required', 'max:25', 'min:3'],
            'description' => ['required', 'max:255', 'min:3'],
            'price' => ['required', 'numeric'], 
            'price_send' => ['required', 'numeric'], 
            'image_1' => ['mimes:jpeg,jpg,png'],
            'image_2' => ['mimes:jpeg,jpg,png'],
            'image_3' => ['mimes:jpeg,jpg,png'],
        ];
        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar vacío',
            'max:25' => 'El campo :attribute no puede superar los 25 caracteres',
            'min:3' => 'El campo :attribute debe superar los 3 caracteres',
            'numeric' => 'El campo :attribute debe contener solo numeros',
            'mimes:jpeg,jpg,png' => 'El campo :attribute solo admite archivos tipo: jpeg,jpg,png',
        ];
        $request->validate($rules, $customMessages);
        
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $price_send = $request->price_send;
        $colores = "";
        $talles = "";
        $colores_arr = [
            $request->color_red,
            $request->color_green,
            $request->color_yellow,
            $request->color_blue,
            $request->color_white,
            $request->color_black
        ];
        $talles_arr = [
            $request->talle_s,
            $request->talle_m,
            $request->talle_xx
        ];

        for ($i = 0; $i < count($colores_arr); $i++) {
            if($colores_arr[$i])
                $colores .= "1 ";
            else
                $colores .= "0 ";
        }

        for ($i = 0; $i < count($talles_arr); $i++) {
            if($talles_arr[$i])
                $talles .= "1 ";
            else
                $talles .= "0 ";
        }

        $producto = Producto::findOrFail($id);
        $producto->title = $title;
        $producto->description = $description;
        $producto->colors = $colores;
        $producto->talles = $talles;
        $producto->price = $price;
        $producto->price_send = $price_send;
        $image_1 = "";
        $image_2 = "";
        $image_3 = "";
        // cargamos las imagenes
        if($request->image_1 != null){
            $image_1 = time().".".$request->image_1->extension();
            $request->image_1->move(public_path("img_products"),$image_1);
        }
        if($request->image_2 != null){
            $image_2 = (time()+1).".".$request->image_2->extension();
            $request->image_2->move(public_path("img_products"),$image_2);
        }
        if($request->image_3 != null){
            $image_3 = (time()+2).".".$request->image_3->extension();
            $request->image_3->move(public_path("img_products"),$image_3);
        }
        // borramos las imagenes anteriores
        if($producto->image_1 != null)
            unlink(public_path('img_products/'.$producto->image_1));
        if($producto->image_2 != null)
            unlink(public_path('img_products/'.$producto->image_2));
       if($producto->image_3 != null)
            unlink(public_path('img_products/'.$producto->image_3));

        // guardamos las nuevas
        $producto->image_1 = $image_1;
        $producto->image_2 = $image_2;
        $producto->image_3 = $image_3;

        $producto->update();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto = Producto::findOrFail($id);
        if($producto->image_1 != null){
            unlink(public_path('img_products/'.$producto->image_1));
        }

        if($producto->image_2 != null){
            unlink(public_path('img_products/'.$producto->image_2));
        }
        if($producto->image_3 != null){
            unlink(public_path('img_products/'.$producto->image_3));
        }

        Producto::destroy($id);
        
        
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
