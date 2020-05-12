<?php

Class ControladorRestaurante{
    
    /*=============================================
    =            Section Mostrar Recorrido           =
    =============================================*/
                                                  
    static public function ctrMostrarRestaurante(){

        $tabla = "restaurante";

        $respuesta = ModelRestaurante::mdlMostrarRestaurante($tabla);

        return $respuesta;
    }
                                                  
                                                  
    /*=====  End of Section  Mostrar Recorrido ======*/

}