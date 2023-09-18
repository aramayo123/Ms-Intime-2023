<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('sources/logo.jpg') }}" type="image/x-icon">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Mr Intime</title>
</head>
<body>


<!-- HEADER -->
<header class="cabecera">
    <button id="nav__btn" onclick="abrirNav()" class="cabecera__boton boton"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
      </svg></button>
    <img class="cabecera__logo boton" src="{{ asset('sources/logo.jpg') }}" alt="logo">
    <nav class="cabecera__nav" id="cabecera__nav">
        <li><a href="{{ url('/')}}">Inicio</a> </li>
        <li><a href="{{ url('/')}}">Shop</a> </li>
        @auth
            @if (Auth::user()->email == "admin@gmail.com")
                <li><a href="{{ url('/productos')}}">Administrar</a> </li>
            @endif
        @else
            <li><a href="{{ url('/login')}}">Logear</a></li>
            <li><a href="{{ url('/register')}}">Registrarse</a></li>
        @endauth
        
    </nav>
    <div class="botones">
        @auth
            <button class="cart boton contenedorRelativo" id="perfil">
                <!-- VENTANA PERFIL -->
                <div id="ventanaPerfil" class="ventanaPerfil">
                    <div><a class="cuentaCompras" href="{{ url('/compras') }}">Mis compras</a> </div>
                    <div>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input style="background: none; border: 0; color: white; cursor:pointer;" type="submit" value="Cerrar Sesion">
                        </form>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </button>  
        @endauth
        <button id="botonAbrirCarrito" class="cart boton">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
          </svg>
        </button>
    </div>
    @include('layouts.nav')
</header>