<?php

Class ControladorUsuarios{

	/*=============================================
				 Registro de Usuario          
	 =============================================*/

	 public function ctrRegistroUsuario() {
		 if(isset($_POST["registroNombre"])) {

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])){


					$encriptarEmail = md5($_POST["registroEmail"]);

					$tabla = "usuarios";

					$datos = array( "nombre" => $_POST["registroNombre"],
								"password" => $_POST["registroPassword"],
								"email"=> $_POST["registroEmail"],
								"foto" => "",
								"modo" => "directo",
								"verificacion" => 0,
								"email_encriptado" => $encriptarEmail);

					$respuesta = ModelUsuarios::mdlRegistroUsuario($tabla, $datos);

					if($respuesta == "ok") {

						echo "Usuario registrado con éxito";
					}

			}
	 	}
	}
}
