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

	/*=============================================
	Traer Reserva a través de Código
	=============================================*/

	public $codigoReserva;

	public function ajaxTraerCodigoReserva(){

		$valor = $this->codigoReserva;

		$respuesta = ControladorReservas::ctrMostrarCodigoReserva($valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	Traer Reserva Habitaciones
	=============================================*/

	public $idHabitaciones;
	public $fechaIngreso;
	public $fechaSalida;

	public function ajaxTraerReservas(){

		$valor = $this->idHabitaciones;
		$fechaIngreso = $this->fechaIngreso;
		$fechaSalida = $this->fechaSalida;

		$respuesta = ControladorReservas::ctrMostrarReservas($valor);

		if($respuesta != 0){

			foreach ($respuesta as $key => $value) {

				if($fechaIngreso == $value["fecha_ingreso"] ||
				   $fechaIngreso > $value["fecha_ingreso"] && $fechaIngreso < $value["fecha_salida"] ||
				   $fechaIngreso < $value["fecha_ingreso"] && $fechaSalida > $value["fecha_ingreso"]){

					echo json_encode($value["id_h"]);

					return;

				}
				
			}
		}

		echo json_encode("");



		// echo json_encode($respuesta);

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

/*=============================================
Traer Reserva Codigo
=============================================*/

if(isset($_POST["codigoReserva"])){

	$codigoReserva = new AjaxReservas();
	$codigoReserva -> codigoReserva = $_POST["codigoReserva"];
	$codigoReserva -> ajaxTraerCodigoReserva();

}



/*=============================================
Traer Reservas Habitaciones
=============================================*/

if(isset($_POST["idHabitaciones"])){

	$idHabitaciones = new AjaxReservas();
	$idHabitaciones -> idHabitaciones = $_POST["idHabitaciones"];
	$idHabitaciones -> fechaIngreso = $_POST["fechaIngreso"];
	$idHabitaciones -> fechaSalida = $_POST["fechaSalida"];
	$idHabitaciones -> ajaxTraerReservas();

}