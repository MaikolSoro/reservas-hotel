<?php

require_once "conexion.php";

Class ModelCategorias{


      /*=============================================
     =            Mostrar Categorias           =
     =============================================*/
     static public function mdlMostrarCategorias($tabla) {

        $smt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");

        $smt -> execute();

        return $smt -> fetchAll();
        
        $smt -> close();

        $smt = null;
     }            
     /*=====  End of Mostrar Categorías  ======*/
}