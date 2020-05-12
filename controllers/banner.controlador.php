<?php

Class ControladorBanner{

    /*=============================================
    =            Mostrar banner           =
    =============================================*/
        static public function ctrMostrarBanner() {
            $tabla = "banner";

            $respuesta = ModelBanner:: mdlMostrarBanner($tabla);

            return $respuesta;
        }                                      
                                                  
                                                  
    /*=====  End of Mostrar banner  ======*/
}