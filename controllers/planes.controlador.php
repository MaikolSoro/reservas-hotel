<?php

Class ControladorPlanes{

    /*=============================================
    =            Section Mostrar planes           =
    =============================================*/
      static public function ctrMostrarPlanes() {
          
        $tabla = "planes";

        $respuesta = ModelPlanes:: mdlMostrarPlanes($tabla);

        return $respuesta;
      }                                                
                                                  
                                                  
    /*=====  End of Section Mostrar planes  ======*/
}