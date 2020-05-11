$(document).ready(function(){ //(document).ready Inicio
	var Nombre           	= $("#nombre").val();
	var apellidoPa       	= $("#apellidoPa").val();
	var apellidoMa       	= $("#apellidoMa").val();
	var run 	   		 	= $("#run").val();
	var fechaNac   		 	= $("#fechaNac").val();
	var calcularEdad  	 	= $("#calcularEdad").val();
	var sexo       		 	= $("#sexo").val();
	var frm_previsionDau 	= $("#frm_previsionDau").val();
	var idPaciente       	= $("#idPaciente").val();	
	var id_doc_documento 	= $("#id_doc_documento").val();
	// alert(id_doc_documento)
	// var idPaciente = $("#idPaciente").val();
	

	// alert(frm_previsionDau)
	// console.log(	
	// 'Nombre: '+Nombre+
	// ' apellidoPa: '+apellidoPa+
	// ' apellidoMa: '+apellidoMa+
	// ' run: '+run+
	// ' fechaNac: '+fechaNac+
	// ' calcularEdad: '+calcularEdad+
	// ' sexo: '+sexo+
	// ' frm_previsionDau: '+frm_previsionDau
	// );
	
	// alert(Nombre)
	$("#btnGuardarPacienteFonasaEsconder").hide();
	$("#btnGuardarPacienteFonasa").click(function(){ //btnGuardarPacienteFonasa Inicio
		//ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePacienteFonasaAgregar").serialize()+'&accion=grabarPacienteFonasa', 'POST', 'JSON', 1);
		//var  grabarPaciente = function(){
			var grabar = function(response){
				console.log(response);
				switch(response.status){								
					case "success": 
							var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','&accion=permisoAdmision', 'POST', 'JSON', 1);
							$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null );
							ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+response.ultimoID,'#contenidoPaciente','', true); 
							modalMensaje("Paciente registrado", "Paciente Ingresado exitosamente.<br>Se generó # registro del Paciente Nombre: <strong>"+response.id+"</strong>", "success_paciente_agregado", 650, 300);
							if(Nombre){
								
								$('#'+Nombre).val(response.nombres);
							}

							if(apellidoPa){
								
								$('#'+apellidoPa).val(response.apellidoPat);
							}

							if(apellidoMa){
								
								$('#'+apellidoMa).val(response.apellidoMat);
							}

							if(run){
								
								$('#'+run).val(response.rut);
							}

							if(fechaNac){
								
								$('#'+fechaNac).val(response.fechaNac);
							}

							if(calcularEdad){								
								document.getElementById(calcularEdad).innerHTML = response.edadActual;
							}

							if(sexo){								
								var sexoPaciente = response.sexo;							
								$('#'+sexo+' option[value='+sexoPaciente+']').attr('selected', 'selected');	
							}
							
							if(idPaciente){								
								$('#'+idPaciente).val(response.ultimoID);
							}

							if(permiso.permisos !="" && permiso.permisos==854){
								if(response.prevision == ""){
									var previsionPaciente = 4;
									var resp = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
									var select     = document.getElementById(frm_previsionDau);
									for(var i=0;i<resp.length;i++){
										var selected="";
										if (resp[i].id == previsionPaciente)
											selected=" selected ";
										select.options[i] = new Option(resp[i].prevision, resp[i].id);
									}
									$('#'+frm_previsionDau+' option[value='+previsionPaciente+']').attr('selected', 'selected');		
								}else{									
									var resp = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
									var select     = document.getElementById(frm_previsionDau);
									var previsionPaciente = response.prevision;
									for(var i=0;i<resp.length;i++){
										var selected="";
										if (resp[i].id == previsionPaciente)
											selected=" selected ";
										select.options[i] = new Option(resp[i].prevision, resp[i].id);
									}
									$('#'+frm_previsionDau+' option[value='+previsionPaciente+']').attr('selected', 'selected');	
								}
							}else{
								if(frm_previsionDau){
									if(response.prevision == ""){
										var previsionPaciente = 4;									
										var respuesta2 = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
										var select     = document.getElementById(frm_previsionDau);
										for(var i=0;i<respuesta2.length;i++){
											var selected="";
											if (respuesta2[i].id == previsionPaciente)
												selected=" selected ";
											select.options[i] = new Option(respuesta2[i].prevision, respuesta2[i].id);
										}
										$('#'+frm_previsionDau+' option[value='+previsionPaciente+']').attr('selected', 'selected');
									}else{
										var previsionPaciente = response.prevision;
										var respuesta2 = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
										var select     = document.getElementById(frm_previsionDau);
										for(var i=0;i<respuesta2.length;i++){
											var selected="";
											if (respuesta2[i].id == previsionPaciente)
												selected=" selected ";
											select.options[i] = new Option(respuesta2[i].prevision, respuesta2[i].id);
										}
										$('#'+frm_previsionDau+' option[value='+previsionPaciente+']').attr('selected', 'selected');
										// $('#'+frm_previsionDau).prop('disabled', true);
										$('#'+frm_previsionDau).css( 'pointer-events', 'none' );
										$('#'+frm_previsionDau).css('background-color', '#eeeeee');
										
										// var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
										// var idregions = ["0", "1", "2","3"];
										// var select = document.getElementById(frm_previsionDau);
										// for(var i=0;i<regions.length;i++){
										// 	var selected="";
										// 	if (idregions[i] == previsionPaciente)
										// 		selected=" selected ";
										// 	select.options[i] = new Option(regions[i], idregions[i]);
										// }
										//$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
									}
									//$('#'+frm_previsionDau+' option[value='+previsionPaciente+']').attr('selected', 'selected');	
								}
							}

							if(id_doc_documento){
								$('#'+id_doc_documento).val(response.id_doc_documentoDau);
							}



							

							
					break;

					case "noContetar":
					modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
					break;
					case "noContetar":   modalMensaje("Error en el proceso", "Error en la transacción, no se guardo el Paciente, el siguiente error de sistema se ha desplegado:<br><br>"+response.message, "error_paciente_agregado", 500, 300);
					break;
					// default:        modalMensaje("Error generico", response, "error_generico_paciente_agregado", 400, 300);
					break;
				}
			}
			$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
			var rut = $("#frm_rutBeneficiario").val();
				rut = $.Rut.quitarFormato(rut);
				rut = rut.substring(0, rut.length-1);
			ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php',$("#frm_indicePacienteFonasaAgregar").serialize()+'&accion=grabarPacienteFonasa'+'&rut='+rut+'&id='+idPaciente, 'POST', 'JSON', 1,'Guardando Paciente...', grabar);
			//view("#contenidoPaciente");
		//}
		//modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a crear un nuevo Paciente, <b>¿Desea continuar?</b>", grabarPaciente);
	});//FIN btnGuardarPacienteFonasa

	$("#btnGuardarPacienteFonasaCerrarNo").click(function(){ //btnGuardarPacienteFonasaCerrarNo Inicio
		$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
	});//FIN btnGuardarPacienteFonasaCerrarNo 


});//(document).ready Fin


