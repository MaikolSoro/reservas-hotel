<?php

require_once "controllers/plantilla.controlador.php";   
require_once "controllers/ruta.controlador.php";

require_once "controllers/banner.controlador.php";
require_once "models/banner.models.php";

require_once "controllers/planes.controlador.php";
require_once "models/planes.models.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();