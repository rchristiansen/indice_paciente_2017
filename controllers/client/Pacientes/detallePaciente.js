function evitaCollapse(inputHijo, colapsa){
	var id = $(inputHijo).parents(".collapse").attr("id");
	$("#"+id).off().on('hide.bs.collapse', function (e) {
		if(typeof colapsa ==='undefined')
			e.preventDefault();
	});
}
$(document).ready(function(){
	alert("aca");
	var extrajeroTrue   = Boolean(parseInt($("#frm_checkExtranjero").val()));	

	/***************EVENTOS DE INFORMACIÓN PACIENTE**************/
	// sumoSelect(".sumoComuna");
	// sumoSelect(".sumoAtencion");
	// sumoSelect(".sumoNacionalidad");
	// sumoSelect(".sumoPrevision");
	// sumoSelect(".sumoConvenio");
	// sumoSelect(".sumoComunaLaboral");
	if($("#PacienteFallecido").val()!="S"){
		calendario("#datePickerREC");
	}
	validar("#frm_rut_pac"               ,"rut");
	validar("#frm_nroDocumento"          ,"numero");
	validar("#frm_nroFicha"              ,"numero");
	validar("#frm_nombres"               ,"letras");
	validar("#frm_AP"                    ,"letras");
	validar("#frm_AM"                    ,"letras");
	validar("#frm_direccion"             ,"letras_numeros");
	validar("#datePickerREC"             ,"fecha");
	validar("#frm_telefonoFijo"          ,"numero");
	validar("#frm_telefonoCelular"       ,"numero");
	validar("#frm_telefonoAvis"          ,"numero");
	validar("#frm_telefonoCelularFijo"   ,"numero");

	/***************EVENTOS DE INFORMACIÓN LABORAL**************/
	validar("#frm_ocupacionLaboral"      ,"letras");
	validar("#frm_lugarTrabajo"          ,"letras");
	validar("#frm_direccion_laboral"     ,"letras_numeros");
	validar("#frm_telefono_laboral"      ,"numero");

	/***************EVENTOS DE DATOS DEL PADRE******************/
	validar("#frm_NombresPadre"          ,"letras");
	validar("#frm_AP_Padre"              ,"letras");
	validar("#frm_AM_Padre"              ,"letras");

	/***************EVENTOS DE DATOS DE LA MADRE****************/
	validar("#frm_NombresMadre"          ,"letras");
	validar("#frm_AP_Madre"              ,"letras");
	validar("#frm_AM_Madre"              ,"letras");

	/***************EVENTOS DE DATOS DE OTRO CONTACTO***********/
	validar("#frm_nombres_otroContacto"  ,"letras");
	validar("#frm_AP_otroContacto"       ,"letras");
	validar("#frm_AM_otroContacto"       ,"letras");
	validar("#frm_telefono_otroContacto" ,"numero");

	if(extrajeroTrue==false){
	  // alert()
      // $("#frm_extranjero").click();
      if( $("#frm_extranjero").is(":checked") ) {
			 $("#divDocumento").show();
			 $("#divNroDocumento").show();
			 $("#divRut").hide();
			 $("#frm_rut_pac").val("");      //input
		}else{
			 $("#divRut").show();
			 $("#divNroDocumento").hide();
			 $("#frm_nroDocumento").val(""); //input
			 $("#divDocumento").hide();
			 $("#frm_documento").val("");    //input
		}
   	}

	$("#frm_rut_pac").Rut({
		on_error: function(){
			// $.validity.start();
			// $('#frm_rut_pac').match('date',"Ingrese un rut valido");
			// result.valid=false;
			// var result = $.validity.end();
			// return false;
		},
		on_success: function(){
			// $.validity.start();
		},
		format_on: 'keyup'
	});

	var correoOK=0;
	$('#frm_email').blur(function(){
		var email = $(this).val();
		if(validarEmail(email)!= true && email!=""){
			$.validity.start();
			$('#frm_email').assert(false,'Ingrese un Correo valido');
			correoOK=1;
			evitaCollapse($(this));
		}else{
			$.validity.start();
			correoOK=0;
			evitaCollapse($(this), true);
		}
	});

	$("#frm_extranjero").click(function(){
		if( $("#frm_extranjero").is(":checked") ) {
			 $("#divDocumento").show();
			 $("#divNroDocumento").show();
			 $("#divRut").hide();
			 $("#frm_rut_pac").val("");      //input
		}else{
			 $("#divRut").show();
			 $("#divNroDocumento").hide();
			 $("#frm_nroDocumento").val(""); //input
			 $("#divDocumento").hide();
			 $("#frm_documento").val("");    //input
		}
	});

	if($("#PacienteFallecido").val()!="S"){
		$("#frm_Naciemito").change(function(){		
			// function CalcularEdad(birthday) {
			// 	var birthday_arr = birthday.split("/");
			// 	var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
			// 	var ageDifMs = Date.now() - birthday_date.getTime();
			// 	var ageDate = new Date(ageDifMs);
			// 	return Math.abs(ageDate.getUTCFullYear() - 1970);
			// }
			// var age = CalcularEdad($("#frm_Naciemito").val());
			// if(age == 1){
			// 	document.getElementById('labelEdad').innerHTML = age+' Año';
			// }else{
			// 	document.getElementById('labelEdad').innerHTML = age+' Años';
			// }
			var fechaNac;
			fechaNac = $("#frm_Naciemito").val();		
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','fechaNac='+fechaNac+'&accion=calcularFechaPaciente', 'POST', 'JSON', 1);				
			switch(response.status){
		     			case "success":  document.getElementById('labelEdad').innerHTML = response.id;
		     			break;
		     			case   "error":  document.getElementById('labelEdad').innerHTML = "error";  
		     			break;
		     			default:         document.getElementById('labelEdad').innerHTML = "error2";
		     			break;
		     		}
   			//alert(fechaNac);

		});
	}

	$("#btnVolver").click(function(){
      view("#contenidoPaciente");
      $.validity.start();
	});
	

	$("#btnFallecido").click(function(){
      	var id = parseInt($("#FOLIO").text()); //capturando el id
      	var regitrarPacienteFallecido = function(){ //FUNCION 1
      		var funcion = function miFuncion(){     //FUNCION 2	      		
      			camposDisable();
      			$.validity.start();
      			$("#frm_reporta").require('Debe Seleccionar una Opción');
      			$("#frm_fechaDefuncion").require('Debe Ingresar una Fecha de Defunción');
      			$("#frm_notificacion").require('Debe Ingresar una Fecha de Caducidad');

      			result = $.validity.end();
      			if(result.valid==false){
      				return false;
      			}

	      		var regPacFallecido = function(response){	//FUNCION 3		    		
			    		$('#indicePaFallecidoEstado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
			    		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+id,'#contenidoPaciente','', true);
			    	}//FIN FUNCION 3
			    	ajaxRequest('/indice_paciente_2017/controllers/server/PacienteFallecido/main_controller.php',$("#frm_indicePacienteFallecido").serialize()+'&accion=pacienteFallecido', 'POST', 'JSON', 1,'Registrando Paciente Como Fallecido ...', regPacFallecido);
			    }//FIN FUNCION 2	 
			    modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a dar por Fallecido al Paciente, <b>¿Desea continuar?</b>", funcion); 
			} //FIN FUNCION 1

			var botones = [
			{ id: 'btnGuardar', value: '<i class="fa fa-save" aria-hidden="true"></i> Guardar Paciente Fallecido', function: regitrarPacienteFallecido, class: 'btn btn-primary' }
			]
			modalFormulario('Paciente Fallecido','/indice_paciente_2017/views/modules/PacienteFallecido/PacienteEstado.php','id='+id,'#indicePaFallecidoEstado','50%','74%',botones);
		});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
		$('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
        	$('.tooltip').addClass('animated shake'); // se determina el tipo de animación ejemplo "shake"
    	})
	})

	// $(".errores").fadeOut();
	// $("#direccionError").fadeOut("fast");

    $("#cruz").click(function(){
    	var id = parseInt($("#FOLIO").text()); //capturando el id
    	modalDetalle('Paciente Fallecido','/indice_paciente_2017/views/modules/PacienteFallecido/Pacientefallecido.php','id='+id,'#indicePaFallecido','50%','55%');
    	$('.tooltip').tooltip('hide') // sacar tooltip 
    });

    


	$("#btnActualizarDatos").click(function(){
		$.validity.start();
		if($("#frm_nombres").val().length < 4 && $("#frm_nombres").val()!=""){
				alert("2")
				$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_nombres").val()=="" || $("#frm_AP").val()=="" || $("#frm_AM").val()=="" ){
				alert("vvvv")
				$("#frm_nombres").require('Debe Ingresar Nombres');
				$("#frm_AP").require('Debe Ingresar Apellido Paterno');
				$("#frm_AM").require('Debe Ingresar Apellido Materno');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_NombresPadre").val().length < 4 && $("#frm_NombresPadre").val()!=""){
				$('#frm_NombresPadre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AP_Padre").val().length < 4 && $("#frm_AP_Padre").val()!=""){
				$('#frm_AP_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AM_Padre").val().length < 4 && $("#frm_AM_Padre").val()!=""){
				$('#frm_AM_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_NombresMadre").val().length < 4 && $("#frm_NombresMadre").val()!=""){
				$('#frm_NombresMadre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AP_Madre").val().length < 4 && $("#frm_AP_Madre").val()!=""){
				$('#frm_AP_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AM_Madre").val().length < 4 && $("#frm_AM_Madre").val()!=""){
				$('#frm_AM_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_nombres_otroContacto").val().length < 4 && $("#frm_nombres_otroContacto").val()!=""){
				$('#frm_nombres_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AP_otroContacto").val().length < 4 && $("#frm_AP_otroContacto").val()!=""){
				$('#frm_AP_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else{
				if($("#frm_AM_otroContacto").val().length < 4 && $("#frm_AM_otroContacto").val()!=""){
					$('#frm_AM_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
					$('html, body').animate({
						scrollTop: $("#contenedor3").offset().top
					}, 2000);
					$.validity.end();
					return false;
				}
			}

			

		// var  actualizarPaciente = function(){
			var actualizar = function(response){
				numeroDocumento     = $("#frm_rut_pac").val();
				numeroDocumento     = $.Rut.quitarFormato(numeroDocumento);         // rut junto al digito Verificador
				numeroDocumento     = numeroDocumento.substring(0, numeroDocumento.length-1); //Saca el digito Verificador

				var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&accion=actualizarPaciente'+"&rut="+numeroDocumento, 'POST', 'JSON', 1);
				switch(response.status){
					case "success": modalMensaje("Paciente Actualizado", "Paciente Actualizado exitosamente.<br>Se generó # Actualización del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_actualizado", 650, 300);
					break;
					case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se actualizo el paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_actualizado", 400, 300);
					break;
					default:        modalMensaje("Error generico", response, "error_generico_paciente_actualizado", 400, 300);
					break;
				}
				view("#contenidoPaciente");
			}
			// ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&accion=actualizarPaciente', 'POST', 'JSON', 1);
			// view("#contenidoPaciente");
		// }
		modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a Actualizar Paciente, <b>¿Desea continuar?</b>", actualizar);
	});

	$("#btnNuevoPaciente").click(function(){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/agregarPaciente.php','','#contenidoPaciente','', true);
	});

	$("#btnBuscar").click(function(){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php','','#contenidoPaciente','', true);
	});

});

function camposDisable(){
	$("#frm_hora").prop('disabled', false);
}