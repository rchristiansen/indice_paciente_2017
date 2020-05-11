$(document).ready(function(){

	/***************EVENTOS DE INFORMACIÓN PACIENTE**************/
	sumoSelect(".sumoComuna");
	sumoSelect(".sumoAtencion");
	sumoSelect(".sumoNacionalidad");
	sumoSelect(".sumoPrevision");
	sumoSelect(".sumoConvenio");
	sumoSelect(".sumoComunaLaboral");
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
			removerValidity();
		}else{
			$(this).val("N");
			$("#divRut").show();
			$("#divNroDocumento").hide();
			$("#frm_nroDocumento").val(""); //input
			$("#divDocumento").hide();
			$("#frm_documento").val("");    //input
			removerValidity();
		}
	});


	$("#frm_rut_pac").Rut({
		on_error: function(){
			$.validity.start();
			$('#frm_rut_pac').assert(false,'Ingrese un rut valido');
			result.valid=false;
			var result = $.validity.end();
			return false;
		},
		on_success: function(){
			$.validity.start();
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


	/***************Boton por Rut**************/
	// $("#btnPorRut").click(function(){
	// 	//var rut = $("#frm_rut_pac").val();
	// 	//rut=$.Rut.quitarFormato(rut); // rut junto al digito Verificador
	// 	//rut = rut.substring(0, rut.length-1); //Saca el digito Verificador

	// 	var rutValido= $.Rut.validar($("#frm_rut_pac").val());
	// 	if(rutValido==false){
	// 		$('#frm_rut_pac').match('date',"Ingrese un rut valido");
	// 		$.validity.end();
	// 		return false;
	// 	}
	// });

	$("#btnVolver").click(function(){
      view("#contenido");
      $.validity.start();
    });

    $("#btnBuscar").click(function(){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php','','#contenido');
	});

	 $("#btnGuardarPaciente").click(function(){
	 	var mensaje;
	 	var numeroDocumento;
	 	var tipo;
		if( ! $("#frm_extranjero").is(":checked") ){
			var rutValido = $.Rut.validar($("#frm_rut_pac").val());
			if(rutValido==false && $("#frm_rut_pac").val()!=""){
				$('#frm_rut_pac').assert(false,'Ingrese un rut valido');
				$('html, body').animate({
					scrollTop: $("#contenedor1").offset().top
				}, 2000);
				$.validity.end();
				return false;
			}

			numeroDocumento = $("#frm_rut_pac").val();
			numeroDocumento     = $.Rut.quitarFormato(numeroDocumento);         // rut junto al digito Verificador
			numeroDocumento     = numeroDocumento.substring(0, numeroDocumento.length-1); //Saca el digito Verificador
			tipo = "rut";

			var validarDocumento = function(response){
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
		}else{
		}
		var  grabarPaciente = function(){
			var grabar = function(response){
				switch(response.status){
					case "success": modalMensaje("Paciente registrado", "Paciente ingresado exitosamente.<br>Se generó # registro del Paciente: "+response.id, "success_paciente_agregado", 400, 300);
					break;
					case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el proveedor, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 400, 300);
					break;
					default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					break;
				}
			}
			ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
			// view("#contenido");
		}
		ajaxRequest("controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);
	});

});