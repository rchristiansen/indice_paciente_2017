function evitaCollapse(inputHijo, colapsa){
	var id = $(inputHijo).parents(".collapse").attr("id");
	$("#"+id).off().on('hide.bs.collapse', function (e) {
		if(typeof colapsa ==='undefined')
			e.preventDefault();
	});
}
$(document).ready(function(){
	var extrajeroTrue   = Boolean(parseInt($("#frm_checkExtranjero").val()));	

	obtenerValorCiudad($("#ciudad").val());
	obtenerValorComuna($("#comuna").val());

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

	validar("#frm_nombreCalleIndicePaciente"           ,"letras_numeros");
	validar("#frm_numeroDireccionIndicePaciente"       ,"letras_numeros");
	validar("#frm_otrosTelefonosIndicePaciente"        ,"letras_numeros");

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
	validar("#frm_telefonoFijoAvis" ,"numero");
	validar("#frm_telefonoCelularAvis" ,"numero");
	
	

	$("#btnVolver1").click(function(){		
		view("#contenidoPaciente");
		// ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php','','#contenido','', true);		
		$.validity.start();
	});	

	$("#verificarPrevision").click(function(){
		var id = parseInt($("#FOLIO").text()); //capturando el id
		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=calcularHoraDif', 'POST', 'JSON', 1);
		switch(response.fonasa){
			case "successPrevisionRegistrada":
				// alert("successPrevisionRegistrada");
				var funcion = function(response){ //FUNCION 2				
					switch(response.status){
						case "success":								
						modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&nombreFonasa=frm_nombres&ApellidoPaternoFonasa=frm_AP&ApellidoMaternoFonasa=frm_AM&direccionFonasa=frm_direccion&previsionFonasa=frm_prevision&sexoFonasa=frm_sexo&fechaNac=frm_Naciemito&calcularEdad=labelEdad','#pacienteFonasaCertificado','80%','auto','');
						break;

						case "noContetar":
							modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
						break;

						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}				
				}//FIN FUNCION 2			
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+id+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);
			break;

			case "successPrevisionRestringida":
				var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=sistemaExterno', 'POST', 'JSON', 1);
				var fecha  = response.datosPacientes.datos[0]['fechaSincronizacion'] ;
				var hora   = response.datosPacientes.datos[0]['act_fonasa_hrs'];
				modalMensaje2("Paciente Sincronizado", 'Este Paciente, fue Sincronizado el día de '+fecha+' a las '+hora+'</b>.', '', 550, 300, 'danger', 'remove');
			break;
		}

	});

	if(extrajeroTrue==false){
	  // alert()
      // $("#frm_extranjero").click();
      if( $("#frm_extranjero").is(":checked") ) {
			 $("#divDocumento").show();
			 $("#divNroDocumento").show();
			 $("#divRut").hide();
			 $("#frm_rut_pac").val();      //input
		}else{
			 $("#divRut").show();
			 $("#divNroDocumento").hide();
			 $("#frm_nroDocumento").val(""); //input
			 $("#divDocumento").hide();
			 $("#frm_documento").val();    //input
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

	//Cargar ciudades de acuerdo a region
	$('#frm_regionIndicePaciente').change(function(){
		if($('#frm_regionIndicePaciente').val() != "" && $('#frm_regionIndicePaciente').val() != "99"){
			
			$('#frm_ciudadIndicePaciente').prop("disabled", false);
		 	$("#divSeleccionCiudadesIndicePaciente").show("slow");
			var regId  = $('#frm_regionIndicePaciente option:selected').val();
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','regId='+regId+'&accion=cargarCiudades', 'POST', 'JSON', 1);
			$('#frm_ciudadIndicePaciente').empty();
			$('#frm_comunaIndicePaciente').empty();
			$("#divSeleccionComunasIndicePaciente").hide("slow");
			$('#frm_ciudadIndicePaciente').append('<option value="">Seleccione Ciudad</option>');
				for (var i=0; i<response.length; i++) {
					$('#frm_ciudadIndicePaciente').append('<option value="' + response[i].CIU_Id + '">' + response[i].CIU_Descripcion + '</option>');
				}
		}
		else{
			$('#frm_ciudadIndicePaciente').empty();
			$('#frm_regionIndicePaciente').val("99");
			$("#divSeleccionCiudadesIndicePaciente").hide("slow");
		}
	});

	//Cargar comunas de acuerdo a ciudad
	$('#frm_ciudadIndicePaciente').change(function(){
		if($('#frm_ciudadIndicePaciente').val() != "" && $('#frm_ciudadIndicePaciente').val() != "999"){
			$('#frm_comunaIndicePaciente').prop("disabled", false);
			$("#divSeleccionComunasIndicePaciente").show("slow");
			var ciuId  = $('#frm_ciudadIndicePaciente option:selected').val();
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','ciuId='+ciuId+'&accion=cargarComunas', 'POST', 'JSON', 1);
			$('#frm_comunaIndicePaciente').empty();
			$('#frm_comunaIndicePaciente').append('<option value="">Seleccione Comuna</option>');
				for (var i=0; i<response.length; i++) {
					$('#frm_comunaIndicePaciente').append('<option value="' + response[i].id + '">' + response[i].comuna + '</option>');
				}
		}
		else{
			$('#frm_ciudadIndicePaciente').empty();
			$('#frm_comunaIndicePaciente').empty();
			$('#frm_regionIndicePaciente').val("99");
			$("#divSeleccionCiudadesIndicePaciente").hide("slow");
			$("#divSeleccionComunasIndicePaciente").hide("slow");
		}
	});

	//Cambio en comuna
	$('#frm_comunaIndicePaciente').change(function(){
		if($('#frm_comunaIndicePaciente').val() == ""){
			$('#frm_ciudadIndicePaciente').empty();
			$('#frm_comunaIndicePaciente').empty();
			$('#frm_regionIndicePaciente').val("99");
			$("#divSeleccionCiudadesIndicePaciente").hide("slow");
			$("#divSeleccionComunasIndicePaciente").hide("slow");
		}
	});

	// var fechaCero;
	// fechaCero = $("#frm_Naciemito").val();
	// if(fechaCero == "0000-00-00"){
	// 	$("#frm_Naciemito").click(function(){
	// 		var hoy = new Date();
	// 		var dd = hoy.getDate();
	// 		var mm = hoy.getMonth()+1; //hoy es 0!
	// 		var yyyy = hoy.getFullYear();
			
	// 		if(dd<10) {
	// 			dd='0'+dd
	// 		} 

	// 		if(mm<10) {
	// 			mm='0'+mm
	// 		} 

	// 		hoy = dd+'/'+mm+'/'+yyyy;
	// 		$("#frm_Naciemito").val(hoy);	
	// 	});		
	// }

	if($("#PacienteFallecido").val()!="S"){
		$('#datePickerREC').on('changeDate', function(selected){		
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





	$("#btnFallecido").click(function(){
      	var id = parseInt($("#FOLIO").text()); //capturando el id
      	var regitrarPacienteFallecido = function(){ //FUNCION 1
      		var funcion = function miFuncion(){     //FUNCION 2	 
	      		var regPacFallecido = function(response){	//FUNCION 3		    		
			    		$('#indicePaFallecidoEstado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
			    		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+id,'#contenidoPaciente','', true);
			    	}//FIN FUNCION 3			    	
			    	ajaxRequest('/indice_paciente_2017/controllers/server/PacienteFallecido/main_controller.php',$("#frm_indicePacienteFallecido").serialize()+'&accion=pacienteFallecido', 'POST', 'JSON', 1,'Registrando Paciente Como Fallecido ...', regPacFallecido);
			    }//FIN FUNCION 2
			    camposDisable();
	      			$.validity.start();
	      			$("#frm_reporta").require('Debe Seleccionar una Opción');
	      			$("#frm_fechaDefuncion").require('Debe Ingresar una Fecha de Defunción');
	      			$("#frm_notificacion").require('Debe Ingresar una Fecha de Caducidad');

	      			result = $.validity.end();
	      			if(result.valid==false){
	      				return false;
	      			}	 
			    modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a dar por fallecido al paciente, <b>¿Desea continuar?</b>", funcion); 
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

    

    var numeroDocumento2      = $("#frm_nroDocumento").val();
    var numeroDocumento3      = $("#frm_rut_pac").val();
    //alert(numeroDocumento3)

	$("#btnActualizarDatos").click(function(){
		var id = parseInt($("#FOLIO").text()); //capturando el id
		$.validity.start();
		if($("#frm_nombres").val().length < 4 && $("#frm_nombres").val()!=""){
			// alert("2")
			$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 4 Caracteres');			
			$.validity.end();
			return false;
		}

		if($("#frm_AP").val().length < 4 && $("#frm_AP").val()!=""){
			// alert("3")
			$('#frm_AP').assert(false,'Debe Ingresar Mínimo 4 Caracteres');			
			$.validity.end();
			return false;
		}

		if($("#frm_AM").val().length < 4 && $("#frm_AM").val()!=""){
			// alert("3")
			$('#frm_AM').assert(false,'Debe Ingresar Mínimo 4 Caracteres');			
			$.validity.end();
			return false;
		}

		if($("#frm_nombres").val()=="" || $("#frm_AP").val()=="" || $("#frm_AM").val()=="" ){
			// alert("vvvv")
			$("#frm_nombres").require('Debe Ingresar Nombres');
			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
			$("#frm_AM").require('Debe Ingresar Apellido Materno');
			$.validity.end();
			return false;
		}

		var rutValido= $.Rut.validar($("#frm_rut_pac").val());
		var rut = $("#frm_rut_pac").val();
		if(rut == 0){
			// alert()
			console.log("pasar 0")
		}else{
			if(rutValido==false){
				$('#frm_rut_pac').match('date',"Ingrese un rut valido");
				$.validity.end();
				return false;
			}
		}

		if($("#frm_rut_pac").val()=="" ){
			$('#frm_rut_pac').assert(false,'No puede estar vacio o en 0 Nacional');
		}else{
			// if($("#frm_rut_pac").val()!="" && $("#frm_rut_pac").val()!="0" && $("#frm_nroDocumento").val()==""){
				if($("#frm_rut_pac").val()!="" && $("#frm_nroDocumento").val()==""){
				var rutValido= $.Rut.validar($("#frm_rut_pac").val());
				if(rutValido==true || $("#frm_rut_pac").val()==0 ){
				var numeroDocumentoprueba      = $("#frm_rut_pac").val();
				var numeroDocumento      = $("#frm_rut_pac").val();
				//alert(numeroDocumento)
				var numeroDocumento      = $.Rut.quitarFormato(numeroDocumento);         // rut junto al digito Verificador
				var numeroDocumento      = numeroDocumento.substring(0, numeroDocumento.length-1); //Saca el digito Verificador

				var tipo                 = "rut";
				var tipoDocumento        = $('#frm_documento option:selected').val();
				var mensaje              = "N° de Rut";
				var validarDocumento = function(response){
					result = $.validity.end();
					if(result.valid==false){
						return false;
					}
					if(response>0 && numeroDocumentoprueba != numeroDocumento3){
						$('#frm_rut_pac').assert(false,'Este Rut ya se encuentra Registrado');
						$('html, body').animate({
							scrollTop: $("#contenedor1").offset().top
						}, 2000);
						$.validity.end();
						return false;
					}else{
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a actualizar paciente, <b>¿Desea continuar?</b>", actualizar);
					}
				}
					ajaxRequest("controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo+"&tipoDocumento="+tipoDocumento, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);	
				}
			}else{				
				var numeroDocumento      = $("#frm_nroDocumento").val();
				var tipo                 = "Documento";
				var tipoDocumento        = $('#frm_documento option:selected').val();
				var mensaje              = "N° de Documento";
				if($("#frm_nroDocumento").val()=="" ){
					$('#frm_nroDocumento').assert(false,'No puede estar vacio o en 0 Extrajero');
				}else{
					// $("#frm_nroDocumento").prop('disabled', false);
					var validarDocumento = function(response){
						result = $.validity.end();
						if(result.valid==false){
							return false;
						}


						if(response>0 && numeroDocumento != numeroDocumento2 ){
							$('#frm_nroDocumento').assert(false,'Este Numero de Documento ya se encuentra Registrado');
							$('html, body').animate({
								scrollTop: $("#contenedor1").offset().top
							}, 2000);
							$.validity.end();
							return false;
						}else{
							modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a actualizar paciente, <b>¿Desea continuar?</b>", actualizar);
						}
					}
					ajaxRequest("controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo+"&tipoDocumento="+tipoDocumento, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);	
					
				}
			}
			
		}			

		var actualizar = function(response){
				numeroDocumento     = $("#frm_rut_pac").val();
				numeroDocumento2    = $("#frm_nroDocumento").val()
				numeroDocumento     = $.Rut.quitarFormato(numeroDocumento);         // rut junto al digito Verificador
				numeroDocumento     = numeroDocumento.substring(0, numeroDocumento.length-1); //Saca el digito Verificador

				var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&accion=actualizarPaciente'+"&rut="+numeroDocumento+"&documento="+numeroDocumento2, 'POST', 'JSON', 1);
				switch(response.status){
					case "success": modalMensaje("Paciente Actualizado", "Paciente Actualizado exitosamente.<br>Se generó # Actualización del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_actualizado", 650, 300);
					break;
					case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se actualizo el paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_actualizado", 400, 300);
					break;
					default:        modalMensaje("Error generico", response, "error_generico_paciente_actualizado", 400, 300);
					break;
				}				
				ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+id,'#contenidoPaciente','', true);
			}
		
		// modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a Actualizar Paciente, <b>¿Desea continuar?</b>", actualizar);
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
	$("#frm_fechaDefuncion").prop('disabled', false);
	$("#frm_notificacion").prop('disabled', false);
	$("#frm_prevision").prop('disabled', false);
}

function camposDisable2(){
$("#frm_nroDocumento").prop('disabled', false);
}

function obtenerValorCiudad(ciudad){
	$('#frm_ciudadIndicePaciente').prop("disabled", false);
	$("#divSeleccionCiudadesIndicePaciente").show("slow");
	var regId  = $('#frm_regionIndicePaciente').val();
	if(regId !== null && regId != '' && regId != '99'){
		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','regId='+regId+'&accion=cargarCiudades', 'POST', 'JSON', 1);
		if(ciudad == "999" || ciudad === null || ciudad == ''){
			$("#divSeleccionComunasIndicePaciente").hide("slow");
			$('#frm_ciudadIndicePaciente').append('<option value="" selected> Seleccione Ciudad </option>');			
		}
		else{
			$("#divSeleccionComunasIndicePaciente").show("slow");
			$('#frm_ciudadIndicePaciente').append('<option value=""> Seleccione Ciudad </option>');
		}
		for (var i=0; i<response.length; i++) {
			if(ciudad == response[i].CIU_Id ){
				$('#frm_ciudadIndicePaciente').append('<option value="' + response[i].CIU_Id + '" selected = "selected">' + response[i].CIU_Descripcion + '</option>');
			}
			else{
				$('#frm_ciudadIndicePaciente').append('<option value="' + response[i].CIU_Id + '">' + response[i].CIU_Descripcion + '</option>');
			}
		}
	}
	else{
		$("#divSeleccionCiudadesIndicePaciente").hide("slow");
		$("#divSeleccionComunasIndicePaciente").hide("slow");
	}	
}

function obtenerValorComuna(comuna){
	$('#frm_comunaIndicePaciente').prop("disabled", false);
	var ciuId  = $('#frm_ciudadIndicePaciente').val();
	var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','ciuId='+ciuId+'&accion=cargarComunas', 'POST', 'JSON', 1);
	if(comuna == 349 || comuna === null){
		$('#frm_comunaIndicePaciente').append('<option value="" selected> Seleccione Comuna </option>');
	}
	else{
		$('#frm_comunaIndicePaciente').append('<option value=""> Seleccione Comuna </option>');
	}
	for (var i=0; i<response.length; i++) {
		if(comuna === response[i].id ){
			$('#frm_comunaIndicePaciente').append('<option value="' + response[i].id + '" selected = "selected">' + response[i].comuna + '</option>');
		}
		else{
			$('#frm_comunaIndicePaciente').append('<option value="' + response[i].id+ '">' + response[i].comuna + '</option>');
		}
	}	
}



