@include('layouts.header')
@php
    $array_json = json_encode($productos);
@endphp
    <!-- MAIN -->
    <main class="productoMain">
        <div class="informacionProducto">
            <div class="informacionBasica">
                <h2>{{ $producto->title}} </h2>
                <p>{{ $producto->description}}</p>
            </div>
            <div class="imagenesPrevia">
                <div class="imagenVPrevia">
                    @if ($producto->image_1 != null)
                        <img id="imgChange" src="{{ asset('img_products/' . $producto->image_1) }}" alt="">
                    @endif
                </div>
                <section class="sectionInfo">
                    <ul class="thumbs">
                        @if ($producto->image_1 != null)
                            <img src="{{ asset('img_products/' . $producto->image_1) }}" class="boton" id="img1" alt="">
                        @endif
                        @if ($producto->image_2 != null)
                            <img src="{{ asset('img_products/' . $producto->image_2) }}" class="boton" id="img2" alt="">
                        @endif
                        @if ($producto->image_3 != null)
                            <img src="{{ asset('img_products/' . $producto->image_3) }}" class="boton" id="img3" alt="">
                        @endif
                    </ul>
                </section>
            </div>
            
            <div class="informacionCompra">
                <div class="informacionBasica2">
                    <h2>{{ $producto->title}}</h2>
                    <p>{{ $producto->description}}</p>
                </div>
                <div class="opcionesColor">
                    <p>Color</p>
                    @php
                        $colores_arr = ['red', 'null', 'green', 'null', 'yellow', 'null', 'blue', 'null', 'black', 'null', 'white', 'null'];
                        $aux = $producto->colors;
                        for ($value = 0; $value < strlen($aux); $value++) {
                            if ($aux[$value] == '1') {
                                echo '
                                <label class="boton" for="color_'.$colores_arr[$value].'">
                                    <input
                                        type="checkbox"
                                        class="producto__radio-input"
                                        name="color_'.$colores_arr[$value].'"
                                        id="color_'.$colores_arr[$value].'"
                                        value="color"
                                    />
                                    <div class="option producto__radio-texto producto__radio-texto--color producto__radio-texto--'.$colores_arr[$value].'">
                                        <div class="point point-'.$colores_arr[$value].'"></div>
                                        <p>'.strtoupper($colores_arr[$value]).'</p>
                                    </div>
                                </label>';
                            }else if($aux[$value] == '0'){
                                echo '
                                <label style="display: none;" class="boton" for="color_'.$colores_arr[$value].'">
                                    <input
                                        type="checkbox"
                                        class="producto__radio-input"
                                        name="color_'.$colores_arr[$value].'"
                                        id="color_'.$colores_arr[$value].'"
                                        value="color"
                                    />
                                    <div class="option producto__radio-texto producto__radio-texto--color producto__radio-texto--'.$colores_arr[$value].'">
                                        <div class="point point-'.$colores_arr[$value].'"></div>
                                        <p>'.strtoupper($colores_arr[$value]).'</p>
                                    </div>
                                </label>';
                            }
                        }
                    @endphp
                    
                </div>
                <div id="ErrorColores">

                </div>
                
                <div class="opcionesTalle">
                    <p>Talle</p>
                    @php
                        $talles_arr = ['S ', 'null', 'M ', 'null', 'XX ', 'null'];
                        $aux = $producto->talles;
                        for ($value = 0; $value < strlen($aux); $value++) {
                            if ($aux[$value] == '1') {
                                echo '
                                <label class="boton" for="talle_'.$talles_arr[$value].'">
                                    <input
                                        type="checkbox"
                                        class="producto__radio-input"
                                        name="talle_'.$talles_arr[$value].'"
                                        id="talle_'.$talles_arr[$value].'"
                                        value="talle"
                                    />
                                    <p
                                        class="boton option producto__radio-texto producto__radio-texto--color producto__radio-texto--rojo"
                                    >
                                        '.$talles_arr[$value].'
                                    </p>
                                </label>
                                ';
                            }else if($aux[$value] == '0'){
                                echo '
                                <label style="display: none;" class="boton" for="talle_'.$talles_arr[$value].'">
                                    <input
                                        type="checkbox"
                                        class="producto__radio-input"
                                        name="talle_'.$talles_arr[$value].'"
                                        id="talle_'.$talles_arr[$value].'"
                                        value="talle"
                                    />
                                    <p
                                        class="boton option producto__radio-texto producto__radio-texto--color producto__radio-texto--rojo"
                                    >
                                        '.$talles_arr[$value].'
                                    </p>
                                </label>
                                ';
                            }
                        }
                    @endphp
                </div>
                <div id="ErrorTalles">

                </div>
             
                <div class="opcionesCantidad">
                    <label for="cantidadProd">Cantidad</label>
                    <div class="cantidadContainer">
                        <button class="boton-incdec" id="btn-dec">-</button>
                        <input type="number" value="{{ $producto->cantidad }}" id="cantidadProd" name="tentacles" min="1" max="100">
                        <button class="boton-incdec" id="btn-inc">+</button>
                      </div>
                </div>
                <div id="errores">
                </div>
                <div id="exito"> 

                </div>
                <div class="comprarContainer">
                    <div class="precio">
                        <p>Precio</p>
                        <h3>${{ $producto->price }} </h3>
                        <h4>Envio: ${{ $producto->price_send }}</h4>
                    </div>
                    <button class="agregarCarrito boton" onclick="CheckAgregar({{ $producto->id }})" >
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
        <footer>
            <div class="botonesSecciones">
                <button class=" boton" id="cont1">
                    <label for="caracteristicas">
                        <input class="seccion__radio-input" id="caracteristicas" value="caracteristicas" type="radio" name="secciones">
                        <p class="seccionFooter boton seccion__radio-texto">Caracteristicas</p>
                    </label>
                    
                </button>
                <button class="boton" id="cont2">
                    <label for="resenas">
                        <input class="seccion__radio-input" id="resenas" value="resenas" type="radio" name="secciones">
                        <p class="seccionFooter boton seccion__radio-texto">Reseñas</p>
                    </label>
                    
                </button>
                <button class="boton" id="cont3">
                    <label for="envio">
                        <input class="seccion__radio-input" id="envio" value="envio" type="radio" name="secciones">
                        <p class="seccionFooter boton seccion__radio-texto">Envio</p>
                    </label>
                    
                </button>
            </div>
            <div id="contenido1" class="caracteristicas contenedor">
                <h3>
                    Caracteristicas
                </h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe accusamus in aspernatur repellendus quasi neque tempora expedita culpa. Voluptatibus hic esse molestiae, vel odit unde harum voluptate molestias corporis illum.
                </p>
            </div>
            <div id="contenido2" class="resenas contenedor" style="display: none;">
                <h3>Reseñas</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla vel accusantium tenetur praesentium, dolorum, quae voluptates repellat odio voluptatum repudiandae sint omnis soluta, perspiciatis modi. Officiis similique possimus repellendus modi?</p>
            </div>
            <div id="contenido3" class="envio contenedor" style="display: none;">
                <h3>Envio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quis neque nesciunt nisi, consequatur obcaecati nam, esse dicta in dolore odio aliquam a ullam minima ratione. Molestiae obcaecati fugit velit.</p>
            </div>
            
        </footer>
    </main>

    <center style="background-color: rgb(241, 241, 241);">
    
        <br><br>
        <a href="{{ url('/shop') }}" class="boton boton-crear">Volver a la tienda</a>
        
        <br><br><br>
    </center>

@include('layouts.footer')
<script> 
    const stockProductos = <?php if (!empty($array_json)) {
        echo $array_json;
    } ?>;
    
    // OPCIONES DE IMAGENES
    let img1 = document.getElementById('img1');
    let img2 = document.getElementById('img2');
    let img3 = document.getElementById('img3');

    if(img1)
        img1.onclick=function(){
            imgChange.src= '{{ asset('img_products/' . $producto->image_1) }}'
        }
    if(img2)
        img2.onclick=function(){
            imgChange.src= '{{ asset('img_products/' . $producto->image_2) }}'
        }
    if(img3)
        img3.onclick=function(){
            imgChange.src= '{{ asset('img_products/' . $producto->image_3) }}'
        }

    const colores = document.querySelectorAll('.producto__radio-input');
    const BotonAgregarCarrito = document.querySelector('#AgregarAlCarrito');
   
    var lastTimeout;
    var lastTimeout_2;
    const CheckAgregar = (id) => {
        var Errores = document.querySelector('#errores')
        var Exito = document.querySelector('#exito')
        Errores.innerHTML = "";
        Exito.innerHTML = "";

        var ErrorColores = document.querySelector('#ErrorColores')
        var ErrorTalles = document.querySelector('#ErrorTalles')
        ErrorColores.innerHTML = "";
        ErrorColores.innerHTML = "";

        var colores_arr = "";
        var talles_arr = "";

		var cont_colors = 0;
        var cont_talles = 0;
        colores.forEach((a) => { 
            if(a.value == 'color'){
                if(a.checked){
                    cont_colors++
                    colores_arr += "1 ";
                }else
                    colores_arr += "0 ";
            }
            if(a.value == 'talle'){
                if(a.checked){
                    cont_talles++
                    talles_arr += "1 ";
                }else
                    talles_arr += "0 ";
            }
        })
        
        var Cantidades = document.querySelector('#cantidadProd')

        if(!cont_colors){
            ErrorColores.innerHTML +=`
                <div style="color: red;">
                    Debes seleccionar almenos un color
                </div>
                `;
            return
        }
        
        if(!cont_talles){
            ErrorTalles.innerHTML +=`
                <div style="color: red;">
                    Debes seleccionar almenos un talle
                </div>
                `;
            return
        }

        if(Cantidades.value < cont_colors || Cantidades.value < cont_talles){
            Errores.innerHTML +=`
                <div class="errorMensaje">
                    <p>La cantidad no puede ser menor que la cantidad de colores o talles seleccionados</p>
                </div>
                `;
            return
        }
        agregarProducto(id,Cantidades.value,colores_arr,talles_arr)
        
        
        Exito.innerHTML = "";
        Exito.innerHTML +=`
                <div class="logroMensaje">
                    <p>El producto fue agregado al carrito con exito!</p>
                </div>
                `;

        clearTimeout(lastTimeout);
        lastTimeout = setTimeout(() => {
            Exito.innerHTML = "";
        }, 3000);
        

        var MostrarCarrito = document.querySelector('.cabecera__carrito') 
        MostrarCarrito.style.display="flex";

        clearTimeout(lastTimeout_2);
        lastTimeout_2 = setTimeout(() => {
            MostrarCarrito.style.display="none";
        }, 3000);
        return
	}

</script>
