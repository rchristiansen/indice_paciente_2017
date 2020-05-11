function evitaCollapse(inputHijo, colapsa){
	var id = $(inputHijo).parents(".collapse").attr("id");
	$("#"+id).off().on('hide.bs.collapse', function (e) {
		if(typeof colapsa ==='undefined')
			e.preventDefault();
	});
}
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
	// validar("#frm_nroDocumento"          ,"letras_numeros");
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

	$("#btnVolver").click(function(){
		view("#contenidoPaciente");
		$.validity.start();
	});

	// $("#frm_Naciemito").change(function(){
	if($("#sistemaExterno").val()==""){
		$('#datePickerREC').on('changeDate', function(selected){
			var fechaNac;
			fechaNac = $("#frm_Naciemito").val();
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','fechaNac='+fechaNac+'&accion=calcularFechaPaciente', 'POST', 'JSON', 1);
			switch(response.status){
				case "success":  document.getElementById('labelEdadIP').innerHTML = response.id;
				break;
				case   "error":  document.getElementById('labelEdadIP').innerHTML = "error";
				break;
				default:         document.getElementById('labelEdadIP').innerHTML = "error2";
				break;
			}
		});
	}

	if($("#sistemaExterno").val()){
		$('#datePickerREC_Externo').on('changeDate', function(selected){
			var fechaNac_;
			fechaNac_ = $("#frm_Naciemito_ext").val();
			// alert(fechaNac_)
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','fechaNac='+fechaNac_+'&accion=calcularFechaPaciente', 'POST', 'JSON', 1);
			switch(response.status){
				case "success":  document.getElementById('labelEdadIP').innerHTML = response.id;
				break;
				case   "error":  document.getElementById('labelEdadIP').innerHTML = "error";
				break;
				default:         document.getElementById('labelEdadIP').innerHTML = "error2";
				break;
			}
		});	
	}

	if($("#sistemaExterno").val()){		
		$("#btnVolver_ext").click(function(){
			result = $.validity.end();
					if(result.valid==false){
						return false;
					}
			// $.validity.start();
			// $.validity.end();
			// return false;
			var sistemaExterno  		= $("#sistemaExterno").val();
			var nombres 	    		= $("#nombres").val();
			var fonasa 	   	    		= $("#fonasa").val();
			var run 	   	    		= $("#run").val();
			var AP 	   	   	    		= $("#AP").val();
			var AM 	   	   	    		= $("#AM").val();
			var fechaNac 	   			= $("#fechaNac").val();
			var calcularEdad   			= $("#calcularEdad").val();
			var sexo   		    		= $("#sexo").val();
			var etnia   	    		= $("#etnia").val();
			var cap   	  	    		= $("#cap").val();
			var nac   	  	    		= $("#nac").val();
			var direccion       		= $("#direccion").val();
			var correo          		= $("#correo").val();
			var telefonoCelular     	= $("#telefonoCelular").val();
			var telefonoCelularFijo     = $("#telefonoCelularFijo").val();
			var prevision     			= $("#prevision").val();
			var formaPago     			= $("#formaPago").val();
			var idPaciente     			= $("#idPaciente").val();
			var pacienteFall     		= $("#pacienteFall").val();
			var tipoDocumentoLabel     	= $("#tipoDocumentoLabel").val();	
			var doc_documento     		= $("#doc_documento").val();


					
			
			ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php','sistemaExterno='+sistemaExterno+'&nombres='+nombres+'&fonasa='+fonasa+'&run='+run+'&AP='+AP+'&AM='+AM+'&fechaNac='+fechaNac+'&calcularEdad='+calcularEdad+'&sexo='+sexo+'&etnia='+etnia+'&cap='+cap+'&nac='+nac+'&direccion='+direccion+'&correo='+correo+'&telefonoCelular='+telefonoCelular+'&telefonoCelularFijo='+telefonoCelularFijo+'&prevision='+prevision+'&formaPago='+formaPago+'&idPaciente='+idPaciente+'&pacienteFall='+pacienteFall+'&tipoDocumentoLabel='+tipoDocumentoLabel+'&doc_documento='+doc_documento+'&back=1','#contenidoPaciente','', true);
		});
	}

	if($("#sistemaExterno").val()){	
		// alert("1")		
		$("#btnAddFonasa_Externo").click(function(){
			// alert("sistemaExterno")	
			// alert("2")	
			var validarPacienteFonasa1 = function(){               //FUNCION 1	
			// alert("3")						
			if($("#frm_rut_pacFonasa").val()==""){
					$.validity.start();
					$('#frm_rut_pacFonasa').assert(false,'Debe Ingrese un Run');
					$.validity.end();
	 				return false;
			}else{
				var rutValido= $.Rut.validar($("#frm_rut_pacFonasa").val());
				if(rutValido==false){
					$.validity.start();
					$('#frm_rut_pacFonasa').assert(false,'El Run Ingresado, no es valido');	
					$.validity.end();
	 				return false;				
				}else{		
					// alert("4")				
					var pacienteFonasaBuscar = function(response){	//FUNCION 3						
						switch(response.status){
							case "success":
								// alert()														
								$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada								
								//modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaAgregarPaciente.php','datosFonasa='+response.datosFonasa+'&nombre=frm_nombres_dau&apellidoPa=frm_AP_dau&apellidoMa=frm_AM_dau&run=frm_rut&fechaNac=frm_Naciemito&calcularEdad=labelEdad&sexo=frm_sexo&frm_previsionDau=frm_prevision','#pacienteFonasaCertificado','80%','auto','');							
								modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaAgregarPaciente.php','datosFonasa='+response.datosFonasa,'#pacienteFonasaCertificado','80%','auto','');							

							break;

							case "noContetar":
								modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
							break;							
						}
						$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
					}//FIN FUNCION 3
					var rut = $("#frm_rut_pacFonasa").val();
					rut     = $.Rut.quitarFormato(rut);
					rut     = rut.substring(0, rut.length-1);
					ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','rut='+rut+'&accion=confirmarPacienteFonasa', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', pacienteFonasaBuscar);
				//}//FIN FUNCION 2
				}				
			}
		}//FIN FUNCION 1

		var botones1 = [
		{ id: 'btnGuardar', value: '<i class="fa fa-save  aria-hidden="true"></i> Consultar', function: validarPacienteFonasa1, class: 'btn btn-primary' }
		]
		modalFormulario('Consultar Fonasa','/indice_paciente_2017/views/modules/Fonasa/buscarPacienteFonasa.php','','#pacienteFonasa','38%','22%',botones1);
		});
	}


	$("#btnAddFonasa").click(function(){		
		var validarPacienteFonasa = function(){               //FUNCION 1						
			if($("#frm_rut_pacFonasa").val()==""){
					$.validity.start();
					$('#frm_rut_pacFonasa').assert(false,'Debe Ingrese un Run');
					$.validity.end();
	 				return false;
			}else{
				var rutValido= $.Rut.validar($("#frm_rut_pacFonasa").val());
				if(rutValido==false){
					$.validity.start();
					$('#frm_rut_pacFonasa').assert(false,'El Run Ingresado, no es valido');	
					$.validity.end();
	 				return false;				
				}else{
				// alert("4")					
					var pacienteFonasaBuscar = function(response){	//FUNCION 3						
						switch(response.status){
							case "success":														
								$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada								
								modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaAgregarPaciente.php','datosFonasa='+response.datosFonasa,'#pacienteFonasaCertificado','80%','auto','');							
							break;

							case "noContetar":
								modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
							break;

							// case "noContetar":
							// 	//alert("colocar mensaje");
							// 	modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');

							// 	//modalDetalle("Información de Fonasa", "/indice_paciente_2017/views/modules/Fonasa/informacionFonasa.php", "", "#modal_errorFonasa", "60%", "100%"); //cuando no se encuentra en la bd de fonasa
							// break;
						}
						$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
					}//FIN FUNCION 3
					var rut = $("#frm_rut_pacFonasa").val();
					rut     = $.Rut.quitarFormato(rut);
					rut     = rut.substring(0, rut.length-1);
					ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','rut='+rut+'&accion=confirmarPacienteFonasa', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', pacienteFonasaBuscar);
				//}//FIN FUNCION 2
				}				
			}
		}//FIN FUNCION 1

		var botones1 = [
		{ id: 'btnGuardar', value: '<i class="fa fa-save  aria-hidden="true"></i> Consultar', function: validarPacienteFonasa, class: 'btn btn-primary' }
		]
		modalFormulario('Consultar Fonasa','/indice_paciente_2017/views/modules/Fonasa/buscarPacienteFonasa.php','','#pacienteFonasa','38%','22%',botones1);
		//modalDetalleSinBotonAceptar('Buscar Paciente en Fonasa','/indice_paciente_2017/views/modules/Fonasa/buscarPacienteFonasa.php','','#pacienteFonasaSearch','37%','15%');
	});

	if($("#sistemaExterno").val()){	
		$("#btnGuardarPaciente").click(function(){
			$.validity.start();
			var mensaje;
			var numeroDocumento;
			var tipo;
			var tipoDocumento;
			var nombre          = $("#nombres").val();
			//var idPacienteUltimo = $("#idPacienteUltimo").val();

			$("#frm_nombres").require('Debe Ingresar Nombres');
			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
			$("#frm_AM").require('Debe Ingresar Apellido Materno');

		 	if( $("#frm_extranjero").prop('checked') ) { //cuando es extranjero	 		
		 		// alert("1");
		 		if($("#frm_documento").val() == ""){
		 			$("#frm_documento").require('Debe Seleccionar el tipo de Documento');
		 			// $('html, body').animate({
		 			// 	scrollTop: $("#contenedor1").offset().top
		 			// }, 2000);
		 			$.validity.end();
		 			return false;
		 		}

		 		if($("#frm_nombres").val().length < 2 && $("#frm_nombres").val()!=""){ //nombres tamaño
		 			$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 2 Caracteres');	 			
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_nombres").val()=="" ){ //nombre vacio
		 			$("#frm_nombres").require('Debe Ingresar Nombres');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AP").val()==""){ //apellido vacio
		 			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AP").val().length < 2 && $("#frm_AP").val()!=""){ //apellido tamaño
		 			$('#frm_AP').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AM").val()==""){ //apellido vacio
		 			$("#frm_AM").require('Debe Ingresar Apellido Materno');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AM").val().length < 2 && $("#frm_AM").val()!=""){ //tamaño
		 			$('#frm_AM').assert(false,'Debe Ingresar Mínimo 4 Caracteres');
		 			$.validity.end();
		 			return false;
		 		}
		 		
		 		if($("#frm_nroDocumento").val() == ""){
		 			// alert("2");
		 			$("#frm_nroDocumento").val(0)
		 			// alert(numeroDocumento)
		 			var  grabarPaciente = function(){
		 				
		 				camposDisable();
		 				result = $.validity.end();
		 				if(result.valid==false){
		 					return false;
		 				}
		 				var grabar = function(response){
		 					switch(response.status){	 						
		 					    case "success":
		 					    var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','&accion=permisoAdmision', 'POST', 'JSON', 1);

										$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
		 					    		 ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
		 					    		 modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
		 					    		 if(response.idPaciente_input && response.idPaciente){
										$('#'+response.idPaciente_input).val(response.idPaciente);
									}

									if(response.extranjero == "S"){
										// alert("1")
										if(response.tipoDocumentoLabel){
											var tipoDocumento;
											if(response.id_doc_extranjero == 1){
												var tipoDocumento = "DNI";
											}

											if(response.id_doc_extranjero == 2){
												var tipoDocumento = "PASAPORTE";
											}

											if(response.id_doc_extranjero == 3){
												var tipoDocumento = "OTROS";
											}					
											document.getElementById(response.tipoDocumentoLabel).innerHTML = tipoDocumento; //label
										}
										$('#'+response.runInput).val(response.rut_extranjero);
									}else{									
										if(response.run && response.run){
											$('#'+response.runInput).val(response.run);
										}
									}

									if(response.nombreInput && response.nombre){
										$('#'+response.nombreInput).val(response.nombre);
									}

									if(response.AP_Input && response.AP){
										$('#'+response.AP_Input).val(response.AP);
									}

									if(response.AM_Input && response.AP){
										$('#'+response.AM_Input).val(response.AM);
									}

									if(response.fechaNac_Input && response.fechaNac ){
												if(response.fechaNac2 == "0000-00-00"){
													$('#'+response.fechaNac_Input).val("");
												}else{
													$('#'+response.fechaNac_Input).val(response.fechaNac);
												}
											}								

									if(response.calcularEdad){						
										document.getElementById(response.calcularEdad).innerHTML = response.edadActual; //label
									}

									if(response.sexoSelect && response.sexo ){
										// if(response.sexo){
											var sexoPaciente = response.sexo;							
											$('#'+response.sexoSelect+' option[value='+sexoPaciente+']').attr('selected', 'selected');												
										// }
									}

									if(response.etniaSelect && response.etnia){
										var etniaPaciente = response.etnia;							
										$('#'+response.etniaSelect+' option[value='+etniaPaciente+']').attr('selected', 'selected');							
									}

									if(response.capSelect && response.cap){
										var capPaciente = response.cap;							
										$('#'+response.capSelect+' option[value='+capPaciente+']').attr('selected', 'selected');							
									}

									if(response.nacSelect && response.nac){
										var nacPaciente = response.nac;							
										$('#'+response.nacSelect+' option[value='+nacPaciente+']').attr('selected', 'selected');							
									}

									if(response.direccion_Input && response.direccion){
										$('#'+response.direccion_Input).val(response.direccion);
									}

									if(response.correo_Input && response.correo){
										$('#'+response.correo_Input).val(response.correo);
									}

									if(response.telefonoCelular_Input && response.telefonoCelular){
										$('#'+response.telefonoCelular_Input).val(response.telefonoCelular);
									}

									if(response.telefonoCelularFijo_Input && response.telefonoCelularFijo){
										$('#'+response.telefonoCelularFijo_Input).val(response.telefonoCelularFijo);
									}									

									if(permiso.permisos !="" && permiso.permisos==854){
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;
											// var respuesta1        = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
											// var select    		  = document.getElementById(response.prevision_Select);
											// for(var i=0;i<respuesta1.length;i++){
											// 	var selected="";
											// 	if (respuesta1[i].id == previsionPaciente)
											// 		selected=" selected ";
											// 	select.options[i] = new Option(respuesta1[i].prevision, respuesta1[i].id);
											// }

											$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');
										}
									}else{
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;	
											if(previsionPaciente == 0 || previsionPaciente == 1 || previsionPaciente == 2 || previsionPaciente == 3 || previsionPaciente == 4 || previsionPaciente == 5 || previsionPaciente == 6 || previsionPaciente == 7 || previsionPaciente == 8 || previsionPaciente == 9 || previsionPaciente == 10 || previsionPaciente == 11 || previsionPaciente == 12 || previsionPaciente == 13 || previsionPaciente == 14 || previsionPaciente == 15 || previsionPaciente == 16 || previsionPaciente == 17 || previsionPaciente == 18 || previsionPaciente == 19 || previsionPaciente == 22 || previsionPaciente == 25 || previsionPaciente == 26 || previsionPaciente == 27 || previsionPaciente == 28 || previsionPaciente == 30 || previsionPaciente == 31 || previsionPaciente == 32 || previsionPaciente == 34 || previsionPaciente == 35 || previsionPaciente == 36 || previsionPaciente == 37 || previsionPaciente == 38 || previsionPaciente == 39 || previsionPaciente == 40 || previsionPaciente == 41 || previsionPaciente == 42 || previsionPaciente == 43 || previsionPaciente == 44 || previsionPaciente == 45 || previsionPaciente == 46 || previsionPaciente == 47 || previsionPaciente == 48 || previsionPaciente == 49 || previsionPaciente == 50){
												// var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
												// var select    = document.getElementById(response.prevision_Select);
												// for(var i=0;i<respuesta.length;i++){
												// 	var selected="";
												// 	if (respuesta[i].id == previsionPaciente)
												// 		selected=" selected ";
												// 	select.options[i] = new Option(respuesta[i].prevision, respuesta[i].id);
												// }

												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');							
												if(response.prevision == 0 || response.prevision ==1 || response.prevision ==2 || response.prevision ==3){
													$('#'+response.prevision_Select).prop('disabled', true);	
												}else{
													$('#'+response.prevision_Select).prop('disabled', false);
												}
											}/*else{
												var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
												var idregions = ["0", "1", "2","3"];
												var select = document.getElementById(response.prevision_Select);
												for(var i=0;i<regions.length;i++){
													var selected="";
													if (idregions[i] == previsionPaciente)
														selected=" selected ";
													select.options[i] = new Option(regions[i], idregions[i]);
												}
												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
												$('#'+response.prevision_Select).prop('disabled', true);
											}*/
										}										
									}

									if(response.formaPago_Select && response.formaPago){	
										// alert("3")																		
										var formaPagoPaciente = response.formaPago;							
										$('#'+response.formaPago_Select+' option[value='+formaPagoPaciente+']').attr('selected', 'selected');							
									}


									if(response.id_doc_extranjero_input && response.id_doc_extranjero){	
										// alert("3")
										$('#'+response.id_doc_extranjero_input).val(response.id_doc_extranjero);																		
																	
									}



										
		 					    		

	          					break;

					            case "error":   
					            	modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					            break;

					            default:        
					            	modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					            break;
		 					}
		 				}
		 				ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
		 				//view("#contenidoPaciente");
		 			}
		 		}
			}else{ /*******************************************CUANDO ES NACIONAL*****************************************************///
				// alert("3");
				if($("#frm_nombres").val().length < 2 && $("#frm_nombres").val()!=""){
					$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else if($("#frm_nombres").val()==""){
					$("#frm_nombres").require('Debe Ingresar Nombres');
					$.validity.end();
					return false;
				}else if($("#frm_AP").val()==""){
					$("#frm_AP").require('Debe Ingresar Apellido Paterno');
					$.validity.end();
					return false;
				}else if($("#frm_AP").val().length < 2 && $("#frm_AP").val()!=""){
					$('#frm_AP').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else if($("#frm_AM").val()==""){
					$("#frm_AM").require('Debe Ingresar Apellido Materno');
					$.validity.end();
					return false;
				}else if($("#frm_AM").val().length < 2 && $("#frm_AM").val()!=""){
					$('#frm_AM').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else{
					if($("#frm_rut_pac").val()==0){
						// alert("4")
						// alert(numeroDocumento)
						$("#frm_rut_pac").val(0);
						var  grabarPaciente = function(){
							
							camposDisable();
							result = $.validity.end();
							if(result.valid==false){
								return false;
							}
							var grabar = function(response){
								switch(response.status){								
									case "success":
									var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','&accion=permisoAdmision', 'POST', 'JSON', 1);

											$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
											ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
											modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);											
									

									if(response.idPaciente_input && response.idPaciente){
										$('#'+response.idPaciente_input).val(response.idPaciente);
									}
									
									if(response.extranjero == "S"){
										// alert("2")
										if(response.tipoDocumentoLabel){
											var tipoDocumento;
											if(response.id_doc_extranjero == 1){
												var tipoDocumento = "DNI";
											}

											if(response.id_doc_extranjero == 2){
												var tipoDocumento = "PASAPORTE";
											}

											if(response.id_doc_extranjero == 3){
												var tipoDocumento = "OTROS";
											}					
											document.getElementById(response.tipoDocumentoLabel).innerHTML = tipoDocumento; //label
										}
										$('#'+response.runInput).val(response.rut_extranjero);
									}else{
										if(response.run && response.run){
											$('#'+response.runInput).val(response.run);
										}
									}

									if(response.nombreInput && response.nombre){
										$('#'+response.nombreInput).val(response.nombre);
									}

									if(response.AP_Input && response.AP){
										$('#'+response.AP_Input).val(response.AP);
									}

									if(response.AM_Input && response.AP){
										$('#'+response.AM_Input).val(response.AM);
									}

									if(response.fechaNac_Input && response.fechaNac ){
												if(response.fechaNac2 == "0000-00-00"){
													$('#'+response.fechaNac_Input).val("");
												}else{
													$('#'+response.fechaNac_Input).val(response.fechaNac);
												}
											}								

									if(response.calcularEdad){						
										document.getElementById(response.calcularEdad).innerHTML = response.edadActual; //label
									}

									if(response.sexoSelect && response.sexo ){
										// if(response.sexo){
											var sexoPaciente = response.sexo;							
											$('#'+response.sexoSelect+' option[value='+sexoPaciente+']').attr('selected', 'selected');												
										// }
									}

									if(response.etniaSelect && response.etnia){
										var etniaPaciente = response.etnia;							
										$('#'+response.etniaSelect+' option[value='+etniaPaciente+']').attr('selected', 'selected');							
									}

									if(response.capSelect && response.cap){
										var capPaciente = response.cap;							
										$('#'+response.capSelect+' option[value='+capPaciente+']').attr('selected', 'selected');							
									}

									if(response.nacSelect && response.nac){
										var nacPaciente = response.nac;							
										$('#'+response.nacSelect+' option[value='+nacPaciente+']').attr('selected', 'selected');							
									}

									if(response.direccion_Input && response.direccion){
										$('#'+response.direccion_Input).val(response.direccion);
									}

									if(response.correo_Input && response.correo){
										$('#'+response.correo_Input).val(response.correo);
									}

									if(response.telefonoCelular_Input && response.telefonoCelular){
										$('#'+response.telefonoCelular_Input).val(response.telefonoCelular);
									}

									if(response.telefonoCelularFijo_Input && response.telefonoCelularFijo){
										$('#'+response.telefonoCelularFijo_Input).val(response.telefonoCelularFijo);
									}									

									if(permiso.permisos !="" && permiso.permisos==854){
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;
											// var respuesta1        = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
											// var select    		  = document.getElementById(response.prevision_Select);
											// for(var i=0;i<respuesta1.length;i++){
											// 	var selected="";
											// 	if (respuesta1[i].id == previsionPaciente)
											// 		selected=" selected ";
											// 	select.options[i] = new Option(respuesta1[i].prevision, respuesta1[i].id);
											// }

											$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');
										}
									}else{
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;	
											if(previsionPaciente == 0 || previsionPaciente == 1 || previsionPaciente == 2 || previsionPaciente == 3 || previsionPaciente == 4 || previsionPaciente == 5 || previsionPaciente == 6 || previsionPaciente == 7 || previsionPaciente == 8 || previsionPaciente == 9 || previsionPaciente == 10 || previsionPaciente == 11 || previsionPaciente == 12 || previsionPaciente == 13 || previsionPaciente == 14 || previsionPaciente == 15 || previsionPaciente == 16 || previsionPaciente == 17 || previsionPaciente == 18 || previsionPaciente == 19 || previsionPaciente == 22 || previsionPaciente == 25 || previsionPaciente == 26 || previsionPaciente == 27 || previsionPaciente == 28 || previsionPaciente == 30 || previsionPaciente == 31 || previsionPaciente == 32 || previsionPaciente == 34 || previsionPaciente == 35 || previsionPaciente == 36 || previsionPaciente == 37 || previsionPaciente == 38 || previsionPaciente == 39 || previsionPaciente == 40 || previsionPaciente == 41 || previsionPaciente == 42 || previsionPaciente == 43 || previsionPaciente == 44 || previsionPaciente == 45 || previsionPaciente == 46 || previsionPaciente == 47 || previsionPaciente == 48 || previsionPaciente == 49 || previsionPaciente == 50){
												// var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
												// var select    = document.getElementById(response.prevision_Select);
												// for(var i=0;i<respuesta.length;i++){
												// 	var selected="";
												// 	if (respuesta[i].id == previsionPaciente)
												// 		selected=" selected ";
												// 	select.options[i] = new Option(respuesta[i].prevision, respuesta[i].id);
												// }

												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');							
												if(response.prevision == 0 || response.prevision ==1 || response.prevision ==2 || response.prevision ==3){
													$('#'+response.prevision_Select).prop('disabled', true);	
												}else{
													$('#'+response.prevision_Select).prop('disabled', false);
												}
											}/*else{
												var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
												var idregions = ["0", "1", "2","3"];
												var select = document.getElementById(response.prevision_Select);
												for(var i=0;i<regions.length;i++){
													var selected="";
													if (idregions[i] == previsionPaciente)
														selected=" selected ";
													select.options[i] = new Option(regions[i], idregions[i]);
												}
												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
												$('#'+response.prevision_Select).prop('disabled', true);
											}*/
										}										
									}

									if(response.formaPago_Select && response.formaPago){	
										// alert("3")																		
										var formaPagoPaciente = response.formaPago;							
										$('#'+response.formaPago_Select+' option[value='+formaPagoPaciente+']').attr('selected', 'selected');							
									}

									if(response.id_doc_extranjero_input && response.id_doc_extranjero){	
										// alert("3")
										$('#'+response.id_doc_extranjero_input).val(response.id_doc_extranjero);																		
																	
									}
											
											$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null );

	          					    break;
					                case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					                break;
					                default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					                break;
								}
							}
							ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
							// view("#contenidoPaciente");						
							
						}
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
					}else{
						// alert("5")
						var rutValido = $.Rut.validar($("#frm_rut_pac").val());
						if(rutValido==false && $("#frm_rut_pac").val()!=""){
							// $('#frm_rut_pac').assert(false,'Ingrese un rut valido');
							// $('html, body').animate({
							// 	scrollTop: $("#contenedor1").offset().top
							// }, 2000);
							$.validity.end();
							return false;
						}
					}
				}
			}

			if( ! $("#frm_extranjero").is(":checked") ){
				// alert("6")
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
						// $('html, body').animate({
						// 	scrollTop: $("#contenedor1").offset().top
						// }, 2000);
						$.validity.end();
						return false;
					}else{
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
					}
				}
				mensaje = "N° de Rut";
				}else{// ACA VALIDAMOS DOCUMENTO EXTRANJERO
					// alert("ddd");
					if($("#frm_nroDocumento").val()==0){
						tipoDocumento        = $('#frm_documento option:selected').val();
						numeroDocumento      = $("#frm_nroDocumento").val(0);
						tipo                 = "numeroDocumento";
					}else{
						tipoDocumento        = $('#frm_documento option:selected').val();
						numeroDocumento      = $("#frm_nroDocumento").val();
						tipo                 = "numeroDocumento";
					}

					// alert(numeroDocumento);

					var validarDocumento = function(response){
						result = $.validity.end();
						if(result.valid==false){
							return false;
						}
						if(response>0){
							$('#frm_nroDocumento').assert(false,'Este Numero de Documento ya se encuentra Registrado');
							// $('html, body').animate({
							// 	scrollTop: $("#contenedor1").offset().top
							// }, 2000);
							// $.validity.end();
							return false;
						}else{
							modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
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
							case "success": 
									var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','&accion=permisoAdmision', 'POST', 'JSON', 1);

									$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
									ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
									modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
									
									if(response.idPaciente_input && response.idPaciente){
										$('#'+response.idPaciente_input).val(response.idPaciente);
									}
									
									if(response.extranjero == "S"){
										// alert("3")
										if(response.tipoDocumentoLabel){

											var tipoDocumento;
											if(response.id_doc_extranjero == 1){
												var tipoDocumento = "DNI";
											}

											if(response.id_doc_extranjero == 2){
												var tipoDocumento = "PASAPORTE";
											}

											if(response.id_doc_extranjero == 3){
												var tipoDocumento = "OTROS";
											}					
											document.getElementById(response.tipoDocumentoLabel).innerHTML = tipoDocumento; //label
										}
										$('#'+response.runInput).val(response.rut_extranjero);
									}else{
										if(response.run && response.run){
											$('#'+response.runInput).val(response.run);
										}
									}

									if(response.nombreInput && response.nombre){
										$('#'+response.nombreInput).val(response.nombre);
									}

									if(response.AP_Input && response.AP){
										$('#'+response.AP_Input).val(response.AP);
									}

									if(response.AM_Input && response.AP){
										$('#'+response.AM_Input).val(response.AM);
									}

									if(response.fechaNac_Input && response.fechaNac ){
												if(response.fechaNac2 == "0000-00-00"){
													$('#'+response.fechaNac_Input).val("");
												}else{
													$('#'+response.fechaNac_Input).val(response.fechaNac);
												}
											}								

									if(response.calcularEdad){						
										document.getElementById(response.calcularEdad).innerHTML = response.edadActual; //label
									}

									if(response.sexoSelect && response.sexo ){
										// if(response.sexo){
											var sexoPaciente = response.sexo;							
											$('#'+response.sexoSelect+' option[value='+sexoPaciente+']').attr('selected', 'selected');												
										// }
									}

									if(response.etniaSelect && response.etnia){
										var etniaPaciente = response.etnia;							
										$('#'+response.etniaSelect+' option[value='+etniaPaciente+']').attr('selected', 'selected');							
									}

									if(response.capSelect && response.cap){
										var capPaciente = response.cap;							
										$('#'+response.capSelect+' option[value='+capPaciente+']').attr('selected', 'selected');							
									}

									if(response.nacSelect && response.nac){
										var nacPaciente = response.nac;							
										$('#'+response.nacSelect+' option[value='+nacPaciente+']').attr('selected', 'selected');							
									}

									if(response.direccion_Input && response.direccion){
										$('#'+response.direccion_Input).val(response.direccion);
									}

									if(response.correo_Input && response.correo){
										$('#'+response.correo_Input).val(response.correo);
									}

									if(response.telefonoCelular_Input && response.telefonoCelular){
										$('#'+response.telefonoCelular_Input).val(response.telefonoCelular);
									}

									if(response.telefonoCelularFijo_Input && response.telefonoCelularFijo){
										$('#'+response.telefonoCelularFijo_Input).val(response.telefonoCelularFijo);
									}									

									if(permiso.permisos !="" && permiso.permisos==854){
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;
											// var respuesta1        = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
											// var select    		  = document.getElementById(response.prevision_Select);
											// for(var i=0;i<respuesta1.length;i++){
											// 	var selected="";
											// 	if (respuesta1[i].id == previsionPaciente)
											// 		selected=" selected ";
											// 	select.options[i] = new Option(respuesta1[i].prevision, respuesta1[i].id);
											// }

											$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');
										}
									}else{
										if(response.prevision_Select && response.prevision){
											var previsionPaciente = response.prevision;	
											if(previsionPaciente == 0 || previsionPaciente == 1 || previsionPaciente == 2 || previsionPaciente == 3 || previsionPaciente == 4 || previsionPaciente == 5 || previsionPaciente == 6 || previsionPaciente == 7 || previsionPaciente == 8 || previsionPaciente == 9 || previsionPaciente == 10 || previsionPaciente == 11 || previsionPaciente == 12 || previsionPaciente == 13 || previsionPaciente == 14 || previsionPaciente == 15 || previsionPaciente == 16 || previsionPaciente == 17 || previsionPaciente == 18 || previsionPaciente == 19 || previsionPaciente == 22 || previsionPaciente == 25 || previsionPaciente == 26 || previsionPaciente == 27 || previsionPaciente == 28 || previsionPaciente == 30 || previsionPaciente == 31 || previsionPaciente == 32 || previsionPaciente == 34 || previsionPaciente == 35 || previsionPaciente == 36 || previsionPaciente == 37 || previsionPaciente == 38 || previsionPaciente == 39 || previsionPaciente == 40 || previsionPaciente == 41 || previsionPaciente == 42 || previsionPaciente == 43 || previsionPaciente == 44 || previsionPaciente == 45 || previsionPaciente == 46 || previsionPaciente == 47 || previsionPaciente == 48 || previsionPaciente == 49 || previsionPaciente == 50){
												// var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);
												// var select    = document.getElementById(response.prevision_Select);
												// for(var i=0;i<respuesta.length;i++){
												// 	var selected="";
												// 	if (respuesta[i].id == previsionPaciente)
												// 		selected=" selected ";
												// 	select.options[i] = new Option(respuesta[i].prevision, respuesta[i].id);
												// }

												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected');							
												if(response.prevision == 0 || response.prevision ==1 || response.prevision ==2 || response.prevision ==3){
													$('#'+response.prevision_Select).prop('disabled', true);	
												}else{
													$('#'+response.prevision_Select).prop('disabled', false);
												}
											}/*else{
												var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
												var idregions = ["0", "1", "2","3"];
												var select = document.getElementById(response.prevision_Select);
												for(var i=0;i<regions.length;i++){
													var selected="";
													if (idregions[i] == previsionPaciente)
														selected=" selected ";
													select.options[i] = new Option(regions[i], idregions[i]);
												}
												$('#'+response.prevision_Select+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
												$('#'+response.prevision_Select).prop('disabled', true);
											}*/
										}										
									}

									if(response.formaPago_Select && response.formaPago){	
										// alert("3")																		
										var formaPagoPaciente = response.formaPago;							
										$('#'+response.formaPago_Select+' option[value='+formaPagoPaciente+']').attr('selected', 'selected');							
									}

									if(response.id_doc_extranjero_input && response.id_doc_extranjero){	
										// alert("3")
										$('#'+response.id_doc_extranjero_input).val(response.id_doc_extranjero);																		
																	
									}

									$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null );		
									
	          				break;
					        case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					        break;
					        default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					        break;
						}
					}
					ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
					//view("#contenidoPaciente");
				}
				if(numeroDocumento!=0 || numeroDocumento!=""){
					ajaxRequest("/indice_paciente_2017/controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo+"&tipoDocumento="+tipoDocumento, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);
				}
			});		
	}

	
	if($("#sistemaExterno").val() == ''){
		$("#btnGuardarPaciente").click(function(){
			$.validity.start();
			var mensaje;
			var numeroDocumento;
			var tipo;
			var tipoDocumento;
			//var idPacienteUltimo = $("#idPacienteUltimo").val();

			$("#frm_nombres").require('Debe Ingresar Nombres');
			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
			$("#frm_AM").require('Debe Ingresar Apellido Materno');

		 	if( $("#frm_extranjero").prop('checked') ) { //cuando es extranjero	 		

		 		if($("#frm_documento").val() == ""){
		 			$("#frm_documento").require('Debe Seleccionar el tipo de Documento');
		 			$('html, body').animate({
		 				scrollTop: $("#contenedor1").offset().top
		 			}, 2000);
		 			$.validity.end();
		 			return false;
		 		}

		 		if($("#frm_nombres").val().length < 2 && $("#frm_nombres").val()!=""){ //nombres tamaño
		 			$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 2 Caracteres');	 			
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_nombres").val()=="" ){ //nombre vacio
		 			$("#frm_nombres").require('Debe Ingresar Nombres');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AP").val()==""){ //apellido vacio
		 			$("#frm_AP").require('Debe Ingresar Apellido Paterno');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AP").val().length < 2 && $("#frm_AP").val()!=""){ //apellido tamaño
		 			$('#frm_AP').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AM").val()==""){ //apellido vacio
		 			$("#frm_AM").require('Debe Ingresar Apellido Materno');
		 			$.validity.end();
		 			return false;
		 		}else if($("#frm_AM").val().length < 2 && $("#frm_AM").val()!=""){ //tamaño
		 			$('#frm_AM').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
		 			$.validity.end();
		 			return false;
		 		}
		 		
		 		if($("#frm_nroDocumento").val() == ""){
		 			// alert("faafaf");
		 			$("#frm_nroDocumento").val(0)
		 			var  grabarPaciente = function(){
		 				camposDisable();
		 				result = $.validity.end();
		 				if(result.valid==false){
		 					return false;
		 				}
		 				var grabar = function(response){
		 					switch(response.status){	 						
		 					    case "success":
		 					    		 ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
		 					    		 modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
		 					    		 // alert("4")
	          					break;
					            case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					            break;
					            default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					            break;
		 					}
		 				}
		 				ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
		 				//view("#contenidoPaciente");
		 			}
		 		}
			}else{ /*******************************************CUANDO ES NACIONAL*****************************************************///

				if($("#frm_nombres").val().length < 2 && $("#frm_nombres").val()!=""){
					$('#frm_nombres').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else if($("#frm_nombres").val()==""){
					$("#frm_nombres").require('Debe Ingresar Nombres');
					$.validity.end();
					return false;
				}else if($("#frm_AP").val()==""){
					$("#frm_AP").require('Debe Ingresar Apellido Paterno');
					$.validity.end();
					return false;
				}else if($("#frm_AP").val().length < 2 && $("#frm_AP").val()!=""){
					$('#frm_AP').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else if($("#frm_AM").val()==""){
					$("#frm_AM").require('Debe Ingresar Apellido Materno');
					$.validity.end();
					return false;
				}else if($("#frm_AM").val().length < 2 && $("#frm_AM").val()!=""){
					$('#frm_AM').assert(false,'Debe Ingresar Mínimo 2 Caracteres');
					$.validity.end();
					return false;
				}else{
					if($("#frm_rut_pac").val()==0){
						// alert("4")
						$("#frm_rut_pac").val(0);
						var  grabarPaciente = function(){
							camposDisable();
							result = $.validity.end();
							if(result.valid==false){
								return false;
							}
							var grabar = function(response){
								switch(response.status){								
									case "success":
											ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
											modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
											// alert("6")

	          					    break;
					                case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					                break;
					                default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					                break;
								}
							}
							ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
							// view("#contenidoPaciente");						
							
						}
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
					}else{
						// alert("5")
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
						modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
					}
				}
				mensaje = "N° de Rut";
				}else{// ACA VALIDAMOS DOCUMENTO EXTRANJERO
					// alert("ddd");
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
							modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo paciente, <b>¿Desea continuar?</b>", grabarPaciente);
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
							case "success": 
									ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
									modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
									// alert("7")
	          				break;
					        case "error":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					        break;
					        default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					        break;
						}
					}
					ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePaciente").serialize()+'&numeroDocumento='+numeroDocumento+'&tipo='+tipo+'&accion=grabarPaciente', 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
					//view("#contenidoPaciente");
				}
				if(numeroDocumento!=0 || numeroDocumento!=""){
					ajaxRequest("/indice_paciente_2017/controllers/server/Pacientes/main_controller.php","accion=verificaDocumento&numeroDocumento="+numeroDocumento+"&tipo="+tipo+"&tipoDocumento="+tipoDocumento, "POST", "JSON", 1,'Validando '+mensaje, validarDocumento);
				}
			});
	}
		

});
function camposDisable(){
	$("#frm_nroFicha").prop('disabled', false);
}