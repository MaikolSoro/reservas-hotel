<?php

require_once "conexion.php";

Class ModelBanner{

     /*=============================================
     =            Mostrar Banner           =
     =============================================*/
     static public function mdlMostrarBanner($tabla) {

        $smt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");

        $smt -> execute();

        return $smt -> fetchAll();
        
        $smt -> close();

        $smt = null;
     }            
     /*=====  End of Mostrar Banner  ======*/
}