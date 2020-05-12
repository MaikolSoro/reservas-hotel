<?php

Class ControladorRecorrido{
    
    /*=============================================
    =            Section Mostrar Recorrido           =
    =============================================*/
                                                  
    static public function ctrMostrarRecorrido(){

        $tabla = "recorrido";

        $respuesta = ModelRecorrido::mdlMostrarRecorrido($tabla);

        return $respuesta;
    }
                                                  
                                                  
    /*=====  End of Section  Mostrar Recorrido ======*/

}