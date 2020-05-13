<?php
require_once "../controllers/habitaciones.controlador.php";
require_once "../models/habitaciones.models.php";

class AjaxHabitaciones{

    public $ruta;

    public function ajaxTraerHabitacion() {

        $valor = $this-> ruta;
        
        $respuesta = ControladorHabitaciones:: ctrMostrarHabitaciones($valor);

        echo json_encode($respuesta);
        
    }

}

    if(isset($_POST["ruta"])){

        $ruta = new AjaxHabitaciones();
        $ruta -> ruta = $_POST["ruta"];
        $ruta -> ajaxTraerHabitacion();

    }