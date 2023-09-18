@include('layouts.header')
@php
    // SDK de Mercado Pago
    require base_path('vendor/autoload.php');
    // Agrega credenciales
    // estas credenciales en teoria estan en services.php que esta en config
    // pero las pusimos con variables de entorno, entonces estan en env
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
    
    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();
    
    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Compra de ropa';
    $item->quantity = 1;
    $item->unit_price = (int) $total_precios;

    if(!isset($detalles))
        $detalles = "Sin detalles";
    
    $preference->back_urls = [
        'success' => route('shop.terminar'),
        'failure' => route('shop.terminar'),
        'pending' => route('shop.terminar'),
    ];
    $preference->auto_return = 'approved';
    $preference->metadata = [
        'direccion' => $direccion,
        'telefono' => $telefono,
        'id_productos' => $id_productos,
        'cantidad_productos' => $cantidad_productos,
        'total_precios' => $total_precios,
        'total_cantidades' => $total_cantidades,
        'user_id' => Auth::user()->id,
        'email' => Auth::user()->email,
        'colors' => $total_colors,
        'talles' => $total_talles,
        'detalles' => $detalles,
    ];
    $preference->items = [$item];
    $preference->save();
@endphp
<style>
    .hidden{
        display: none;
    }
</style>

<main class="main-perfil">
    <div class="contenedorPerfil"
        style="text-align: center; display: flex; flex-direction: column; gap: 1rem; padding-top: 2rem;"
    >
        <h3>Estas a un paso de finalizar con tu compra</h3>
        <div class="hidden">
            <div> Dato 1: {{ $direccion }} </div>
            <div> Dato 2: {{ $telefono }} </div>
            <div> Dato 3: {{ $id_productos }} </div>
            <div> Dato 4: {{ $cantidad_productos }} </div>
            <div> Dato 5: {{ $total_precios }} </div>
            <div> Dato 6: {{ $total_cantidades }} </div>
            <div> Dato 7: {{ $total_colors }} </div>
            <div> Dato 8: {{ $total_talles }} </div>
            <div> Dato 9: {{ $detalles }} </div>
        </div>

        <div class="errorMensaje" >
            En esta instancia si deseas cancelar, o seguir con tu compra puedes hacerlo volviendo hacia atras
        </div>
        <div class="boton_mercado" id="wallet_container">

        </div>
    </div>
</main>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
        locale: 'es-AR'
    });
    const bricksBuilder = mp.bricks();
    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: '{{ $preference->id }}',
            redirectMode: "self"
        },
    });
</script>
@include('layouts.footer')
