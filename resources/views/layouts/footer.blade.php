<footer class="footer">
    <div class="redes">
        <div class="ig boton">
            <svg class="svg-inline--fa svg-icon-text" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                </path>
            </svg>
        </div>
        <div class="fb boton">
            <svg class="svg-inline--fa svg-icon-text" viewBox="0 0 320 512">
                <path
                    d="M279.1 288l14.3-92.7h-89v-60c0-25.4 12.5-50.2 52.3-50.2H297V6.4S260.4 0 225.4 0C152 0 104.3 44.4 104.3 124.7v70.6H22.9V288h81.4v224h100.2V288z">
                </path>
            </svg>
        </div>
        <div class="tt boton">
            <svg class="svg-inline--fa svg-icon-text" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z">
                </path>
            </svg>
        </div>
    </div>
</footer>
@if (!str_contains(Request::url(), '/procesar'))
    <script src="{{ asset('js/main.js') }}"></script>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script>

    var carrito = []; // var global, let function, const constante
    const ContadorCarrito = document.querySelector('#NumCarrito');
    const vaciarCarrito = document.querySelector('#vaciarcarrito');
    const precioTotal = document.querySelector('#precioTotal');

    if (vaciarCarrito) {
        vaciarCarrito.addEventListener('click', () => {
            carrito.length = 0;
            mostrarCarrito()
        })
    }
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

        mostrarCarrito();
    });
    const agregarProducto = (id, cantidad, colores, talles) => {
        let existe = carrito.some(prod => prod.id === id)
        if (existe) {
            carrito.forEach((producto) => {
                if (producto.id === id) {
                    producto.cantidad = cantidad
                    producto.colors = colores
                    producto.talles = talles
                }
            })
        } else {
            let item = stockProductos.find((product) => product.id === id)
            let copia_item = JSON.parse(JSON.stringify(item)) // hacemos una copia
            copia_item.cantidad = cantidad
            copia_item.colors = colores
            copia_item.talles = talles
            carrito.push(copia_item)
        }
        mostrarCarrito()
    };

    const mostrarCarrito = () => {
        let modalBody = document.querySelector(".carrito-div");
        if (modalBody) {
            modalBody.innerHTML = "";
            carrito.forEach((prod) => {
                modalBody.innerHTML +=
                    `
                <li class="item__carrito">
                    <div class="item__info">
                        <img src="{{ asset('img_products/') }}/${prod.image_1}" alt="">
                        <a href="{{ url('show/${prod.id}') }}"><p>${prod.title}</p></a>
                    </div>
                    <p>${prod.description}</p>
                    <p>$${prod.price}</p>
                    <p>Cantidad: ${prod.cantidad}</p>
                    <button class="eliminar boton" onclick="eliminarProducto(${prod.id})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                    </button>
                </li>
            `
            })
        }
        if (ContadorCarrito)
            ContadorCarrito.innerText = "Productos en el carrito: " + carrito.length

        if (precioTotal) {
            precioTotal.innerText = "Total: $" + carrito.reduce(
                (acc, prod) => acc + prod.cantidad * prod.price,
                0
            );
        }
        const Procesar = document.querySelector('#procesarpago');
        if (Procesar) {
            Procesar.innerHTML = ""
            if (carrito.length > 0)
                Procesar.innerHTML = `
                @auth
                  <a href="{{ url('/procesar') }}" class="boton boton-procesar">Procesar pago</a>
                @else
                  <h5>Primero necesitas iniciar sesion</h5>
                @endauth
            `
        }
        const ContentProcesar = document.querySelector('#rellenar_procesar_pago');
        if (ContentProcesar) {
            ContentProcesar.innerHTML = "";
            carrito.forEach((prod) => {
                ContentProcesar.innerHTML +=
                    `
                    <li class="item__carrito">
                        <div class="item__info">
                            <img src="{{ asset('img_products/') }}/${prod.image_1}" alt="">
                            <a href="{{ url('show/${prod.id}') }}"><p>${prod.title}</p></a>
                        </div>
                        <p>${prod.description}</p>
                        <p>$${prod.price}</p>
                        <p>Cantidad: ${prod.cantidad}</p>
                    </li>
             `
            })
            const precioTotal2 = document.querySelector('#Precio_Total_procesar');
            if (precioTotal2) {
                precioTotal2.innerText = "Total: $" + carrito.reduce(
                    (acc, prod) => acc + prod.cantidad * prod.price,
                    0
                );
            }
        }

        guardarStorage();
    }

    function eliminarProducto(id) {
        carrito = carrito.filter((juego) => juego.id !== id);
        mostrarCarrito();
    }

    function guardarStorage() {
        const data = {
            data: carrito,
            fecha: new Date().getHours() + 1
        }
        localStorage.setItem("carrito", JSON.stringify(data));
    }
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
