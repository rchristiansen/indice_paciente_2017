$(document).ready(function(){

	//ESTE DEBE SER EL DETALLE
	validar("#nombrePacienteHjnc"  	,"letras");
	validar("#paternoPacienteHjnc" 	,"letras");
	validar("#maternoPacienteHjnc" 	,"letras");	
	calendarioFonasa("#datePickerRECFonasa");
	validar("#datePickerRECFonasa"        ,"fecha");
	if($("#PacienteFallecido").val()!="S"){
		calendario("#datePickerRECFonasa");
	}	
	//$('#datePickerREC').datepicker();

	$("#btnVolver").click(function(){
		view("#contenidoPaciente");
		$.validity.start();
	});

	//DATOS DE SINCRONIZACION
		var nombreFonasa          = $("#nombreFonasa").val();
		var ApellidoPaternoFonasa = $("#ApellidoPaternoFonasa").val();
		var ApellidoMaternoFonasa = $("#ApellidoMaternoFonasa").val();
		var direccionFonasa       = $("#direccionFonasa").val();
		var previsionFonasa       = $("#previsionFonasa").val();
		var sexoFonasa            = $("#sexoFonasa").val();
		var fechaNac_              = $("#fechaNac").val();
		var calcularEdad          = $("#calcularEdad").val();	

		//bandera
		var frm_llamada          = $("#frm_llamada").val();	
			


	$("#datosFonasa").click(function(){  //Sincronizar con Fonasa		
		var id  = $("#frm_id_paciente").val();			
		var funcion = function miFuncion(){     //FUNCION 2
			// alert("funcion")			
			var recPacFonasa = function(response){	//FUNCION 3	
				//alert("recPacFonasa")
				switch(response.status){
					case "success":
						// if (response.llamada == 'DAU') {
						// 	ajaxContent('/dau/views/modules/admision/admision.php','id='+response.id_paciente,'#contenidoDAU','', true);
						// }

						if(response.llamada == 'IP'){
							ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.id_paciente,'#contenidoPaciente','', true);
							
						}

						// if(response.llamada == 'letnet'){
						// 	document.getElementById("frm_nombres").value     = response.nombres;
						// 	document.getElementById("frm_AP").value          = response.APaterno;
						// 	document.getElementById("frm_AM").value          = response.AMaterno;
						// 	document.getElementById("frm_Naciemito").value   = response.fechaNacimiento;						
						// 	document.getElementById("frm_sexo").value        = response.sexo;
						// 	document.getElementById("frm_direccion").value   = response.direccion;
						// 	document.getElementById("frm_prevision").value   = response.previsionFonasa;
						// 	//document.getElementById("imp_prevision").value        = response.previsionFonasa;
							
						// 	if(response.fechaFonasa || response.horaFonasa || response.folioFonasa){
						// 		$( "#divWarning" ).remove();
						// 		$("#divSuccess").show();
						// 		document.getElementById('fonasaFecha').innerHTML = response.fechaFonasa;
						// 		document.getElementById('fonasaHora').innerHTML  = response.horaFonasa;
						// 		document.getElementById('fonasaFolio').innerHTML = response.folioFonasa;
						// 	}
						// 	var fechaNac;
						// 	fechaNac = response.fechaNacimiento;
						// 	var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','fechaNac='+fechaNac+'&accion=calcularFechaPaciente', 'POST', 'JSON', 1);				
						// 		switch(response.status){
						// 			case "success":  document.getElementById('labelEdad').innerHTML = response.id;												 
						// 			break;
						// 			case   "error":  document.getElementById('labelEdad').innerHTML = "error";  
						// 			break;
						// 			default:         document.getElementById('labelEdad').innerHTML = "error2";
						// 			break;
						// 		}
						// }

						if(nombreFonasa){
							$('#'+nombreFonasa).val(response.nombres);
						}

						if(ApellidoPaternoFonasa){
							$('#'+ApellidoPaternoFonasa).val(response.APaterno);
						}

						if(ApellidoMaternoFonasa){
							$('#'+ApellidoMaternoFonasa).val(response.AMaterno);
						}

						if(direccionFonasa){
							$('#'+direccionFonasa).val(response.direccion);
						}

						if(sexoFonasa){
							if(frm_llamada!=""){								
								$('#'+sexoFonasa).val(response.sexo);
							}else{
								var sexoFonasaPaciente = response.sexo;							
								$('#'+sexoFonasa+' option[value='+sexoFonasaPaciente+']').attr('selected', 'selected'); //select							
							}
						}

						if(previsionFonasa){
							if(frm_llamada!=""){								
								$('#'+previsionFonasa).val(response.previsionFonasa);
							}else{
								var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=permisoAdmision', 'POST', 'JSON', 1);
								var previsionPacienteFonasa = response.previsionFonasa;															
								$('#'+previsionFonasa+' option[value='+previsionPacienteFonasa+']').attr('selected', 'selected'); //select
								
								if(permiso.permisos !="" && permiso.permisos==854){
									// $('#'+previsionFonasa).prop('disabled', false);
									$('#'+previsionFonasa).css( 'pointer-events', 'auto' );									
								}else{
									if(previsionPacienteFonasa == 4){
										// $('#'+previsionFonasa).prop('disabled', false);
										$('#'+previsionFonasa).css( 'pointer-events', 'auto' );
									}else{
										// $('#'+previsionFonasa).prop('disabled', true);
										$('#'+previsionFonasa).css( 'pointer-events', 'none' );
										$('#'+previsionFonasa).css('background-color', '#eeeeee');
									}
								}
							}
							
						}


						if(fechaNac_){							
							$('#'+fechaNac_).val(response.fechaNacimiento);							
						}

						if(calcularEdad){
							//$('#'+calcularEdad).text(response.datosPacientes.datos[0]['fechanac']['fechanacEdadActual']);
							document.getElementById(calcularEdad).innerHTML = response.edadActual; //label
						}	



						
						$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
						$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
					break;

					default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
				}
			}//FIN FUNCION 3
			var rut = $("#frm_beneficiarioRut").val();
			rut=$.Rut.quitarFormato(rut);
			rut = rut.substring(0, rut.length-1);
			// ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','accion=SincronizarFonasa'+'&nombresBen='+$("#frm_beneficiarioNombre").val()+'&apellidoPaternoBen='+$("#frm_beneficiarioPaterno").val()+'&apellidoMaternoBen='+$("#frm_beneficiarioMaterno").val()+'&rutBen='+rut+'&fechaNacimientoBen='+$("#frm_beneficiarioFechaNac").val()+'&sexoBen='+$("#frm_beneficiarioSexo").val()+'&direccionBen='+$("#frm_beneficiarioDireccion").val(), 'POST', 'JSON', 1,'Sincronizando Datos de FONASA a HJNC ...', recPacFonasa);	
			ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php',$("#frm_indicePacienteSincronizarFonasa").serialize()+'&accion=SincronizarFonasa'+'&frm_id_paciente='+id, 'POST', 'JSON', 1,'Sincronizando Datos de FONASA a HJNC ...', recPacFonasa);	
		}//FIN FUNCION 2
		modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a sincronizar los datos de FONASA con los de HJNC, <b>¿Desea continuar?</b>", funcion);	
	});


	var fechaNacdd              = $("#fechaNac").val();

	$("#datosPaciente").click(function(){//Actualizar Paciente Datos HJNC
		var id =$("#frm_id_paciente").val() //caputandp el id
		var llamada =$("#frm_llamada").val() //caputandp el id
		// alert(llamada)

		var funcion = function miFuncion(){ //FUNCION 1				
			var validarPacienteFonasa = function(){ //FUNCION 2
					$.validity.start();
					$("#frm_fechaUpdate").require('Debe Ingresar Fecha de Actualización');
					$("#frm_horaFonasa").require('Debe Ingresar Hora de Actualización');
					// $("#frm_motivo").require('Debe Ingresar Motivo de Actualización');
					//$("#frm_motivo").val(quitarEspacio($("#frm_motivo").val()));
					// if($("#frm_motivo").text() == ""){
					// 	$("#frm_motivo").assert(false,"Debe Ingresar Motivo de Actualización");
					// 	$.validity.end();
					// 	return false;
					// }

					result = $.validity.end();
					if(result.valid==false){
						return false;
					}



					$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null );            // para eliminar modal una vez ejecutada
					$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada

				var funcion2 = function(response){											
						
					switch(response.status){
						case "success":						
						// if (response.llamada == 'DAU') {
						// 	ajaxContent('/dau/views/modules/admision/admision.php','id='+response.id_paciente,'#contenidoDAU','', true);							
						// }

						if(response.llamada == 'IP'){
							ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.id_paciente,'#contenidoPaciente','', true);
						}

						// if(response.llamada == 'letnet'){
						// 	//ajaxContent('/Letnet/view/modules/consultaNueva/AgendarPacienteCN.php','idPaciente='+response.id_paciente,'#AgendarPacienteCN_fonasa','', true);
						// 	document.getElementById("frm_nombres").value   = response.nombres;
						// 	document.getElementById("frm_AP").value        = response.APaterno;
						// 	document.getElementById("frm_AM").value        = response.AMaterno;
						// 	document.getElementById("frm_Naciemito").value = response.fechaNacimiento;
						// 	document.getElementById("frm_prevision").value = response.prevision;
						// 	document.getElementById("frm_sexo").value      = response.sexo;						

						// 	var fechaNac;
						// 	fechaNac = response.fechaNacimiento;
						// 	var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','fechaNac='+fechaNac+'&accion=calcularFechaPaciente', 'POST', 'JSON', 1);				
						// 		switch(response.status){
						// 			case "success":  document.getElementById('labelEdad').innerHTML = response.id;												 
						// 			break;
						// 			case   "error":  document.getElementById('labelEdad').innerHTML = "error";  
						// 			break;
						// 			default:         document.getElementById('labelEdad').innerHTML = "error2";
						// 			break;
						// 		}
								
							
						// }

						if(nombreFonasa){
							$('#'+nombreFonasa).val(response.nombres);
						}

						if(ApellidoPaternoFonasa){
							$('#'+ApellidoPaternoFonasa).val(response.APaterno);
						}

						if(ApellidoMaternoFonasa){
							$('#'+ApellidoMaternoFonasa).val(response.AMaterno);
						}

						if(direccionFonasa){
							if(frm_llamada!=""){

							}else{
								$('#'+direccionFonasa).val(response.direccion);								
							}
						}

						if(previsionFonasa){
							if(frm_llamada!=""){
								$('#'+previsionFonasa).val(response.prevision);
							}else{
								var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=permisoAdmision', 'POST', 'JSON', 1);
								if(permiso.permisos !="" && permiso.permisos==854){
									if(response.prevision == 0 || response.prevision == 2 || response.prevision == 3 || response.prevision == 4 || response.prevision == 1 || response.prevision == 5 || response.prevision == 6 || response.prevision == 7 || response.prevision == 8 || response.prevision == 9 || response.prevision == 10 || response.prevision == 11 || response.prevision == 12 || response.prevision == 13 || response.prevision == 14 || response.prevision == 15 || response.prevision == 16 || response.prevision == 17 || response.prevision == 18 || response.prevision == 19 || response.prevision == 22 || response.prevision == 25 || response.prevision == 26 || response.prevision == 27 || response.prevision == 28 || response.prevision == 30 || response.prevision == 31 || response.prevision == 32 || response.prevision == 34 || response.prevision == 35 || response.prevision == 36 || response.prevision == 37 || response.prevision == 38 || response.prevision == 39 || response.prevision == 40 || response.prevision == 41 || response.prevision == 42 || response.prevision == 43 || response.prevision == 44 || response.prevision == 45 || response.prevision == 46 || response.prevision == 47 || response.prevision == 48 || response.prevision == 49 || response.prevision == 50){
										var previsionPacienteFonasa = response.prevision;
										// alert(previsionPacienteFonasa)
										var respuesta2 = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
										var select     = document.getElementById(previsionFonasa);
										for(var i=0;i<respuesta2.length;i++){
											var selected="";
											if (respuesta2[i].id == previsionPacienteFonasa)
												selected=" selected ";
											select.options[i] = new Option(respuesta2[i].prevision, respuesta2[i].id);
										}
										// $('#'+previsionFonasa).prop('disabled', false);	
										$('#'+previsionFonasa+' option[value='+previsionPacienteFonasa+']').attr('selected', 'selected');
									}
								}else{

									if(response.prevision == 0 || response.prevision == 1 || response.prevision == 2 || response.prevision == 3 || response.prevision == 4 || response.prevision == 5 || response.prevision == 6 || response.prevision == 7 || response.prevision == 8 || response.prevision == 9 || response.prevision == 10 || response.prevision == 11 || response.prevision == 12 || response.prevision == 13 || response.prevision == 14 || response.prevision == 15 || response.prevision == 16 || response.prevision == 17 || response.prevision == 18 || response.prevision == 19 || response.prevision == 22 || response.prevision == 25 || response.prevision == 26 || response.prevision == 27 || response.prevision == 28 || response.prevision == 30 || response.prevision == 31 || response.prevision == 32 || response.prevision == 34 || response.prevision == 35 || response.prevision == 36 || response.prevision == 37 || response.prevision == 38 || response.prevision == 39 || response.prevision == 40 || response.prevision == 41 || response.prevision == 42 || response.prevision == 43 || response.prevision == 44 || response.prevision == 45 || response.prevision == 46 || response.prevision == 47 || response.prevision == 48 || response.prevision == 49 || response.prevision == 50){
										// alert('1')
										var previsionPacienteFonasa = response.prevision;
										// alert(previsionPacienteFonasa)
										var respuesta2 = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
										var select     = document.getElementById(previsionFonasa);
										for(var i=0;i<respuesta2.length;i++){
											var selected="";
											if (respuesta2[i].id == previsionPacienteFonasa)
												selected=" selected ";
											select.options[i] = new Option(respuesta2[i].prevision, respuesta2[i].id);
										}
										if(response.prevision == 4 ){
											alert('prevision == 4');
											// $('#'+previsionFonasa).prop('disabled', false);		
											$('#'+previsionFonasa).css( 'pointer-events', 'auto' );										
										}else{
											alert('prevision != 4');
											// $('#'+previsionFonasa).prop('disabled', true);
											$('#'+previsionFonasa).css( 'pointer-events', 'none' );
											$('#'+previsionFonasa).css('background-color', '#eeeeee');

										}
										alert('response.prevision= '+response.prevision);
										alert('previsionFonasa= '+previsionFonasa);
										// $('#'+previsionFonasa+' option[value='+previsionPacienteFonasa+']').attr('selected', 'selected');	
										$('#'+previsionFonasa+' option[value='+response.prevision+']').attr('selected', 'selected');	

															
									}/*else{
										// alert('2')
										var previsionPacienteFonasa = response.prevision;
										var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
										var idregions = ["0", "1", "2","3"];
										var select = document.getElementById(previsionFonasa);
										for(var i=0;i<regions.length;i++){
											var selected="";
											if (idregions[i] == previsionPacienteFonasa)
												selected=" selected ";
											select.options[i] = new Option(regions[i], idregions[i]);
										}
										$('#'+previsionFonasa).prop('disabled', true);
										$('#'+previsionFonasa+' option[value='+previsionPacienteFonasa+']').attr('selected', 'selected');
									}*/
								}
								// var previsionPacienteFonasa = response.prevision;							
								// $('#'+previsionFonasa+' option[value='+previsionPacienteFonasa+']').attr('selected', 'selected'); //select
								
							}
							
						}

						if(sexoFonasa){
							if(frm_llamada!=""){
								$('#'+sexoFonasa).val(response.sexo);
							}else{
								var sexoFonasaPaciente = response.sexo;							
								$('#'+sexoFonasa+' option[value='+sexoFonasaPaciente+']').attr('selected', 'selected'); //select						
								
							}
						}

						if(fechaNacdd){							
							$('#'+fechaNacdd).val(response.edadInvertida);							
						}	

						if(calcularEdad){
							//$('#'+calcularEdad).text(response.datosPacientes.datos[0]['fechanac']['fechanacEdadActual']);
							document.getElementById(calcularEdad).innerHTML = response.edadActual; //label
						}	

								
											
						break;
						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}								
				}
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php',$("#frm_indicePacienteUpdateHJNC").serialize()+'&accion=actualizarPacienteFonasaHJNC'+"&nombre="+$("#nombrePacienteHjnc").val()+"&AP="+$("#paternoPacienteHjnc").val()+"&AM="+$("#maternoPacienteHjnc").val()+"&fechaNac="+$("#nacimientoHjnc").val()+"&prevision="+$("#prevision option:selected").val()+"&sexo="+$("#sexoHjnc option:selected").val()+"&frm_id_Paciente="+$("#frm_id_paciente").val()+"&frm_idFolio="+$("#frm_idFolio").val()+'&llamada='+llamada, 'POST', 'JSON', 1,'Actualizar Paciente con Datos de HJNC ...', funcion2);								
				//ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php',$("#frm_indicePacienteUpdateHJNC").serialize()+'&accion=actualizarPacienteFonasaHJNC', 'POST', 'JSON', 1,'Actualizar Paciente con Datos de HJNC ...', funcion);		
					

			}//FIN FUNCION 2

		var botones1 = [
			{ id: 'btnGuardar', value: '<i class="fa fa-save" aria-hidden="true"></i> Actualizar', function: validarPacienteFonasa, class: 'btn btn-primary' }
			]
			modalFormulario('Ingrese Motivo de la Actualización','/indice_paciente_2017/views/modules/Fonasa/fonasaUpdateDetalle.php','llamada='+llamada,'#pacienteFonasa','53%','44%',botones1);

		} //FIN FUNCION 1	
		modalConfirmacion("Advertencia", "ATENCIÓN, ¿Desea que los datos del paciente sean actualizado, <b>¿Desea continuar?</b>", funcion);					
	});

	$("#volver1").click(function(){      //Volver al detalle del Paciente
		var id = parseInt($("#FOLIO").text()); //caputandp el id
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+id,'#contenidoPaciente','', true);
	});	
});