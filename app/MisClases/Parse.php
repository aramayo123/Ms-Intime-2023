<?php

namespace App\MisClases;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class Parse
{
    protected Array $ArrProducto;
    private Array $ArrCantidad;
    private Array $ArrColor;
    private Array $ArrTalle;

    public function __construct( protected $ids, protected $cantidades, protected $colores, protected $talles)
    {
        $this->ids = $ids;
        $this->cantidades = $cantidades;
        $this->colores = $colores;
        $this->talles = $talles;

        $this->Contruct();
    }

    private function getCantidades(){
        $cantidad_aux = $this->cantidades;
        $Aux = "";
        $cantidades = [];
        for ($i = 0; $i < strlen($cantidad_aux); $i++) {
            if($cantidad_aux[$i] != ' '){
                $Aux .= $cantidad_aux[$i];
                if($i == strlen($cantidad_aux)-1){
                    array_push($cantidades, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($cantidades, $Aux);
                $Aux = "";
            }
        }
        $this->ArrCantidad = $cantidades; // hasta aqui todo correcto
    }

    private function getColores(){
        $colores_aux = $this->colores;
        $Aux = "";
        $colores = [];
        for ($i = 0; $i < strlen($colores_aux); $i++) {
            if($colores_aux[$i] != '|'){
                $Aux .= $colores_aux[$i];
                if($i == strlen($colores_aux)-1){
                    array_push($colores, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($colores, $Aux);
                $Aux = "";
            }
        }
        $this->ArrColor = $colores;
    }

    private function getTalles(){
        $talles_aux = $this->talles;
        $Aux = "";
        $talles = [];
        for ($i = 0; $i < strlen($talles_aux); $i++) {
            if($talles_aux[$i] != '|'){
                $Aux .= $talles_aux[$i];
                if($i == strlen($talles_aux)-1){
                    array_push($talles, $Aux);
                    $Aux = "";
                }
            }else{
                array_push($talles, $Aux);
                $Aux = "";
            }
        }
        $this->ArrTalle = $talles;
    }
    private function Contruct(){
        $this->getCantidades();
        $this->getColores();
        $this->getTalles();

        Log::debug($this->ArrCantidad);
        Log::debug($this->ArrColor);
        Log::debug($this->ArrTalle);


        $id_productosAux = $this->ids;
        $idAux = "";
        $totalProductos = 0;
        $productos = [];
        for ($i = 0; $i < strlen($id_productosAux); $i++) {
            if($id_productosAux[$i] != ' '){
                $idAux .= $id_productosAux[$i];
                if($i == strlen($id_productosAux)-1){
                    $prodaux = Producto::findOrFail($idAux);
                    $prodaux->cantidad = $this->ArrCantidad[$totalProductos];
                    $prodaux->colors = $this->ArrColor[$totalProductos];
                    $prodaux->talles = $this->ArrTalle[$totalProductos];
                    array_push($productos, $prodaux);
                    $idAux = "";
                }
            }else{
                $prodaux = Producto::findOrFail($idAux);
                $prodaux->cantidad = $this->ArrCantidad[$totalProductos];
                $prodaux->colors = $this->ArrColor[$totalProductos];
                $prodaux->talles = $this->ArrTalle[$totalProductos];
                array_push($productos, $prodaux);
                $totalProductos++;
                $idAux = "";
            }
        }
        $this->ArrProducto = $productos;
    }

    public function getProductos(){
        return $this->ArrProducto;
    }


}