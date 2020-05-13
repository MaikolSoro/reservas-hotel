<?php

Class ControladorHabitaciones{


   /*=============================================
    Mostrar Categorias-Habitaciones con Inner join
    =============================================*/

    static public function ctrMostrarHabitaciones($valor){

        $tabla1 = "categorias";
        $tabla2 = "habitaciones";
        

        $repuesta = ModelHabitaciones::mdlMostrarHabitaciones($tabla1,$tabla2,$valor);

        return $repuesta;
    }
}