<?php

/*=============================================
=            Section Impotar el controlador y el model de plantilla           =
=============================================*/
                                              
require_once "controllers/plantilla.controlador.php";   
require_once "controllers/ruta.controlador.php";
                                              
                                              
/*=====  End of Section Impotar el controlador y el model de plantilla  ======*/



/*=============================================
=            Section Se importa el controlador y el model del Banner           =
=============================================*/
                                              
require_once "controllers/banner.controlador.php";
require_once "models/banner.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model del Banner  ======*/




/*=============================================
=            Section Se importa el controlador y el model de los planes           =
=============================================*/
                                              
require_once "controllers/planes.controlador.php";
require_once "models/planes.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model de los planes  ======*/



/*=============================================
=            Section Se impota el controlador y el model de las categorias por habitación           =
=============================================*/
                                              
require_once "controllers/categorias.controlador.php";
require_once "models/categorias.models.php";
                                              
                                              
/*=====  End of Section Se impota el controlador y el model de las categorias por habitación  ======*/




/*=============================================
=            Section Se importa el controlador y el model del recorrido del pueblo           =
=============================================*/
                                              
require_once "controllers/recorrido.controlador.php";
require_once "models/recorrido.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model del recorrido del pueblo  ======*/


/*=============================================
=            Section Se importa el controlador y el model del restaurante           =
=============================================*/
                                              
require_once "controllers/restaurante.controlador.php";
require_once "models/restaurante.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model del restaurante  ======*/


/*=============================================
=            Section Se importa el controlador y el model las habitaciones          =
=============================================*/
                                              
require_once "controllers/habitaciones.controlador.php";
require_once "models/habitaciones.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model de las habitaciones ======*/



/*=============================================
=            Section Se importa el controlador y el model las reservas          =
=============================================*/
                                              
require_once "controllers/reservas.controlador.php";
require_once "models/reservas.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model de las reservas ======*/


/*=============================================
=            Section Se importa el controlador y el model los usuarios          =
=============================================*/
                                              
require_once "controllers/usuarios.controlador.php";
require_once "models/usuarios.models.php";
                                              
                                              
/*=====  End of Section Se importa el controlador y el model de los usuarios======*/

require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();