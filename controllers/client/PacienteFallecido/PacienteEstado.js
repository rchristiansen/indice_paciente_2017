$(document).ready(function(){
	
  validar("#datePickerREC1"             ,"fecha");
	calendario("#datePickerREC1");
  validar("#datePickerREC2"             ,"fecha");	
	calendario2("#datePickerREC2");
  validar("#frm_observacion"     ,"letras_numeros");

  $('#datePickerREC1').on('changeDate', function(selected){
    document.getElementById("frm_notificacion").disabled = false;
    $("#clearFechas").show();
  });

  $('#datePickerREC2').on('changeDate', function(selected){
    document.getElementById("frm_fechaDefuncion").disabled = true;
    document.getElementById("frm_notificacion").disabled   = true;
  });

  $("#clearFechas").click(function(){
    $("#clearFechas").hide();
    document.getElementById("frm_fechaDefuncion").value = "";
    document.getElementById("frm_fechaDefuncion").disabled = false;
    document.getElementById("frm_notificacion").value = "";
    document.getElementById("frm_notificacion").disabled   = false;
  });


    // $('#datePickerREC1').datepicker({ //desde hasta datepicker
    //   todayBtn: "linked",
    //   todayHighlight: true,
    //   autoclose: true
    // }).on('changeDate', function(e){
    //   $('#datePickerREC2').datepicker({
    //     autoclose: true
    //   }).datepicker('setStartDate', e.date);
    //   $('#datePickerREC2').focus();
    // });

    // $('#datePickerREC2').datepicker({ //desde hasta datepicker
    //   todayBtn: "linked",
    //   todayHighlight: true,
    //   autoclose: true
    // }).on('changeDate', function(e){
    //   $('#datePickerREC1').datepicker({
    //     autoclose: true
    //   }).datepicker('setEndDate', e.date);
    // });

 //    $("#btnRegistroRip").click(function(){
 //    	$.validity.start();
 //    	$("#frm_reporta").require('Debe Seleccionar una Opción');
 //    	$("#frm_fechaDefuncion").require('Debe Ingresar una Fecha de Defunción');
 //    	$("#frm_notificacion").require('Debe Ingresar una Fecha de Caducidad');

 //    	result = $.validity.end();
 //    	if(result.valid==false){
 //    		return false;
 //    	}

 //    	var regPacFallecido = function(response){				

 //    		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&accion=pacienteFallecido', 'POST', 'JSON', 1);
 //    		// switch(response.status){
 //    		// 	case "success": modalMensaje("Paciente Actualizado", "Paciente Actualizado exitosamente.<br>Se generó # Actualización del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_actualizado", 650, 300);
 //    		// 	break;
 //    		// 	case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se actualizo el paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_actualizado", 400, 300);
 //    		// 	break;
 //    		// 	default:        modalMensaje("Error generico", response, "error_generico_paciente_actualizado", 400, 300);
 //    		// 	break;
 //    		// }
 //    		view("#contenidoPaciente");
 //    	}
 //    	modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a dar por muerto al Paciente, <b>¿Desea continuar?</b>", regPacFallecido);    	
    	
	// });



});