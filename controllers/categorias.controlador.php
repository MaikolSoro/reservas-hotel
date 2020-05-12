<?php

Class ControladorCategorias{
    
    /*=============================================
    =            Section Mostrar Categorias           =
    =============================================*/
                                                  
    static public function ctrMostrarCategorias(){

        $tabla = "categorias";

        $respuesta = ModelCategorias::mdlMostrarCategorias($tabla);

        return $respuesta;
    }
                                                  
                                                  
    /*=====  End of Section  Mostrar Categorias ======*/

}