<?php

require_once "../controllers/reservas.controlador.php";
require_once "../models/reservas.models.php";


class AjaxReservas{

	/*=============================================
	Traer Reserva Habitación
	=============================================*/

	public $idHabitacion;

	public function ajaxTraerReserva(){

		$valor = $this->idHabitacion;

		$respuesta = ControladorReservas::ctrMostrarReservas($valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
Traer Reserva Habitación
=============================================*/

if(isset($_POST["idHabitacion"])){

	$idHabitacion = new AjaxReservas();
	$idHabitacion -> idHabitacion = $_POST["idHabitacion"];
	$idHabitacion -> ajaxTraerReserva();

}