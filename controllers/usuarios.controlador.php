<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorUsuarios{

	/*=============================================
				 Registro de Usuario          
	 =============================================*/

	 public function ctrRegistroUsuario() {
		 if(isset($_POST["registroNombre"])) {

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])){

					$encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$encriptarEmail = md5($_POST["registroEmail"]);

					$tabla = "usuarios";

					$datos = array( "nombre" => $_POST["registroNombre"],
								"password" => $encriptarPassword,
								"email"=> $_POST["registroEmail"],
								"foto" => "",
								"modo" => "directo",
								"verificacion" => 0,
								"email_encriptado" => $encriptarEmail);

					$respuesta = ModelUsuarios::mdlRegistroUsuario($tabla, $datos);

					if($respuesta == "ok") {

					/*=============================================
					VERIFICACIÓN CORREO ELECTRÓNICO
					=============================================*/

					date_default_timezone_set("America/Costa_Rica");

					$ruta = ControladorRuta::ctrRuta();

					$mail = new PHPMailer;

					$mail->CharSet = 'UTF-8';

					$mail->isMail();

					$mail->setFrom('maikolsoro.z1998@gmail.com', 'Maikol Soro');

					$mail->addReplyTo('maikolsoro.z1998@gmail.com', 'Maikol Soro');

					$mail->Subject = "Por favor verifique su dirección de correo electrónico";

					$mail->addAddress($_POST["registroEmail"]);

					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

							<center>
								
							<img style="padding:20px; width:10%" src="https://maikolsoro.com/tienda/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
								
								<center>

									<img style="padding:20px; width:15%" src="https://maikolsoro.com/tienda/icon-email.png">

									<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>

									<a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
										
										<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>


								</center>


							</div>

						</div>');

					$envio = $mail->Send();

					if(!$envio){

						echo'<script>

							swal({
									type:"error",
								  	title: "¡ERROR!",
								  	text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

					}else{


						echo'<script>

							swal({
									type:"success",
								  	title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								  	text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

					}

				}

			}else{

				echo'<script>

					swal({
							type:"error",
						  	title: "¡CORREGIR!",
						  	text: "¡No se permiten caracteres especiales!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';


			}
		
	 	}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuario($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/
	static public function ctrActualizarUsuario($id, $item, $valor){

		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	INGRESO DE USUARIO DIRECTO
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["ingresoEmail"])){

			 if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

    			$encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

    			$tabla = "usuarios";
    			$item = "email";
    			$valor = $_POST["ingresoEmail"];

    			$respuesta = ModelUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

    			if($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword){

    				if($respuesta["verificacion"] == 0){

    						echo'<script>

								swal({
										type:"error",
									  	title: "¡ERROR!",
									  	text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
									  	showConfirmButton: true,
										confirmButtonText: "Cerrar"
									  
								}).then(function(result){

										if(result.value){   
										    history.back();
										  } 
								});

							</script>';

							return;

    				}else{

    					$_SESSION["validarSesion"] = "ok";
    					$_SESSION["id"] = $respuesta["id_u"];
    					$_SESSION["nombre"] = $respuesta["nombre"];
    					$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["modo"] = $respuesta["modo"];	

    					$ruta = ControladorRuta::ctrRuta();

						echo '<script>
					
							window.location = "'.$ruta.'perfil";				

						</script>';

    				}


    			}else{

				echo'<script>

					swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El email o contraseña no coinciden!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

			   }

			}else{

				echo'<script>

					swal({
							type:"error",
						  	title: "¡CORREGIR!",
						  	text: "¡No se permiten caracteres especiales!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';
			}

		}

	}
}
