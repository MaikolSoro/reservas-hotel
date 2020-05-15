/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
	format: 'yyyy-mm-dd',
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){

  $('.datepicker.salida').attr("readonly", false);
  
	var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'yyyy-mm-dd'
	});

})

/*=============================================
SELECTS ANIDADOS
=============================================*/
$(".selectTipoHabitacion").change(function(){

  var ruta = $(this).val();

  if(ruta != ""){
    
    // Para que este vacio cuando cambie el tipo de habitacion
    $(".selectTemaHabitacion").html("");
  } else {
    
    $(".selectTemaHabitacion").html('<option>Temática de habitación</option>')
  }

  var datos = new FormData();
  datos.append("ruta", ruta);

  $.ajax({
     url: urlPrincipal+"ajax/habitaciones.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType:"json",
     success:function(respuesta){

      for(var i = 0; i < respuesta.length; i++){
        $(".selectTemaHabitacion").append('<option value="'+respuesta[i]["id_h"]+'">'+respuesta[i]["estilo"]+'</option>')
      }
     }
  })
})


/*=============================================
CALENDARIO
=============================================*/

if($(".infoReservas").html() != undefined){

  var idHabitacion = $(".infoReservas").attr("idHabitacion");
  // console.log("idHabitacion", idHabitacion);
  var fechaIngreso = $(".infoReservas").attr("fechaIngreso");
  var fechaSalida = $(".infoReservas").attr("fechaSalida");
  var dias = $(".infoReservas").attr("dias");

  var totalEventos = [];
  var opcion1 = [];
  var opcion2 = [];
  var opcion3 = [];
  var validarDisponibilidad = false;

  var datos = new FormData();
  datos.append("idHabitacion", idHabitacion);

    $.ajax({

      url:urlPrincipal+"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        if(respuesta.length == 0){

          $('#calendar').fullCalendar({
            // defaultDate:fechaIngreso,
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: [
              {
                start: fechaIngreso,
                end: fechaSalida,
                rendering: 'background',
                color: '#FFCC29'
              }
            ]

          });
         colDerReservas();

      } else {

        for(var i = 0; i < respuesta.length; i++) {

            /* VALIDAR CRUCE DE FECHAS OPCIÓN 1 */         

            if(fechaIngreso == respuesta[i]["fecha_ingreso"]){

              opcion1[i] = false;            

            }else{

              opcion1[i] = true;

            }
             /* VALIDAR CRUCE DE FECHAS OPCIÓN 2 */         

             if(fechaIngreso > respuesta[i]["fecha_ingreso"] && fechaIngreso < respuesta[i]["fecha_salida"]){

              opcion2[i] = false;            

            }else{

              opcion2[i] = true;

            }

             /* VALIDAR CRUCE DE FECHAS OPCIÓN 3 */         

            if(fechaIngreso < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){

              opcion3[i] = false;            

            }else{

              opcion3[i] = true;

            }

             /* VALIDAR DISPONIBILIDAD */    

             if(opcion1[i] == false || opcion2[i] == false || opcion3[i] == false){

              validarDisponibilidad = false;
            
            }else{

              validarDisponibilidad = true;
             
            }


         // console.log("validarDisponibilidad", validarDisponibilidad);

         if(!validarDisponibilidad){

          totalEventos.push(
            {
              "start": respuesta[i]["fecha_ingreso"],
              "end": respuesta[i]["fecha_salida"],
              "rendering": 'background',
              "color": '#847059'
            }
          )

           $(".infoDisponibilidad").html('<h5 class="pb-5 float-left">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>');
            
           break;

        }else{

        totalEventos.push(
          {
            "start": respuesta[i]["fecha_ingreso"],
            "end": respuesta[i]["fecha_salida"],
            "rendering": 'background',
            "color": '#847059'
          }

        )

        $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible!</h1>'); 
        // $(".colDerReservas").show();
         colDerReservas();
      }        

    }
    // FIN CICLO FOR
      if(validarDisponibilidad){

        totalEventos.push(
          {
              "start": fechaIngreso,
              "end": fechaSalida,
              "rendering": 'background',
              "color": '#FFCC29'
            }
        )

      }

      $('#calendar').fullCalendar({
        defaultDate:fechaIngreso,
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events:totalEventos

      });

    }

  }

  })

}

/*=============================================
CÓDIGO ALEATORIO
=============================================*/

var chars ="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

function codigoAleatorio(chars, length){

  codigo = "";

  for(var i = 0; i < length; i++){

    rand = Math.floor(Math.random()*chars.length);
    codigo += chars.substr(rand, 1);
  
  }

  return codigo;

}


/*=============================================
FUNCIÓN COL.DERECHA RESERVAS
=============================================*/

function colDerReservas(){

  $(".colDerReservas").show(); 

  var codigoReserva = codigoAleatorio(chars, 9);
  
  var datos = new FormData();
  datos.append("codigoReserva", codigoReserva);

  $.ajax({

   url:urlPrincipal+"ajax/reservas.ajax.php",
   method: "POST",
   data: datos,
   cache: false,
   contentType: false,
   processData: false,
   dataType:"json",
   success:function(respuesta){
    
      if(!respuesta){
        // no hay concidencia
        $(".codigoReserva").html(codigoReserva);

      }else{

         $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));

      }

   }

 })

}
