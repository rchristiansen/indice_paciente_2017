$(document).ready(function(){
	//ESTE DEBE SER EL DETALLE
	validar("#nombrePacienteHjnc"  	,"letras");
	validar("#paternoPacienteHjnc" 	,"letras");
	validar("#maternoPacienteHjnc" 	,"letras");	
	validar("#datePickerREC"        ,"fecha");
	if($("#PacienteFallecido").val()!="S"){
		calendario("#datePickerREC");
	}
	
	
	//$('#datePickerREC').datepicker();

	$("#btnVolver").click(function(){
		view("#contenido");
		$.validity.start();
	});

	$("#datosFonasa").click(function(){  //Sincronizar con Fonasa
		alert("Sincronizar con Fonasa")
	});

	$("#datosPaciente").click(function(){//Actualizar Paciente Datos HJNC
		var actualizar = function(response){
			//var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=actualizarPacienteFonasa'+"&nombre="+$("#nombrePacienteHjnc").val()+"&AP="+$("#paternoPacienteHjnc").val()+"&AM="+$("#maternoPacienteHjnc").val()+"&fechaNac="+$("#nacimientoHjnc").val()+"&prevision="+$("#prevision option:selected").val()+"&sexo="+$("#sexoHjnc option:selected").val(), 'POST', 'JSON', 1);
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&accion=actualizarPacienteFonasa', 'POST', 'JSON', 1);
			switch(response.status){
				case "success": modalMensaje("Paciente Actualizado", "Paciente Actualizado exitosamente.<br>Se generó # Actualización del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_actualizado", 650, 300);
				break;
				case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se actualizo el paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_actualizado", 400, 300);
				break;
				default:        modalMensaje("Error generico", response, "error_generico_paciente_actualizado", 400, 300);
				break;
			}
			view("#contenido");
		}
		modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a Actualizar Paciente, <b>¿Desea continuar?</b>", actualizar);
	});

	$("#volver1").click(function(){      //Volver al detalle del Paciente
		var id = parseInt($("#FOLIO").text()); //caputandp el id
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+id,'#contenido','', true);
	});	
});