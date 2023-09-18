@include('layouts.header')

<?php
$array_json = json_encode($productos);
?>

<main class="cPago">

    <div class="previaProducto previaProducto--Confirmar">
        <h2>Carrito de compras</h2>
        <li class="titulos__carrito">
            <h3>Producto</h3>
            <h3>Descripcion</h3>
            <h3>$</h3>
            <div class="accion"></div>
        </li>
        <div id="rellenar_procesar_pago">

        </div>
        <p class="precioTotal" id="Precio_Total_procesar">Total: $XX</p>
    </div>
    <div class="cPago__form">
        <h2>Por favor para completar el pago complete los siguientes datos:</h2>
        <form action="{{ url('/confirmar') }}" method="post" id="logout-form">
            @csrf
            <div class="containerForm">
                <h2>Ingrese una direccion</h2>
                <x-text-input type="text" name="direccion" placeholder="Ingrese una direccion" lass="form-control"
                    :value="old('direccion')" />
                @if ($errors->get('direccion'))
                    @foreach ($errors->get('direccion') as $error)
                        <div class="errorMensaje">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg> {{ $error }}</p>
                        </div>
                    @endforeach
                @endif
                <h2>Ingrese un telofono de contacto</h2>
                <x-text-input type="number" name="telefono" placeholder="Ingrese un numero de telefono"
                    lass="form-control" :value="old('telefono')" />

                @if ($errors->get('telefono'))
                    @foreach ($errors->get('telefono') as $error)
                        <div class="errorMensaje">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg> {{ $error }}</p>
                        </div>
                    @endforeach
                @endif

                <h2>Ingrese algun detalle extra sobre su compra</h2>
                <x-text-input type="text" name="detalles" placeholder="Puede dejar en blanco" :value="old('detalles')"/>
                <div id="enviar-formulario">

                </div>
            </div>

            <div class="containerForm">
                <button type="submit" class="boton boton-procesar" value="">Confirmar</button>
            </div>
        </form>
    </div>
    <br>
</main>

@include('layouts.footer')

<script>
    document.addEventListener("DOMContentLoaded", () => {
        carrito = [];
        var data = JSON.parse(localStorage.getItem("carrito"))
        if (data) {
            var fecha = new Date().getHours();
            //console.log(data.fecha - fecha)
            if (data.fecha - fecha > 0) { // un dia en ms
                //console.log(data)
                carrito = data.data
            } else {
                localStorage.removeItem("carrito");
                carrito = []
                console.log("carrito eliminado")
            }
        } else {
            console.log("no hay storage")
        }
        if (carrito.length > 0) {
            const completar_form = document.querySelector('#enviar-formulario');
            if (completar_form) {
                let id_prod = "";
                let cant_prod = "";
                let colors_prod = "";
                let talles_prod = "";
                //console.log(carrito)
                carrito.forEach((prod) => {
                    id_prod += prod.id + " ";
                    cant_prod += prod.cantidad + " ";
                    colors_prod += prod.colors + "|";
                    talles_prod += prod.talles + "|";
                })
                completar_form.innerHTML = '';
                completar_form.innerHTML += `
                    <input type="hidden" name="id_productos" value="${id_prod}">
                    <input type="hidden" name="cantidad_productos" value="${cant_prod}">
                    <input type="hidden" name="colors_productos" value="${colors_prod}">
                    <input type="hidden" name="talles_productos" value="${talles_prod}">
                    `;
            }
        } else {
            window.location.assign('{{ url('/shop') }}');
        }
        mostrarCarrito();
    });
</script>