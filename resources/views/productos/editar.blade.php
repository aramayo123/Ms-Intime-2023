@include('layouts.header')
<style>
    .checkboxs {
        display: flex;
        flex-direction: column;
    }

    .checkboxs_1 {
        display: flex;
        flex-direction: row;
        gap: 3rem;
    }

    .card-img-top {
        max-width: 200px;
        max-height: 200px;
    }

    img {
        width: 100px;
        height: 100px;
    }

    .error {
        color: red
    }
</style>


<main class="main-perfil">
    <div class="contenedorPerfil">
        <h2>Agregar Producto:</h2>
        <form action="{{ url('/productos/' . $producto->id) }}" method="post" enctype="multipart/form-data"
            class="formPerfil">
            @csrf
            @method('patch')
            <!-- TITLE !-->
            <label for="title">Titulo del producto</label>
            <x-text-input class="form-control" type="text" name="title" :value="old('title')"
                value="{{ $producto->title }}" autofocus autocomplete="title" id="title"/>
            <!-- ERRRORS TITLE !-->
            @if ($errors->get('title'))
                @foreach ($errors->get('title') as $error)
                    <div class="error">
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg> {{ $error }}</p>
                    </div>
                @endforeach
            @endif

            <!-- DESCRIPTION !-->
            <label for="description">Descripcion del producto</label>
            <x-text-input type="text" class="form-control" name="description" :value="old('description')"
                value="{{ $producto->description }}" id="description"/>
            <!-- ERRRORS DESCRIPTION !-->
            @if ($errors->get('description'))
                @foreach ($errors->get('description') as $error)
                    <div class="error">
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg> {{ $error }}</p>
                    </div>
                @endforeach
            @endif

            <p>Color</p>
            <div class="opcionesColor">
                @php
                    $colores_arr = ['red', 'green', 'yellow', 'blue', 'black', 'white'];
                    $traduccion = ['Rojo', 'Verde', 'Amarillo', 'Azul', 'Negro', 'Blanco'];
                    $casos = [0, 0, 0, 0, 0, 0];
                    $aux = $producto->colors;
                    $contador = 0;
                    for ($value = 0; $value < strlen($aux); $value++) {
                        if ($aux[$value] == '1') {
                            $casos[$contador] = 1;
                            $contador++;
                        }
                        if ($aux[$value] == '0') {
                            $contador++;
                        }
                    }
                    for ($value = 0; $value < count($colores_arr); $value++) {
                        $checked = $casos[$value] ? 'checked' : '';
                        echo '
                    <label class="boton" for="color_' .
                            $colores_arr[$value] .
                            '">
                        <input type="checkbox" ' .
                            $checked .
                            ' class="producto__radio-input" name="color_' .
                            $colores_arr[$value] .
                            '" id="color_' .
                            $colores_arr[$value] .
                            '" value="color_' .
                            $colores_arr[$value] .
                            '" />
                        <div class="option producto__radio-texto producto__radio-texto--color producto__radio-texto--' .
                            $colores_arr[$value] .
                            '">
                            <div class="point point-' .
                            $colores_arr[$value] .
                            '"></div>
                            <p>' .
                            $traduccion[$value] .
                            '</p>
                        </div>
                    </label>
                    ';
                    }
                @endphp
            </div>
            <p>Talle</p>
            <div class="opcionesTalle">
                @php
                    $talles_arr = ['s', 'm', 'xx'];
                    $traduccion = ['S', 'M', 'XX'];
                    $casos = [0, 0, 0];
                    $aux = $producto->talles;
                    $contador = 0;
                    for ($value = 0; $value < strlen($aux); $value++) {
                        if ($aux[$value] == '1') {
                            $casos[$contador] = 1;
                            $contador++;
                        }
                        if ($aux[$value] == '0') {
                            $contador++;
                        }
                    }

                    for ($value = 0; $value < count($talles_arr); $value++) {
                        $checked = $casos[$value] ? 'checked' : '';
                        echo '
                    <label class="boton" for="talle_' .
                            $talles_arr[$value] .
                            '">
                        <input
                            type="checkbox"
                            class="producto__radio-input"
                            name="talle_' .
                            $talles_arr[$value] .
                            '"
                            id="talle_' .
                            $talles_arr[$value] .
                            '"
                            value="talle_' .
                            $talles_arr[$value] .
                            '"
                            ' .
                            $checked .
                            '
                        />
                        <p
                            class="boton option producto__radio-texto producto__radio-texto--color producto__radio-texto--rojo"
                        >
                            ' .
                            $traduccion[$value] .
                            '
                        </p>
                    </label>
                    ';
                    }
                @endphp
            </div>

            <img id="imagenSeleccionada_1" class="card-img-top">
            <!-- IMAGE_1 !-->
            <div style="width: 53%;">
                <input style="font-size: 0.8rem;" type="file" name="image_1" id="image_1"
                    class="form-control me-2">
                @if ($errors->get('image_1'))
                    @foreach ($errors->get('image_1') as $error)
                        <div class="error">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg> {{ $error }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <img id="imagenSeleccionada_2" class="card-img-top">
            <!-- IMAGE_2 !-->
            <div style="width: 53%;">
                <input style="font-size: 0.8rem;" type="file" name="image_2" id="image_2"
                    class="form-control me-2">
                @if ($errors->get('image_2'))
                    @foreach ($errors->get('image_2') as $error)
                        <div class="error">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg> {{ $error }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <img id="imagenSeleccionada_3" class="card-img-top">
            <!-- IMAGE_3 !-->
            <div style="width: 53%;">
                <input style="font-size: 0.8rem;" type="file" name="image_3" id="image_3"
                    class="form-control me-2">
                @if ($errors->get('image_3'))
                    @foreach ($errors->get('image_3') as $error)
                        <div class="error">
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg> {{ $error }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- PRICE !-->
            <label for="price">Precio: </label>
            <input type="number" name="price" value="{{ $producto->price }}" id="price">
            @if ($errors->get('price'))
                @foreach ($errors->get('price') as $error)
                    <div class="error">
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg> {{ $error }}</p>
                    </div>
                @endforeach
            @endif
            <!-- PRICE SEND !-->
            <label for="price_send">Precio de envio: </label>
            <input type="number" name="price_send" value="{{ $producto->price_send }}" id="price_send">
            @if ($errors->get('price_send'))
                @foreach ($errors->get('price_send') as $error)
                    <div class="error">
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg> {{ $error }}</p>
                    </div>
                @endforeach
            @endif
            <button class="enviarPerfil boton">Actualizar producto</button>
        </form>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(e) {
        $('#image_1').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada_1').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#image_2').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada_2').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#image_3').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada_3').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
@include('layouts.footer')

