<?php

Class ControladorReservas{

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctrMostrarReservas($valor){

		$tabla1 = "habitaciones";
		$tabla2 = "reservas";
		$tabla3 = "categorias";

		$respuesta = ModelReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);

		return $respuesta;

    }
    
}