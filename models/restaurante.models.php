<?php

require_once "conexion.php";

Class ModelRestaurante{

     /*=============================================
     =            Mostrar Restaurante          =
     =============================================*/
     static public function mdlMostrarRestaurante($tabla) {

        $smt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");

        $smt -> execute();

        return $smt -> fetchAll();
        
        $smt -> close();

        $smt = null;
     }            
     /*=====  End of Mostrar Restaurante  ======*/
}