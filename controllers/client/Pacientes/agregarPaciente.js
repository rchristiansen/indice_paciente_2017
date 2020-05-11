$(document).ready(function(){

	/***************EVENTOS DE INFORMACIÓN PACIENTE**************/
	// sumoSelect(".sumoComuna");
	// sumoSelect(".sumoAtencion");
	// sumoSelect(".sumoNacionalidad");
	// sumoSelect(".sumoPrevision");
	// sumoSelect(".sumoConvenio");
	// sumoSelect(".sumoComunaLaboral");
	calendario("#datePickerREC");
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

	$("#frm_extranjero").click(function(){
		if( $("#frm_extranjero").is(":checked") ) {
			$(this).val("S");
			$("#divDocumento").show();
			$("#divNroDocumento").show();
			$("#divRut").hide();
			$("#frm_rut_pac").val("");      //input
			// alert("si")
			removerValidity();
		}else{
			$(this).val("N");
			$("#divRut").show();
			$("#divNroDocumento").hide();
			$("#frm_nroDocumento").val(""); //input
			$("#divDocumento").hide();
			$("#frm_documento").val("");    //select
			// alert("no")
			removerValidity();
		}
	});


	$("#frm_rut_pac").Rut({
		on_error: function(){
			$.validity.start();
			$('#frm_rut_pac').assert(false,'Ingrese un rut valido');
			// result.valid=false;
			// var result = $.validity.end();
			return false;
		},
		on_success: function(){
			$.validity.start();
			var result = $.validity.end();
			return false;
		},
		format_on: 'keyup'
	});

	var correoOK=0;
	$('#frm_email').blur(function(){
		var email = $(this).val();
		if(validarEmail(email)!= true){
			$.validity.start();
			$('#frm_email').assert(false,'Ingrese un Correo valido');
			correoOK=1;
		}else{
			$.validity.start();
			correoOK=0;
		}
	});

	$("#btnVolver").click(function(){
		view("#contenidoPaciente");
		$.validity.start();
	});

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
	});		
		
	

	$("#btnBuscar").click(function(){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php','','#contenidoPaciente','', true);
	});

	$("#btnGuardarPaciente").click(function(){
		$.validity.start();
		var mensaje;
		var numeroDocumento;
		var tipo;
		var tipoDocumento;

		$("#frm_nombres").require('Debe Ingresar Nombres');
		$("#frm_AP").require('Debe Ingresar Apellido Paterno');
		$("#frm_AM").require('Debe Ingresar Apellido Materno');

	 	if( $("#frm_extranjero").prop('checked') ) { //cuando es extranjero
	 		if(correoOK==1){
	 			$('#frm_email').assert(false,'Ingrese un Correo valido');
	 			$.validity.end();
	 			return false;
	 		}

	 		if($("#frm_documento").val() == ""){
	 			$("#frm_documento").require('Debe Seleccionar el tipo de Documento');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 			$.validity.end();
	 			return false;
	 		}

	 		if($("#frm_nombres").val().length < 4 && $("#frm_nombres").val()!=""){ //nombres tamaño
	 			alert("2")
	 			$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 			$.validity.end();
	 			return false;
	 		}else if($("#frm_nombres").val()=="" ){ //nombre vacio
	 			alert("3")
	 			$("#frm_nombres").require('Debe Ingresar Nombres');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 		}else if($("#frm_AP").val()==""){ //apellido vacio
	 			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 		}else if($("#frm_AP").val().length < 4 && $("#frm_AP").val()!=""){ //apellido tamaño
	 			$('#frm_AP').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 		}else if($("#frm_AM").val()==""){ //apellido vacio
	 			$("#frm_AM").require('Debe Ingresar Apellido Materno');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 		}else if($("#frm_AM").val().length < 4 && $("#frm_AM").val()!=""){ //tamaño
	 			$('#frm_AM').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
	 			$('html, body').animate({
	 				scrollTop: $("#contenedor1").offset().top
	 			}, 2000);
	 		}

	 		if($("#frm_NombresPadre").val().length < 4 && $("#frm_NombresPadre").val()!=""){ //datos Padres extranjero
				alert("aaaaa")
				$('#frm_NombresPadre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AP_Padre").val().length < 4 && $("#frm_AP_Padre").val()!=""){ //datos Padres extranjero
				alert("bbbb")
				$('#frm_AP_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AM_Padre").val().length < 4 && $("#frm_AM_Padre").val()!=""){ //datos Padres extranjero
				alert("cccc")
				$('#frm_AM_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_NombresMadre").val().length < 4 && $("#frm_NombresMadre").val()!=""){ //datos Madre extranjero
				alert("EEEE")
				$('#frm_NombresMadre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AP_Madre").val().length < 4 && $("#frm_AP_Madre").val()!=""){ //datos Madre extranjero
				alert("DDDD")
				$('#frm_AP_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AM_Madre").val().length < 4 && $("#frm_AM_Madre").val()!=""){ //datos Madres extranjero
				alert("CCCC")
				$('#frm_AM_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_nombres_otroContacto").val().length < 4 && $("#frm_nombres_otroContacto").val()!=""){ //datos Contacto extranjero
				alert("EEEE")
				$('#frm_nombres_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AP_otroContacto").val().length < 4 && $("#frm_AP_otroContacto").val()!=""){ //datos Contacto extranjero
				alert("DDDD")
				$('#frm_AP_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AM_otroContacto").val().length < 4 && $("#frm_AM_otroContacto").val()!=""){ //datos Contacto extranjero
				alert("CCCC")
				$('#frm_AM_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

	 		if($("#frm_nroDocumento").val() == ""){
	 			alert("faafaf");
	 			$("#frm_nroDocumento").val(0)
	 			var  grabarPaciente = function(){
	 				camposDisable();
	 				result = $.validity.end();
	 				if(result.valid==false){
	 					return false;
	 				}
	 				var grabar = function(response){
	 					switch(response.status){
	 						/*case "successNacional": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente Rut: "+response.id, "success_pacienteNac_agregado", 500, 300);
	 						break;
	 						case "successNacSinRut": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente ID: "+response.id, "success_pacienteNac_agregado", 500, 300);
	 						break;
	 						case "successExtrajero": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nro de Documento: "+response.id, "success_pacienteExt_agregado", 500, 300);
	 						break;
	 						case "successExtraSinNroDoc": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: "+response.id, "success_pacienteExt_agregado", 500, 300);
	 						break;
	 						case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
	 						break;
	 						default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
	 						break;*/
	 					    case "success": modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
          					break;
				            case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
				            break;
				            default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
				            break;
	 					}
	 				}
	 				ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
	 				view("#contenidoPaciente");
	 			}
	 		}
		}else{ /*******************************************CUANDO ES NACIONAL*****************************************************///

			if(correoOK==1){
				$('#frm_email').assert(false,'Debe Ingresar un correo valido');
				$.validity.end();
				return false;
			}

			if($("#frm_NombresPadre").val().length < 7 && $("#frm_NombresPadre").val()!=""){ //datos Padres nac
				alert("aaaaa")
				$('#frm_NombresPadre').assert(false,'Debe Ingresar Mínimo 7 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AP_Padre").val().length < 4 && $("#frm_AP_Padre").val()!=""){ //datos Padres nac
				alert("bbbb")
				$('#frm_AP_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AM_Padre").val().length < 4 && $("#frm_AM_Padre").val()!=""){ //datos Padres nac
				alert("cccc")
				$('#frm_AM_Padre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			/*******************************************DATOS MADRE NAC*****************************************************///

			if($("#frm_NombresMadre").val().length < 7 && $("#frm_NombresMadre").val()!=""){ //datos Madre nac
				alert("EEEE")
				$('#frm_NombresMadre').assert(false,'Debe Ingresar Mínimo 7 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AP_Madre").val().length < 4 && $("#frm_AP_Madre").val()!=""){ //datos Madre nac
				alert("DDDD")
				$('#frm_AP_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			if($("#frm_AM_Madre").val().length < 4 && $("#frm_AM_Madre").val()!=""){ //datos Madres nac
				alert("CCCC")
				$('#frm_AM_Madre').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor2").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

		/*******************************************VALIDANDO CAMPOS NACIONAL************************************************///
			if($("#frm_nombres").val().length < 7 && $("#frm_nombres").val()!=""){
				alert("2")
				$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 7 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_nombres").val()==""){
				alert("vvvv")
				$("#frm_nombres").require('Debe Ingresar Nombres');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
			}else if($("#frm_AP").val()==""){
				alert("rrrr")
				$("#frm_AP").require('Debe Ingresar Apellido Paterno');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
			}else if($("#frm_AP").val().length < 4 && $("#frm_AP").val()!=""){
				$('#frm_AP').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AM").val()==""){
				alert("nnnnn")
				$("#frm_AM").require('Debe Ingresar Apellido Materno');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
			}else if($("#frm_AM").val().length < 4 && $("#frm_AM").val()!=""){
				$('#frm_AM').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_nombres_otroContacto").val().length < 7 && $("#frm_nombres_otroContacto").val()!=""){ //datos Contacto nac
				alert("EEEE")
				$('#frm_nombres_otroContacto').assert(false,'Debe Ingresar Mínimo 7 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AP_otroContacto").val().length < 4 && $("#frm_AP_otroContacto").val()!=""){ //datos Contacto nac
				alert("DDDD")
				$('#frm_AP_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else if($("#frm_AM_otroContacto").val().length < 4 && $("#frm_AM_otroContacto").val()!=""){ //datos Contacto nac
				alert("CCCC")
				$('#frm_AM_otroContacto').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
				$('html, body').animate({
					scrollTop: $("#contenedor3").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}else{
				if($("#frm_rut_pac").val()==0){
					alert("4")
					$("#frm_rut_pac").val(0);
					var  grabarPaciente = function(){
						camposDisable();
						result = $.validity.end();
						if(result.valid==false){
							return false;
						}
						var grabar = function(response){
							switch(response.status){
								/*case "successNacional": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente Rut: "+response.id, "success_pacienteNac_agregado", 500, 300);
								break;
								case "successNacSinRut": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente ID: "+response.id, "success_pacienteNac_agregado", 500, 300);
								break;
								case "successExtrajero": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nro de Documento: "+response.id, "success_pacienteExt_agregado", 500, 300);
								break;
								case "successExtraSinNroDoc": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: "+response.id, "success_pacienteExt_agregado", 500, 300);
								break;
								case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
								break;
								default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
								break;*/
								case "success": modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
          					    break;
				                case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
				                break;
				                default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
				                break;
							}
						}
						ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
						view("#contenidoPaciente");
					}
					modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo Paciente, <b>¿Desea continuar?</b>", grabarPaciente);
				}else{
					alert("5")
					var rutValido = $.Rut.validar($("#frm_rut_pac").val());
					if(rutValido==false && $("#frm_rut_pac").val()!=""){
						$('#frm_rut_pac').assert(false,'Ingrese un rut valido');
						$('html, body').animate({
							scrollTop: $("#contenedor1").offset().top
						}, 2000);
						$.validity.end();
						return false;
					}
				}
			}
		}

		if( ! $("#frm_extranjero").is(":checked") ){

			if($("#frm_rut_pac").val() == ""){
				numeroDocumento     = $("#frm_rut_pac").val(0);
				tipo                = "rut";
				tipoDocumento        = $('#frm_documento option:selected').val();
			}else{
				numeroDocumento     = $("#frm_rut_pac").val();
				numeroDocumento     = $.Rut.quitarFormato(numeroDocumento);         // rut junto al digito Verificador
				numeroDocumento     = numeroDocumento.substring(0, numeroDocumento.length-1); //Saca el digito Verificador
				tipo                = "rut";
				tipoDocumento        = $('#frm_documento option:selected').val();
			}

			var validarDocumento = function(response){
				result = $.validity.end();
				if(result.valid==false){
					return false;
				}
				if(response>0){
					$('#frm_rut_pac').assert(false,'Este Rut ya se encuentra Registrado');
					$('html, body').animate({
						scrollTop: $("#contenedor1").offset().top
					}, 2000);
					$.validity.end();
					return false;
				}else{
					modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo Paciente, <b>¿Desea continuar?</b>", grabarPaciente);
				}
			}
			mensaje = "N° de Rut";
			}else{// ACA VALIDAMOS DOCUMENTO EXTRANJERO
				alert("ddd");
				if($("#frm_nroDocumento").val()==0){
					tipoDocumento        = $('#frm_documento option:selected').val();
					numeroDocumento      = $("#frm_nroDocumento").val(0);
					tipo                 = "numeroDocumento";
				}else{
					tipoDocumento        = $('#frm_documento option:selected').val();
					numeroDocumento      = $("#frm_nroDocumento").val();
					tipo                 = "numeroDocumento";
				}

				var validarDocumento = function(response){
					result = $.validity.end();
					if(result.valid==false){
						return false;
					}
					if(response>0){
						$('#frm_nroDocumento').assert(false,'Este Numero de Documento ya se encuentra Registrado');
						$('html, body').animate({
							scrollTop: $("#contenedor1").offset().top
						}, 2000);
						$.validity.end();
						return false;
					}else{
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo Paciente, <b>¿Desea continuar?</b>", grabarPaciente);
					}
				}
				mensaje = "N° de Documento";
			}
			var  grabarPaciente = function(){
				camposDisable();
				result = $.validity.end();
				if(result.valid==false){
					return false;
				}
				var grabar = function(response){
					switch(response.status){
						/*case "successNacional": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente Rut: "+response.id, "success_pacienteNac_agregado", 500, 300);
						break;
						case "successExtrajero": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nro de Documento: "+response.id, "success_pacienteExt_agregado", 500, 300);
						break;
						case "successNacSinRut": modalMensaje("Paciente registrado", "Paciente Nacional ingresado exitosamente.<br>Se generó # registro del Paciente ID: "+response.id, "success_pacienteNac_agregado", 500, 300);
						break;
						case "successExtraSinNroDoc": modalMensaje("Paciente registrado", "Paciente Extranjero ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: "+response.id, "success_pacienteExt_agregado", 500, 300);
						break;
						case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
						break;
						default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
						break;*/
						case "success": modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
          				break;
				        case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
				        break;
				        default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
				        break;
					}
				}
				ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
				view("#contenidoPaciente");
			}
			if(numeroDocumento!=0 || numeroDocumento!=""){
				ajaxRequest("controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo+"&tipoDocumento="+tipoDocumento, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);
			}
		});
});
function camposDisable(){
	$("#frm_nroFicha").prop('disabled', false);
}