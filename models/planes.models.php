<?php

require_once "conexion.php";

Class ModelPlanes{

    /*=============================================
    =            Mostrar los planes           =
    =============================================*/
    static public function mdlMostrarPlanes($tabla) {

        $smt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        
        $smt -> execute();

        return $smt -> fetchAll();

        $smt -> close();

        $smt -> null;
    }

                                                  
    /*=====  End of Mostrar los planes  ======*/
}