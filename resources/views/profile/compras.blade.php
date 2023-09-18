@include('layouts.header')
<main class="main-perfil">
    <div class="contenedorPerfil" style="width: 70%;">
        @if(count($tickets))
        <h2>Mis compras</h2>
        <table class="tablaCuenta">
            <tr>
                <td>Ticket</td>
                <td>Precio</td>
                <td>Fecha</td>
                <td>Estado del pago</td>
                <td>Estado del pedido</td>
                <td>Opciones</td>
            </tr>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id_mercadopago }}</td>
                    <td>${{ $ticket->price }}</td>
                    <td>{{ $ticket->date_created }}</td>
                    <td>{{ $ticket->status_detail }}</td>
                    <td>{{ $ticket->status_product }}</td>
                    <td><a class="boton boton-ticket" href="{{ url('ticket/' . $ticket->id_mercadopago) }}">Ver</a></td>
                </tr>
            @endforeach
        </table>
        @else
          <h2>No tienes compras realizadas</h2>
        @endif
    </div>
</main>

@include('layouts.footer')
