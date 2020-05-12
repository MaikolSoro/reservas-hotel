<?php

require_once "conexion.php";

Class ModelRecorrido{

     /*=============================================
     =            Mostrar Recorrido del pueblo          =
     =============================================*/
     static public function mdlMostrarRecorrido($tabla) {

        $smt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");

        $smt -> execute();

        return $smt -> fetchAll();
        
        $smt -> close();

        $smt = null;
     }            
     /*=====  End of Mostrar Recorrido del pueblo  ======*/
}