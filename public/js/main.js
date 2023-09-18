function abrirNav(){
    const nav = document.getElementById('cabecera__nav')
    if(nav){
        if(nav.style.display=="flex"){
            nav.style.display="none";
            
        }else{
            nav.style.display="flex";
        }
    }
}

const buttonCarrito = document.querySelector('#botonAbrirCarrito')

if(buttonCarrito){
    buttonCarrito.addEventListener('click', abrirCarrito);
}


function abrirCarrito(){
    const cart = document.getElementById('cabecera__carrito')
    if(cart){
        if(cart.style.display=="flex"){
            cart.style.display="none";
        }else{
            cart.style.display="flex";
        }
    }
}

let cont1 = document.getElementById('cont1');
let cont2 = document.getElementById('cont2');
let cont3 = document.getElementById('cont3');
let contenido1 = document.getElementById('contenido1');
let contenido2 = document.getElementById('contenido2');
let contenido3 = document.getElementById('contenido3');

if(contenido2)
    contenido2.style.display='none';
if(contenido3)
    contenido3.style.display='none';

if(cont1)
    cont1.onclick=function(){
        contenido1.style.display='block';
        contenido2.style.display='none';
        contenido3.style.display='none';
    }
if(cont2)
    cont2.onclick=function(){
        contenido1.style.display='none';
        contenido2.style.display='block';
        contenido3.style.display='none';
    }
if(cont3)
    cont3.onclick=function(){
        contenido1.style.display='none';
        contenido2.style.display='none';
        contenido3.style.display='block';
    }

const element = document.getElementById('perfil'); 
const ventanaPerfil = document.getElementById('ventanaPerfil');

if(element)
    element.addEventListener('click', ()=>{
        if(ventanaPerfil)
            ventanaPerfil.classList.toggle('active');
    });


// Incremento y decremento de cantidad
const cantidad= document.querySelector('#cantidadProd')
const disminuirBtn= document.querySelector('#btn-dec')
const incrementarBtn= document.querySelector('#btn-inc')
if(cantidad)
    cantidad.value = 1

if(disminuirBtn)
    disminuirBtn.addEventListener('click',(e)=>{
        const cantidadValor=(cantidad.value)
        let cantidadV= parseInt(cantidadValor)
        if(cantidadV>1){
            cantidadV--;
            cantidad.value=cantidadV
        }
    })

if(incrementarBtn)
    incrementarBtn.addEventListener('click',(e)=>{
        const cantidadValor=(cantidad.value)
        let cantidadV= parseInt(cantidadValor)
        if(cantidadV < 100){
            cantidadV++;
            cantidad.value = cantidadV
        }
    })
