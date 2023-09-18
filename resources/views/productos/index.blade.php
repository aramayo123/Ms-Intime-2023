@include('layouts.header')
<style>
    .main-admin, main {
        min-height: 0;
    }
</style>
@php
    $tamano = count($productos);
@endphp

<main class="main-admin">
    <button class="boton boton-crear"><a href="{{ route('productos.create') }}">Crear producto</a> </button>
    @if ($tamano > 0)
        <table class="panelAdmin">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TITULO</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">COLORES</th>
                    <th scope="col">TALLES</th>
                    <th scope="col">IMAGEN 1</th>
                    <th scope="col">IMAGEN 2</th>
                    <th scope="col">IMAGEN 3</th>
                    <th scope="col">PRECIO </th>
                    <th scope="col">PRECIO ENVIO</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="item">
                @foreach ($productos as $producto)
                    <tr>
                        <th scope="row">{{ $producto->id }}</th>
                        <td class="item-title">{{ $producto->title }}</td>
                        <td>{{ $producto->description }}</td>
                        <td class="coloresTD">
                            @php
                                $colores_arr = ['red', 'null', 'green', 'null', 'yellow', 'null', 'blue', 'null', 'black', 'null', 'white', 'null'];
                                $aux = $producto->colors;
                                for ($value = 0; $value < strlen($aux); $value++) {
                                    if ($aux[$value] == '1') {
                                        echo '<div class="point point-'.$colores_arr[$value].'"></div>';
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
                        <td>
                            @if ($producto->image_1)
                                <img class="item-image" src="{{ asset('img_products/' . $producto->image_1) }}"
                                    alt="">
                            @endif
                        </td>
                        <td>
                            @if ($producto->image_2)
                                <img src="{{ asset('img_products/' . $producto->image_2) }}" alt="">
                            @endif
                        </td>
                        <td>
                            @if ($producto->image_3)
                                <img src="{{ asset('img_products/' . $producto->image_3) }}" alt="">
                            @endif
                        </td>
                        <td class="item-price">{{ $producto->price }}</td>
                        <td>{{ $producto->price_send }}</td>

                        <td>
                            <div style="display: flex; flex-direction: column; gap: 1rem; justify-content: center; align-items: center;">
                                <a href="{{ url('/productos/' . $producto->id . '/edit') }}"
                                    class="boton boton-editar">Editar </a>
    
                                <form action="{{ url('/productos/' . $producto->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Borrar" class="boton boton-eliminar">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <main class="main-perfil">
        <div class="contenedorPerfil" style="width: 70%;">
            <h2>No hay productos creados</h2>
        </div>
    </main>
    @endif
</div>


<main class="main-perfil">
    <center>
        <h1>Seccion: Tickets Aprobados por entregar</h1>
    </center>
    <div class="contenedorPerfil" style="width: 70%;">
        <br>
        @if (count($tickets_aproved_pending))
            
            <table class="tablaCuenta">
                <tr>
                    <td>Ticket</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                    <td>Estado del pago</td>
                    <td>Estado del pedido</td>
                    <td>Usuario</td>
                    <td>Opciones</td>
                </tr>
                @foreach ($tickets_aproved_pending as $ticket)
                <tr>
                    <td>{{ $ticket->id_mercadopago }}</td>
                    <td>${{ $ticket->price }}</td>
                    <td>{{ $ticket->date_created }}</td>
                    <td>{{ $ticket->status_detail }}</td>
                    <td>{{ $ticket->status_product }}</td>
                    <td>{{ $ticket->Users->email }}</td>
                    <td><a class="boton boton-ticket" href="{{ url('ticket/' . $ticket->id_mercadopago) }}">Ver</a></td>
                </tr>
                @endforeach
            </table>
        @else
            <h2>No hay tickets para mostrar</h2>
        @endif
    </div>
</main>

<main class="main-perfil">
    <center>
        <h1>Seccion: Tickets Terminados</h1>
    </center>
    <div class="contenedorPerfil" style="width: 70%;">
        <br>
        @if(count($tickets_finish))
        
            <table class="tablaCuenta">
                <tr>
                    <td>Ticket</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                    <td>Estado del pago</td>
                    <td>Estado del pedido</td>
                    <td>Usuario</td>
                    <td>Opciones</td>
                </tr>
                @foreach ($tickets_finish as $ticket)
                <tr>
                    <td>{{ $ticket->id_mercadopago }}</td>
                    <td>${{ $ticket->price }}</td>
                    <td>{{ $ticket->date_created }}</td>
                    <td>{{ $ticket->status_detail }}</td>
                    <td>{{ $ticket->status_product }}</td>
                    <td>{{ $ticket->Users->email }}</td>
                    <td><a class="boton boton-ticket" href="{{ url('ticket/' . $ticket->id_mercadopago) }}">Ver</a></td>
                </tr>
                @endforeach
            </table> 
        @else
            <h2>No hay tickets para mostrar</h2>
        @endif
    </div>
</main>

<main class="main-perfil">
    <center>
        <h1>Seccion: Todos los demas tickets</h1>
    </center>
    <div class="contenedorPerfil" style="width: 70%;">
        <br>
        @if(count($tickets))
        
            <table class="tablaCuenta">
                <tr>
                    <td>Ticket</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                    <td>Estado del pago</td>
                    <td>Estado del pedido</td>
                    <td>Usuario</td>
                    <td>Opciones</td>
                </tr>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id_mercadopago }}</td>
                    <td>${{ $ticket->price }}</td>
                    <td>{{ $ticket->date_created }}</td>
                    <td>{{ $ticket->status_detail }}</td>
                    <td>{{ $ticket->status_product }}</td>
                    <td>{{ $ticket->Users->email }}</td>
                    <td><a class="boton boton-ticket" href="{{ url('ticket/' . $ticket->id_mercadopago) }}">Ver</a></td>
                </tr>
                @endforeach
            </table>
        @else
            <h2>No hay tickets para mostrar</h2>
        @endif
    </div>
</main>
@include('layouts.footer')
