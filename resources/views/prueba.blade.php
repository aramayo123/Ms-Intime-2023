<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!--
        container: contenedor
        bg-color-number: bg background, color es color, number el numero
        mx-auto: margin auto, centra
        grid: grid para crear una grid
        grid-cols-number: determinamos de cuantas columnas va a ser nuestro grid
        col-span-number: determinamo cuantas columna ocupara tal cosa
        col-start-number: determinamos donde comienza la columna
        grid-rows-number: determinamos cuantas filas maximas pueden ocupar
        row-span-2: determinamos cual ocupa 2 filas
        grid-flow-cols: con esto determinamos que el orden va a ser respecto a las filas
        gap-number: da una separacion a los componentes dee cada uno (x e y)
        gap-x-number: solo al x
        gap-y-number: solo al y
        p-number: padding top,left,rigth y button de 2
        ul>(li>a)*5
        justify-content: alinieacion en el eje de las X
        w-number: width numero
        px-4: padding costados
        py-3: padding arriba y abajo
        z-number: zindex
        left-0: 
        my-4: margin top y buttom 4
    -->
    <!--
    <div class=" bg-yellow-300 mx-auto">
        <nav class="bg-gray-800 flex justify-between lg:justify-start items-center">
            <div class="logo p-2 w-1/6">
                <img src="{{ asset('img_products/1686077753.png') }}" height="50" width="100" alt="">
            </div>
            <div class="links lg:block hidden w-1/6 md:w-4/6">
                <ul class="menu flex items-center justify-center gap-5">
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Home</a></li>
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Play</a></li>
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Explore</a></li>
                    <li><a href="" class="border-4 border-yellow-400 text-white font-bold p-2 rounded-full hover:bg-white hover:text-black transition duration-500">Bowser Fury</a></li>
                    <li><a href="" class="rounded-full bg-red-500 text-white font-bold px-4 py-3 hover:bg-white hover:text-red-500 transition duration-500">Buy Now</a></li>
                </ul>
            </div>


            <div class="block lg:hidden w-1/6 lg:w-4/6">
                <a href="#" class="link" id="mobile-menu">Abrir menu</a>
                <ul class="mobile-links hidden w-full absolute z-50 left-0 text-center bg-gray-800">
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Home</a></li>
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Play</a></li>
                    <li><a href="" class="text-white block p-5 font-bold hover:text-yellow-500">Explore</a></li>
                    <li><a href="" class="my-4 inline-block border-4 border-yellow-400 text-white font-bold p-2 rounded-full hover:bg-white hover:text-black transition duration-500">Bowser Fury</a></li>
                    <li><a href="" class="my-4 inline-block rounded-full bg-red-500 text-white font-bold px-4 py-3 hover:bg-white hover:text-red-500 transition duration-500">Buy Now</a></li>
                </ul>
            </div>
        </nav>
    </div>
    !-->
    <div class="principal mx-auto">
        <!-- ACA ES AL REVEZ !-->
        <nav class="bg-yellow-500 flex justify-between sm:justify-center  items-center">
            <div class="sm:block hidden">
                <ul class="flex items-center justify-center gap-2 py-2">
                    <li><a href="" class=" text-black px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Inicio</a></li>
                    <li><a href="" class=" text-black px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Nosotros</a></li>
                    <li><a href="" class=" text-black px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Ayuda</a></li>
                    <li><a href="" class=" text-black px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Contacto</a></li>
                    <li><a href="" class=" text-black px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Yella</a></li>
                </ul>
            </div>

            <div class="block sm:hidden">
                <a href="#" class="link" id="mobile-menu">abrir menu</a>
                <ul class="mobile-links hidden w-full absolute z-50 left-0 text-center bg-yellow-500">
                    <li><a href="" class=" text-black block px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Inicio</a></li>
                    <li><a href="" class=" text-black block px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Nosotros</a></li>
                    <li><a href="" class=" text-black block px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Ayuda</a></li>
                    <li><a href="" class=" text-black block px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Contacto</a></li>
                    <li><a href="" class=" text-black block px-4 py-2 hover:text-white hover:bg-red-500 transition duration-500 rounded-full">Yella</a></li>
                </ul>
            </div>
        </nav>


    </div>

    
</body>
<script>
    const menuButtom = document.querySelector('#mobile-menu');
    if(menuButtom)
        menuButtom.addEventListener('click', e => {
            const menu = document.querySelector('.mobile-links');
            menu.classList.toggle('hidden');
        })
</script>
</html>
