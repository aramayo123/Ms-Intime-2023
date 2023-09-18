@include('layouts.header')
@php
    $tamano = count($productos);
    $array_json = json_encode($productos);
@endphp
<!-- PORTADA -->
<div class="portada">
    <p class="portada__texto">Mr Intime</p>
    <ul class="portada__lista">
        <li class="portada__item">Te asesoramos</li>
        <li class="portada__item">CONTACTANOS</li>
        <li class="portada__item">Encontra todo para tu cuerpo</li>
        <li class="portada__item"><button class="portada__boton boton">WHATSAPP</button></li>
    </ul>
</div>
<button class="wpp boton"><img src="sources/wpp.png" alt=""></button>
<!-- MAIN -->
<main class="main">
    <section class="main__primera seccion">
        <h2>No sabes que elegir?</h2>
        <p>Explora y descubri nuestros productos</p>
        <ul class="lista">
            <li class="lista__item boton">ROPA INTERIOR</li>
            <li class="lista__item boton">COMPLEMENTARIOS</li>
            <li class="lista__item boton">EXTRAS</li>
        </ul>
    </section>
    <section class="main__segunda seccion">
        <h2>ROPA INTERIOR SUPERIOR</h2>
        <ul class="lista__row seccionProductos">
            @if ($tamano > 0)
                @foreach ($productos as $producto)
                    <div class="card boton">
                    @Auth
                        @if (Auth::user()->email == "admin@gmail.com")
                            <a class="botonEditar" href="{{ url('/productos/' . $producto->id . '/edit') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </a>
                            <form action="{{ url('/productos/' . $producto->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="botonBorrar" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @endAuth
                        <a href="{{ url('show/' . $producto->id) }}">
                            @if ($producto->image_1 != null)
                                <img class="item-image" src="{{ asset('img_products/' . $producto->image_1) }}"
                                    alt="">
                            @endif

                            <h2>{{ $producto->title }}</h2>
                            <p class="card-text">${{ $producto->price }}</p>
                        </a>

                    </div>
                @endforeach
            @else
                <h1>No hay productos para mostrar</h1>
            @endif
        </ul>
    </section>
</main>
<script>
    const stockProductos = <?php if (!empty($array_json)) {
        echo $array_json;
    } ?>;
</script>
@include('layouts.footer')
