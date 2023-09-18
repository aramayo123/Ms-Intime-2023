<!DOCTYPE html>
<html lang="en" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin: 0;">


    @php
        $tamanio = count($Productos);
        $precioTotal = 0;
    @endphp


    <header style="display: flex;justify-content: center;display: flex;align-items: center;background-color: #F3F1E4;height: 10rem;"><img style="width: 4rem;height: 4rem;" class="cabecera__logo boton" 
        src="{{ asset('sources/logo.jpg') }}" alt="logo" />
    </header>
    <main style="min-height: 70vh;display: flex;flex-direction: column;justify-content: space-evenly;">
        <div style="width: 80%;margin: 2rem auto;text-align: center;">
            <h1>Su compra ha sido procesada!</h1>
            <p style="font-size: 1.4rem;">Quieres seguir viendo productos?</p>
            <a style="border: 1px solid black;width: 4rem; height: 2rem; text-decoration: none; color: black; background-color: #F3F1E4;
            border-radius: 10px; padding: 0.4rem;
            " href="{{ url('/')}}">Visitar la tienda</a>
        </div>
        
        <table style="margin: auto; display: block;width: fit-content; max-width: 100% ;overflow: auto;">
            <tr style="background-color: #F3F1E4;">
                <td style="padding: 1rem;"></td>
                <td style="padding: 1rem;">Nombre del producto</td>
                <td style="padding: 1rem;">Descripcion</td>
                <td style="padding: 1rem;">Precio</td>
                <td style="padding: 1rem;">Cantidad</td>
                <td style="padding: 1rem;">Colores</td>
                <td style="padding: 1rem;">Talles</td>
            </tr>
            @foreach ($Productos as $producto)
                <?php $precioTotal += $producto->price*$producto->cantidad; ?>
                <tr>
                    <td style="padding: 1rem;">
                        <div style="display: flex;justify-content: center;align-items: center;gap: 2rem;">
                            <img style="width: 4rem;" src="{{ asset('img_products/' . $producto->image_1) }}" alt="">
                        </div>
                    </td>
                    <td style="padding: 1rem;"><p>{{ $producto->title }}</p></td>
                    <td style="padding: 1rem;">{{ $producto->description }}</td>
                    <td style="padding: 1rem;">${{ $producto->price }}</td>
                    <td style="padding: 1rem;">{{ $producto->cantidad }}</td>

                    <td style="padding: 1rem;">
                        @php
                            $colores_arr = ['Rojo ', 'null', 'Verde ', 'null', 'Amarillo ', 'null', 'Azul', 'null', 'Negro ', 'null', 'Blanco', 'null'];
                            $palabra = '';
                            $aux = $producto->colors;
                            for ($value = 0; $value < strlen($aux); $value++) {
                                if ($aux[$value] == '1') {
                                    $palabra .= $colores_arr[$value];
                                }
                            }
                            echo $palabra;
                        @endphp
                    </td>
                    
                    <td style="padding: 1rem;">
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
                    </td>
                </tr>
            @endforeach
        </table>
        <center>
			<p style="font-size: 1.4rem;">Direccion: {{ $Direccion }}</p>
			<p style="font-size: 1.4rem;">Telofono de contacto: {{ $Telefono }}</p>
			<p style="font-size: 1.4rem;">Detalles extras de la compra: {{ $Detalles }}</p>
			<p style="font-size: 1.4rem;">Total: ${{$precioTotal}}</p>
		</center>
    </main>
    <footer style="background-color: antiquewhite;padding: 1rem; margin-top: 2rem;">
        <div style="display: flex;justify-content: space-evenly;width: 60%;margin: auto;" class="redes">
            <div style="width: 2rem;height: 2rem;">
                <svg class="svg-inline--fa svg-icon-text" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
            </div>
            <div style="width: 1.4rem;height: 1.4rem;" class="fb boton">
                <svg class="svg-inline--fa svg-icon-text" viewBox="0 0 320 512"><path d="M279.1 288l14.3-92.7h-89v-60c0-25.4 12.5-50.2 52.3-50.2H297V6.4S260.4 0 225.4 0C152 0 104.3 44.4 104.3 124.7v70.6H22.9V288h81.4v224h100.2V288z"></path></svg>
            </div>
            <div style="width: 2rem;height: 2rem;" class="tt boton">
                <svg class="svg-inline--fa svg-icon-text" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"></path></svg>
            </div>
        </div>
    </footer>
</body>
</html>
