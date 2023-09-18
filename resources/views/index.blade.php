
@include('layouts.header')


<div class="container">
    @if ($tamano > 0)
        <div class="container">
            <div class="row">
                @foreach ($productos as $producto)
                    <div class="col-sm">
                        <div scope="row">cantidad {{ $producto->cantidad }}</div>
                        <div scope="row">{{ $producto->id }}</div>
                        <div class="item-title">{{ $producto->title }}</div>
                        <div>{{ $producto->description }}</div>
                        <div>
                            @php
                                $colores_arr = ['Rojo ', 'null', 'Verde ', 'null', 'Amarillo ', 'null', 'Azul ', 'null', 'Negro ', 'null', 'Blanco ', 'null'];
                                $palabra = '';
                                $aux = $producto->colors;
                                for ($value = 0; $value < strlen($aux); $value++) {
                                    if ($aux[$value] == '1') {
                                        $palabra .= $colores_arr[$value];
                                    }
                                }
                                echo $palabra;
                            @endphp
                        </div>
                        <div>
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
                        </div>
                        <div>
                            @if ($producto->image_1 != null)
                                <img class="item-image" src="{{ asset('img_products/' . $producto->image_1) }}"
                                    alt="">
                            @endif

                        </div>
                        <div>
                            @if ($producto->image_2 != null)
                                <img src="{{ asset('img_products/' . $producto->image_2) }}" alt="">
                            @endif
                        </div>
                        <td>
                            @if ($producto->image_3 != null)
                                <img src="{{ asset('img_products/' . $producto->image_3) }}" alt="">
                            @endif
                        </td>
                        <div class="item-price">{{ $producto->price }}</div>
                        <div>{{ $producto->price_send }}</div>
                        <div>
                            <button class="btn btn-warning"
                                onclick="agregarProducto({{ $producto->id }})">Agregar</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1>No hay productos para mostrar</h1>
    @endif
    </section>
</div>

<!-- START SECTION STORE -->
<div class="container" style="text-align: center;">
    <h1 id="NumCarrito">numero de elementos en el carrito: 0</h1>
    <div class="container">
        <div class="row carrito-div">

        </div>
    </div>
    <h5 id="precioTotal">precio total: </h5>
    <button class="btn btn-danger" id="vaciarcarrito">Vaciar carrito</button>
    <div id="procesarpago">

    </div>
</div>

@include('layouts.footer')