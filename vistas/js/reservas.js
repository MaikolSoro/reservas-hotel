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

  if(ruta != "Tipo de habitación"){
    
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
            defaultDate:fechaIngreso,
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
      }
  
    }
  });
}

