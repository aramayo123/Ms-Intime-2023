<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    img {
        width: 100px;
        height: 100px;
    }
</style>
<body>
    <h1>correo electronico</h1>
    <p>hola</p>
    @php
        $tamanio = count($productos);
        $precioTotal = 0;
    @endphp

    <div class="container" style="text-align: center;">
        <h1 id="NumCarrito">numero de elementos en el carrito: {{ $tamanio }} </h1>
        @foreach ($productos as $producto)
            <?php $precioTotal += $producto->price*$producto->cantidad; ?>
            <div class="container">
                <div class="row carrito-div">
                    <div class="col-sm">
                        <p>Producto: {{ $producto->title }}</p>
                        <p>Precio: {{ $producto->price }}</p>
                        <p>Cantidad : {{ $producto->cantidad }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <h5 id="precioTotal">precio total: {{$precioTotal}}</h5>
    </div>
</body>
</html>
