@include('layouts.header')

<main class="main-perfil">
    <div class="contenedorPerfil contenedorTicket">
        <h2>Ticket #{{ $ticket->id_mercadopago }}</h2>
        <table class="tablaCuenta ticketCuenta">
            <tr class="campos">
                <td>ID</td>
                <td>Producto</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td>Color</td>
                <td>Talle</td>
            </tr>

            
            @if (count($productos) > 0)
                @foreach ($productos as $producto)
                    <tr class="datos">
                        <td>#{{ $producto->id }}</td>
                        <td style="display: flex;align-items: center;gap: 1rem;flex-wrap: wrap;">
                            <img src="{{ asset('img_products/' . $producto->image_1) }}" alt="">
                            <p>{{ $producto->title }}</p> 
                        </td>
                        <td>{{ $producto->description }}</td>
                        <td>${{ $producto->price }}</td>
                        <td>
                            @php
                            $colores_arr = ['red', 'null', 'green', 'null', 'yellow', 'null', 'blue', 'null', 'black', 'null', 'white', 'null'];
                            $aux = $producto->colors;
                            for ($value = 0; $value < strlen($aux); $value++) {
                                if ($aux[$value] == '1') {
                                    echo '<div class="point point-' . $colores_arr[$value] . '"></div>';
                                }
                            }
                            @endphp
                        </td>
                        <td>
                            @php
                            $talles_arr = ['S ', 'null', 'M ', 'null', 'XX ', 'null'];
                            $palabra = '';
                            $aux = $producto->talles;
                            for ($value = 0; $value < strlen($aux); $value++) {
                                if ($aux[$value] == '1') {
                                    $palabra .= $talles_arr[$value];
                                }
                            }
                            echo $palabra;
                            @endphp
                        </td>
                    </tr>
                @endforeach
            @else
                <p>No hay productos en la compra</p>
            @endif
        </table>
        <table class="tablaCuenta ticketCuenta ticketCuenta--Ticket">
            <tr class="campos">
                <td>Fecha</td>
                <td>Estado del pago</td>
                <td>Estado del pedido</td>
                <td>Direccion</td>
                <td>Contacto</td>
                <td>Detalles</td>
            </tr>
            <tr class="datos">
            <td>{{ $ticket->date_created }}</td>
            <td>{{ $ticket->status }}</td>
            <td>{{ $ticket->status_product }}</td>
            <td>{{ $ticket->direction }}</td>
            <td>{{ $ticket->contact }}</td>
            <td>{{ $ticket->detalles }}</td>
            </tr>
        </table>
        @auth
            @if(Auth::user()->email == "admin@gmail.com" &&
            $ticket->status == "El pago ha sido aprobado y acreditado" &&
            $ticket->status_product == "Sin entregar")
                <form action="{{ url('/actualizar') }}" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                    <button type="submit" class="boton boton-actualizar">Actualizar Pedido</button>
                </form>
            @endif
        @endauth
       
    </div>
</main>

@include('layouts.footer')
