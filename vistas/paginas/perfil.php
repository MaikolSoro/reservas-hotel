<?php
if(isset($_SESSION["validarSeccion"])) {
	if($_SESSION["validarSeccion"] == "ok") {
		
		include "modulos/banner-interior.php";
		include "modulos/info-perfil.php";
	}
} else {

	echo '<script> window.location="'.$ruta.'"</script';
}
