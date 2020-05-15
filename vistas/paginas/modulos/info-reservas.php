<?php
/**
*
* Si viene una variable post id_habitacion , entonces lo dejo pasar a la pagina reservas
*
*/
if(isset($_POST["id-habitacion"])){

	$valor = $_POST["id-habitacion"];
	$reservas = ControladorReservas::ctrMostrarReservas($valor);
	$planes = ControladorPlanes::ctrMostrarPlanes();
	
	date_default_timezone_set("America/Costa_Rica");


	$hoy = getdate();

	if($hoy["mon"] == 12 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 1 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15 ||
	   $hoy["mon"] == 6 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 7 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15){

		$precioContinental = $reservas[$indice]["continental_alta"];
		$precioAmericano = $reservas[$indice]["americano_alta"];
		$precioRomantico = $reservas[$indice]["americano_alta"] + $planes[0]["precio_alta"];
		$precioLunaDeMiel = $reservas[$indice]["americano_alta"] + $planes[1]["precio_alta"];
		$precioAventura = $reservas[$indice]["americano_alta"] + $planes[2]["precio_alta"];
		$precioSPA = $reservas[$indice]["americano_alta"] + $planes[3]["precio_alta"];

	}else{

		$precioContinental = $reservas[$indice]["continental_baja"];
		$precioAmericano = $reservas[$indice]["americano_baja"];
		$precioRomantico = $reservas[$indice]["americano_baja"] + $planes[0]["precio_baja"];
		$precioLunaDeMiel = $reservas[$indice]["americano_baja"] + $planes[1]["precio_baja"];
		$precioAventura = $reservas[$indice]["americano_baja"] + $planes[2]["precio_baja"];
		$precioSPA = $reservas[$indice]["americano_baja"] + $planes[3]["precio_baja"];

	}

} else {
	//Sino viene una variable post id_habitacion  no le dejo pasar lo mando a la pagina de inicio
	echo '<script> window.location="'.$ruta.'"</script>';
}

?>

<!--=====================================
INFO RESERVAS
======================================-->

<div class="infoReservas container-fluid bg-white p-0 pb-5" idHabitacion="<?php echo $_POST["id-habitacion"]; ?>" 
		fechaIngreso="<?php echo $_POST["fecha-ingreso"]; ?>" fechaSalida="<?php echo $_POST["fecha-salida"]; ?>">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">
					
					<a href="<?php echo $ruta; ?>habitaciones" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="float-left text-white p-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

						<br>
						<a href="<?php echo $ruta; ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="bg-white p-4 calendarioReservas">

				<!-- Filtro -->
				<?php if (!$reservas): ?>

					<h1 class="pb-5 float-left">¡Está Disponible!</h1>

				<?php else: ?>

					<div class="infoDisponibilidad"></div>

				<?php endif ?>


					<div class="float-right pb-3">
							
						<ul>
							<li>
								<i class="fas fa-square-full" style="color:#847059"></i> No disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#eee"></i> Disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#FFCC29"></i> Tu reserva
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

					<form action="<?php echo $ruta; ?>reservas" method="post">

						<input type ="hidden" name="id_habitacion" value="<?php echo $_POST["id-habitacion"]; ?>">	
						
						<div class="container mb-3">

							<div class="row py-2" style="background:#509CC3">

								<div class="col-6 col-md-3 input-group pr-1">
								
									<input type="text" class="form-control datepicker entrada" autocomplete="off" placeholder="Entrada" name="fecha-ingreso" value="<?php echo $_POST["fecha-ingreso"]; ?>" required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

								<div class="col-6 col-md-3 input-group pl-1">
								
									<input type="text" class="form-control datepicker salida" autocomplete="off" placeholder="Salida" name="fecha-salida"  value="<?php echo $_POST["fecha-salida"]; ?>" required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

								<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
									
									<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:green">	

								</div>

							</div>

						</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerReservas" style="display:none">

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong class="codigoReserva"></strong></h2>

				<div class="form-group">
				  <label>Ingreso 3:00 pm:</label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-ingreso"];?>" readonly>
				</div>

				<div class="form-group">
				  <label>Salida 1:00 pm:</label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-salida"];?>"  readonly>
				</div>

				<div class="form-group">
				  <label>Habitación:</label>
				  <input type="text" class="form-control" value="Habitación <?php echo $reservas[0]["tipo"]." ".$reservas[0]["estilo"]; ?>" readonly>

				  <img src="img/oriental.png" class="img-fluid">

				</div>

				<div class="form-group">
				  <label>Plan:</label>
				  <select class="form-control">
				  	
				  	<option value="<?php echo $precioContinental;?>,Plan Continental">Plan Continental $<?php echo number_format($precioContinental); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioAmericano;?>,Plan Americano">Plan Americano $<?php echo number_format($precioAmericano); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioRomantico;?>,Plan Romantico">Plan Romántico $<?php echo number_format($precioRomantico); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioLunaDeMiel;?>,Plan Luna de Miel">Plan Luna de Miel $<?php echo number_format($precioLunaDeMiel); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioAventura;?>,Plan Aventura">Plan Aventura $<?php echo number_format($precioAventura); ?> 1 día 1 noche</option>
					<option value="<?php echo $precioSPA;?>,Plan SPA">Plan SPA $<?php echo number_format($precioSPA); ?> 1 día 1 noche</option>

				  </select>
				</div>
				
				<div class="form-group">
				  <label>Personas:</label>
				  <select class="form-control">
				  	
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>

				  </select>
				</div>

				<div class="row py-4">

					<div class="col-12 col-lg-6 col-xl-7 text-center text-lg-left">
						
						<h1>$300 USD</h1>

					</div>
					
					<div class="col-12 col-lg-6 col-xl-5">
				
						<a href="<?php echo $ruta; ?>perfil">
							<button class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
						</a>

					</div>
			
				</div>

			</div>

		</div>

	</div>

</div>