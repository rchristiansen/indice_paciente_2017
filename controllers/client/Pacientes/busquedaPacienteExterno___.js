$(document).ready(function(){
	// Enlazar boton.
	enlaceBoton();
	$.validity.start();
	/***************EVENTOS**************/
	tabla("#table_pacienteExterno");
	validar("#frm_id_paciente"      ,"numero");
	validar("#frm_documentoExterno"          	,"rut");
	// validar("#frm_documentoExterno" 	,"numero");
	validar("#frm_nroFichaExterno"     	,"numero");
	validar("#frm_APaternoExterno"           	,"letras");
	validar("#frm_AMaternoExterno"           	,"letras");
	validar("#frm_nombresDosExterno"      	,"letras");

	var datos = "";
	
	var sistemaExterno  = $("#sistemaExterno").val();
	if (sistemaExterno != "") {
		datos += '&sistemaExterno='+sistemaExterno;
	}		
	var fonasa          = $("#fonasa").val();		
	if (fonasa != "") {
		datos += '&fonasa='+fonasa;
	}		
	var nombre          = $("#nombre").val();
	if (nombre != "") {
		datos += '&nombre='+nombre;
	}		
	var run             = $("#run").val();
	if (run != "") {
		datos += '&run='+run;
	}		
	var ficha           = $("#ficha").val();
	if (ficha != "") {
		datos += '&ficha='+ficha;
	}		
	var ApellidoPaterno = $("#ApellidoPaterno").val();
	if (ApellidoPaterno != "") {
		datos += '&ApellidoPaterno='+ApellidoPaterno;
	}		
	var ApellidoMaterno = $("#ApellidoMaterno").val();
	if (ApellidoMaterno != "") {
		datos += '&ApellidoMaterno='+ApellidoMaterno;
	}		
	var fechaNac        = $("#fechaNac").val();
	if (fechaNac != "") {
		datos += '&fechaNac='+fechaNac;
	}		
	var calcularEdad    = $("#calcularEdad").val();
	if (calcularEdad != "") {
		datos += '&calcularEdad='+calcularEdad;
	}		
	var sexo            = $("#sexo").val();
	if (sexo != "") {
		datos += '&sexo='+sexo;
	}		
	var etnia           = $("#etnia").val();
	if (etnia != "") {
		datos += '&etnia='+etnia;
	}
	var paisNacimiento = $("#paisNacimiento").val();
	if (paisNacimiento != "") {
		datos += '&paisNacimiento='+paisNacimiento;
	}			
	var ctp             = $("#ctp").val();
	if (ctp != "") {
		datos += '&ctp='+ctp;
	}		
	var nac             = $("#nac").val();
	if (nac != "") {
		datos += '&nac='+nac;
	}		
	var domicilio       = $("#domicilio").val();
	if (domicilio != "") {
		datos += '&domicilio='+domicilio;
	}		
	var correo          = $("#correo").val();
	if (correo != "") {
		datos += '&correo='+correo;
	}		
	var telefonoCelular = $("#telefonoCelular").val();
	if (telefonoCelular != "") {
		datos += '&telefonoCelular='+telefonoCelular;
	}		
	var telefonoFijo    = $("#telefonoFijo").val();
	if (telefonoFijo != "") {
		datos += '&telefonoFijo='+telefonoFijo;
	}		
	var prevision       = $("#prevision").val();
	if (prevision != "") {
		datos += '&prevision='+prevision;
	}		
	var formaPago       = $("#formaPago").val();
	if (formaPago != "") {
		datos += '&formaPago='+formaPago;
	}		
	var idPaciente      = $("#idPaciente").val();
	if (idPaciente != "") {
		datos += '&idPaciente='+idPaciente;
	}

	var pacienteFall      = $("#pacienteFall").val();	
	if (pacienteFall != "") {
		datos += '&pacienteFall='+pacienteFall;
	}

	var tipoDocumentoLabel      = $("#tipoDocumentoLabel").val();	
	if (tipoDocumentoLabel != "") {
		datos += '&tipoDocumentoLabel='+tipoDocumentoLabel;
	}

	var doc_documento      = $("#doc_documento").val();		
	if (doc_documento != "") {
		datos += '&doc_documento='+doc_documento;
	}

	var PACafro      = $("#PACafro").val();		
	if (PACafro != "") {
		datos += '&PACafro='+PACafro;
	}

	//egs 13-04-2018
	var comuna      = $("#comuna").val();
	if (comuna != "") {
		datos += '&comuna='+comuna;
	}
	//egs 13-04-2018

	var region      = $("#region").val();
	if (region != "") {
		datos += '&region='+region;
	}

	var ciudad      = $("#ciudad").val();
	if (ciudad != "") {
		datos += '&ciudad='+ciudad;
	}

	var calle      = $("#calle").val();
	if (calle != "") {
		datos += '&calle='+calle;
	}

	var numero    = $("#numero").val();
	if (numero != "") {
		datos += '&numero='+numero;
	}

	var sector    = $("#sector").val();
	if (sector != "") {
		datos += '&sector='+sector;
	}

	var prais    = $("#prais").val();
	if (prais != "") {
		datos += '&prais='+prais;
	}
	


	$("#btnNuevoPaciente").click(function(){
		$.validity.start();
		result = $.validity.end();
		if(result.valid==false){
			return false;
		}
		var fonasa 		  = $("#fonasa").val();
		// var doc_documento = $("#doc_documento").val();		
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/agregarPaciente.php','sistemaExterno='+sistemaExterno+'&nombres=frm_nombres_dau&run=frm_rut&AP=frm_AP_dau&AM=frm_AM_dau&fechaNac=frm_Naciemito&calcularEdad=labelEdad&sexo=frm_sexo&etnia=frm_etnia&cap=frm_centroAtencion&nac=frm_Nacionalidad&direccion=frm_direccion&correo=frm_correo&telefonoCelular=frm_telefonoCelular&telefonoCelularFijo=frm_telefonoFijo&prevision=frm_prevision&prevision=frm_prevision&formaPago=frm_formaPago&idPaciente=idPacienteDau&pacienteFall=pacienteFallDau&fonasa='+fonasa+'&tipoDocumentoLabel=tipoDocumentoDau&doc_documento=id_doc_documentoDau&afrodescendiente=frm_afrodescendiente&prais=frm_prais&paisNacimiento=frm_pais_nacimiento&region=frm_region&ciudad=frm_ciudad&comuna=frm_comuna&calle=frm_nombreCalle&numeroDireccion=frm_numeroDireccion&restoDireccion=frm_direccion&sector=frm_sectorDomicilio&otrosTelefonos=frm_otrosTelefonos','#contenidoPaciente','', true); 
	});

	$("#btnBuscarPacienteExterno").click(function(){		
		clearDataTable("table_pacienteExterno");
		$.validity.start();
		//var result;
		if($("#frm_documentoExterno").val()!=""){
			if($('#documento option:selected').val()==1){
				var rutValido= $.Rut.validar($("#frm_documentoExterno").val());
				if(rutValido==false){
					$('#frm_documentoExterno').assert(false,'El Run Ingresado, no es valido');
				}
			}
		}

		$('#frm_APaternoExterno').val(quitarEspacio($('#frm_APaternoExterno').val()));
		if($("#frm_APaternoExterno").val().length < 2 && $("#frm_APaternoExterno").val()!=""){
			$('#frm_APaternoExterno').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		$('#frm_AMaternoExterno').val(quitarEspacio($('#frm_AMaternoExterno').val()));
		if($("#frm_AMaternoExterno").val().length < 2 && $("#frm_AMaternoExterno").val()!=""){
			$('#frm_AMaternoExterno').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		$('#frm_nombresDosExterno').val(quitarEspacio($('#frm_nombresDosExterno').val()));
		if($("#frm_nombresDosExterno").val().length < 2 && $("#frm_nombresDosExterno").val()!=""){
			$('#frm_nombresDosExterno').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		if($("#frm_nroFichaExterno").val()==0 && $("#frm_nroFichaExterno").val()!=""){
			$('#frm_nroFichaExterno').assert(false,"Debe Buscar un Nro Distinto a 0");
		}

		// if($("#frm_rut").val()==0 && $("#frm_rut").val()!=""){
		// 	$('#frm_rut').assert(false,"Debe Buscar un Nro Distinto a 0");
		// }

		if($("#frm_documentoExterno").val()==0 && $("#frm_documentoExterno").val()!=""){
			$('#frm_documentoExterno').assert(false,"Debe Buscar un Nro Distinto a 0");
		}

		// if($("#frm_id_paciente").val()==0 && $("#frm_id_paciente").val()!=""){
		// 		$('#frm_id_paciente').assert(false,"Debe Buscar un Nro Distinto a 0");
		// }

		result = $.validity.end();
		if(result.valid==false){
			return false;
		}

		if($('#documento option:selected').val()==1){
			var rut = $("#frm_documentoExterno").val();
			rut     = $.Rut.quitarFormato(rut);
			rut     = rut.substring(0, rut.length-1);

			if( $('#frm_documentoExterno').val()!='' || $('#frm_nroFichaExterno').val()!='' || $('#frm_APaternoExterno').val()!='' || $('#frm_AMaternoExterno').val()!='' || $('#frm_nombresDosExterno').val()!='' ){
				$("#frm_documentoExterno").val("");	
				// alert(datos)
				ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_rut='+rut+datos,'#contenidoPaciente','', true);
			}
		}else{
			if($('#documento option:selected').val()==2){						
				if( $('#frm_documentoExterno').val()!='' || $('#frm_nroFichaExterno').val()!='' || $('#frm_APaternoExterno').val()!='' || $('#frm_AMaternoExterno').val()!='' || $('#frm_nombresDosExterno').val()!='' ){

					ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_documentoExterno='+$("#frm_documentoExterno").val()+datos,'#contenidoPaciente','', true);

					// ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_rut='+rut+'&sistemaExterno='+sistemaExterno+"&fonasa="+fonasa+'&nombre='+nombre+'&run='+run+'&ficha='+ficha+'&ApellidoPaterno='+ApellidoPaterno+'&ApellidoMaterno='+ApellidoMaterno+'&fechaNac='+fechaNac+'&labelEdad='+labelEdad+'&sexo='+sexo+'&etnia='+etnia+'&ctp='+ctp+'&nac='+nac+'&domicilio='+domicilio+'&correo='+correo+'&telefonoCelular='+telefonoCelular+'&telefonoFijo='+telefonoFijo+'&prevision='+prevision+'&formaPago='+formaPago+'&idPaciente='+idPaciente,'#contenidoPaciente','', true);

					// if(sistemaExterno == "DAU"){
					// 	ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_rut='+rut+'&sistemaExterno='+sistemaExterno+"&fonasa="+fonasa+'&nombre='+nombre+'&run='+run+'&ficha='+ficha+'&ApellidoPaterno='+ApellidoPaterno+'&ApellidoMaterno='+ApellidoMaterno+'&fechaNac='+fechaNac+'&labelEdad='+labelEdad+'&sexo='+sexo+'&etnia='+etnia+'&ctp='+ctp+'&nac='+nac+'&domicilio='+domicilio+'&correo='+correo+'&telefonoCelular='+telefonoCelular+'&telefonoFijo='+telefonoFijo+'&prevision='+prevision+'&formaPago='+formaPago+'&idPaciente='+idPaciente,'#contenidoPaciente','', true);					
					// }

					// if(sistemaExterno == "pharmanet"){
					// 	ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_rut='+rut+'&sistemaExterno='+sistemaExterno+"&fonasa="+fonasa+'&nombre='+nombre+'&run='+run+'&ficha='+ficha,'#contenidoPaciente','', true);					
					// }	



					// alert("sin rut")
					// ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php',$("#frm_indice_pacienteExterno").serialize()+'&frm_nroDocumento='+$("#frm_nroDocumento").val()+'&sistemaExterno='+sistemaExterno+"&fonasa="+fonasa+'&nombre='+nombre+'&run='+run+'&ficha='+ficha+'&ApellidoPaterno='+ApellidoPaterno+'&ApellidoMaterno='+ApellidoMaterno+'&fechaNac='+fechaNac+'&labelEdad='+labelEdad+'&sexo='+sexo+'&etnia='+etnia+'&ctp='+ctp+'&nac='+nac+'&domicilio='+domicilio+'&correo='+correo+'&telefonoCelular='+telefonoCelular+'&telefonoFijo='+telefonoFijo+'&prevision='+prevision+'&formaPago='+formaPago+'&idPaciente='+idPaciente,'#contenidoPaciente','', true);				
				}
			}
		}
	});
	
	

	
	

	
	
	

	if(fonasa == 0){
		$("#table_pacienteExterno").on('click','.externo',function() {
			// alert($('#sistemaExterno').val());
			
			var id       = $(this).attr('id');
			var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=sistemaExterno', 'POST', 'JSON', 1);

			if($('#sistemaExterno').val() == 'atencionAPS'){
				// let run_aps = response.datosPacientes.datos[0]['rutFormateado'];
				let id_aps = response.datosPacientes.datos[0]['id'];
				// idPaciente_receta
				// cargarContenido('views/paciente/adjuntar_imagenes_rayos.php','run='+run_aps,'#divcontenido');
				cargarContenido('views/paciente/adjuntar_imagenes_rayos.php','id='+id_aps,'#divcontenido');
				// $('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
				// return false;
			}

			switch(response.status){
				case "success":
					$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
					var nombreCompleto = response.datosPacientes.datos[0]['nombres']+" "+response.datosPacientes.datos[0]['apellidopat']+" "+response.datosPacientes.datos[0]['apellidomat'];
					//egs 13-04-2018
					if(sistemaExterno == 'leq'){
						if(nombre){
							$('#'+nombre).val(response.datosPacientes.datos[0]['nombres']);
						}
					}else{
						if(nombre){
							$('#'+nombre).val(nombreCompleto);
						}						
					}
					//egs 13-04-2018


					if(idPaciente){	 						
						$('#'+idPaciente).val(response.datosPacientes.datos[0]['id']);
						$('#limpiarBusquedaPaciente').show();
					}

					if(response.datosPacientes.datos[0]['extranjero'] == "S"){
						$('#'+run).val(response.datosPacientes.datos[0]['rut_extranjero']);
					}else{
						if(run){
							$('#'+run).val(response.datosPacientes.datos[0]['rutFormateado']);						
						}						
					}


					if(ficha){
						$('#'+ficha).val(response.datosPacientes.datos[0]['nroficha']);	
					}

					if(ApellidoPaterno){
						$('#'+ApellidoPaterno).val(response.datosPacientes.datos[0]['apellidopat']);
					}

					if(ApellidoMaterno){
						$('#'+ApellidoMaterno).val(response.datosPacientes.datos[0]['apellidomat']);
					}


					if(fechaNac){
						$('#'+fechaNac).val(response.datosPacientes.datos[0]['fechanac']);							
					}

					if(calcularEdad){						
						document.getElementById(calcularEdad).innerHTML = response.datosPacientes.datos[0]['fechanacEdadActual']; //label
					}

					if(sexo){
						var sexoPaciente = response.datosPacientes.datos[0]['sexo'];							
						$('#'+sexo+' option[value='+sexoPaciente+']').attr('selected', 'selected');							
					}

					if(etnia){
						var etniaPaciente = response.datosPacientes.datos[0]['etnia'];							
						$('#'+etnia+' option[value='+etniaPaciente+']').attr('selected', 'selected');							
					}

					if(ctp){
						var ctpPaciente = response.datosPacientes.datos[0]['centroatencionprimaria'];							
						$('#'+ctp+' option[value='+ctpPaciente+']').attr('selected', 'selected');							
					}

					if(nac){
						var nacPaciente = response.datosPacientes.datos[0]['nacionalidad'];							
						$('#'+nac+' option[value='+nacPaciente+']').attr('selected', 'selected'); //select							
					}

					if(domicilio){
						$('#'+domicilio).val(response.datosPacientes.datos[0]['direccion']);
					}

					if(correo){
						$('#'+correo).val(response.datosPacientes.datos[0]['email']); //input
					}

					if(telefonoCelular){
						$('#'+telefonoCelular).val(response.datosPacientes.datos[0]['fono1']); //input
					}

					if(telefonoFijo){
						$('#'+telefonoFijo).val(response.datosPacientes.datos[0]['PACfono']); //input
					}

					if(prevision){
						var previsionPaciente = response.datosPacientes.datos[0]['prevision'];							
						$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select							
					}

					if(formaPago){
						var formaPagoPaciente = response.datosPacientes.datos[0]['conveniopago'];							
						$('#'+formaPago+' option[value='+formaPagoPaciente+']').attr('selected', 'selected'); //select							
					}

					//egs 13-04-2018
					if(comuna){
						var comunaPaciente = response.datosPacientes.datos[0]['idcomuna'];
						$('#'+comuna+' option[value='+comunaPaciente+']').attr('selected', 'selected'); //select	
					}
					//egs 13-04-2018
					
				break;
			}
		});
	}

	 if(fonasa == 1){
		
		if($('#table_pacienteExterno tr').length == 2 && $("#table_pacienteExterno .externo").attr('id') != undefined ){
			var id       = $("#table_pacienteExterno .externo").attr('id'); 
			buscarPacienteExterno(id);
		}
		else{
			$("#table_pacienteExterno").on('click','.externo',function() {
				var id       = $(this).attr('id');
				buscarPacienteExterno(id);
			});
		}
		// else{
 		// $("#table_pacienteExterno").on('click','.externo',function() {
		// 	buscarPacienteExterno();
	 			
		//  });
		// }
	 }

	// if(fonasa == 1){
	// 	$("#table_pacienteExterno").on('click','.externo',function() {
	// 		var id       = $(this).attr('id');
	// 		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=calcularHoraDif', 'POST', 'JSON', 1);
	// 		switch(response.fonasa){
	// 			case "successPrevisionNoRegistra":
	// 				var funcion = function(response){ //FUNCION 2
	// 					switch(response.status){
	// 						case "success":
	// 						modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&url='+url+'&div='+div,'#pacienteFonasaCertificado','80%','auto','');
	// 						break;

	// 						case "noContetar":
	// 						modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
	// 						break;
	// 						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
	// 					}
	// 				}//FIN FUNCION 2
	// 				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);
	// 				// ajaxContent(raiz+url, 'id='+id,'#'+div,'', true);
	// 			break;

	// 			case "successPrevisionRegistrada":
	// 				var funcion = function(response){ //FUNCION 2
	// 					switch(response.status){
	// 						case "success":
	// 						modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&url='+url+'&div='+div,'#pacienteFonasaCertificado','80%','auto','');
	// 						break;

	// 						case "noContetar":
	// 						modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
	// 						break;
	// 						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
	// 					}
	// 				}//FIN FUNCION 2
	// 				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);
	// 				// ajaxContent(raiz+url, 'id='+id,'#'+div,'', true);
	// 			break;

	// 			case "successPrevisionRestringida":
	// 				// alert("successPrevisionRestringida");
	// 				ajaxContent(raiz+url, 'id='+id,'#'+div,'', true);
	// 			break;
	// 		}
	// 	});
	// }


	$("#btnEliminarFiltrosPaEx").click(function(){
			$("#frm_documentoExterno").val("");
			$("#frm_nroFichaExterno").val("");
			$("#frm_APaternoExterno").val("");
			$("#frm_AMaternoExterno").val("");
			$("#frm_nombresDosExterno").val("");
			// $( "#table_paciente" ).remove();
			$("#btnEliminarFiltrosPaEx" ).hide();
			$("#table_pacienteExterno_wrapper" ).hide();
			$("#table_paciente_info" ).hide();
			$("#table_paciente_paginate" ).hide();
	});



	$('#documento').change(function(){
		if($('#documento option:selected').val()==1){
			$("#frm_documentoExterno").Rut({
				on_error: function(){
					return false;
				},
				on_success: function(){

				},
				format_on: 'keyup'
			});
		}else{
			$("#frm_documentoExterno").off();
			validar("#frm_documentoExterno"          	,"letras_numeros");
		}
	});
	$('#documento').change();


	//Función para verificar si existe salida a internet
	function exiteConexionInternet() {
		if(navigator.onLine){
			return true;
		}
		else{
			return false;
		}
	}

	//Función para buscar paciente (por sistema externo)
	function buscarPacienteExterno(id){
		//var id       = $("#table_pacienteExterno .externo").attr('id'); 		
		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=sistemaExterno', 'POST', 'JSON', 1);

		if(response.datosPacientes.datos[0]['extranjero']=="S"){
			// alert("1")
			switch(response.status){
				case "success":	 	
					$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad					
					var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=permisoAdmision', 'POST', 'JSON', 1);
					if(tipoDocumentoLabel){
						var tipoDocumento;
						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 1){
							var tipoDocumento = "DNI";
						}

						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 2){
							var tipoDocumento = "PASAPORTE";
						}

						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 3){
							var tipoDocumento = "OTROS";
						}					
						document.getElementById(tipoDocumentoLabel).innerHTML = tipoDocumento; //label
					}

					if(doc_documento){
						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 1){
							$('#'+doc_documento).val(1);
						}

						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 2){
							$('#'+doc_documento).val(2);
						}

						if(response.datosPacientes.datos[0]['id_doc_extranjero'] == 3){
							$('#'+doc_documento).val(3);
						}
					}

					if(idPaciente){	 						
						$('#'+idPaciente).val(response.datosPacientes.datos[0]['id']);
					}

					if(response.datosPacientes.datos[0]['fallecido']=="S"){
						// alert("hola")
						if(pacienteFall){								
							$('#'+pacienteFall).val(response.datosPacientes.datos[0]['fallecido']);
						}							
					}else{
						$('#'+pacienteFall).val("");
					}

					if(nombre){
						$('#'+nombre).val(response.datosPacientes.datos[0]['nombres']);						
					}

					if(response.datosPacientes.datos[0]['extranjero'] == "S"){
						$('#'+run).val(response.datosPacientes.datos[0]['rut_extranjero']);
					}

					if(ApellidoPaterno){
						$('#'+ApellidoPaterno).val(response.datosPacientes.datos[0]['apellidopat']);
					}

					if(ApellidoMaterno){
						$('#'+ApellidoMaterno).val(response.datosPacientes.datos[0]['apellidomat']);
					}

								
					if(fechaNac){
						$('#'+fechaNac).val(response.datosPacientes.datos[0]['fechanac']);							
					}

					if(calcularEdad){
						//$('#'+calcularEdad).text(response.datosPacientes.datos[0]['fechanac']['fechanacEdadActual']);
						document.getElementById(calcularEdad).innerHTML = response.datosPacientes.datos[0]['fechanacEdadActual']; //label
					}

					if(sexo){
						// var sexoPaciente = response.datosPacientes.datos[0]['sexo'];							
						// $('#'+sexo+' option[value='+sexoPaciente+']').attr('selected', 'selected');	
						$('#'+sexo).val(response.datosPacientes.datos[0]['sexo']);							
					}

					if(paisNacimiento){
						// var paisNacimientoPaciente = response.datosPacientes.datos[0]['paisNacimiento'];						
						// $('#'+paisNacimiento+' option[value='+paisNacimientoPaciente+']').attr('selected', 'selected');
						$('#'+paisNacimiento).val(response.datosPacientes.datos[0]['paisNacimiento']);							
					}

					

					if(etnia){
						// var etniaPaciente = response.datosPacientes.datos[0]['etnia'];							
						// $('#'+etnia+' option[value='+etniaPaciente+']').attr('selected', 'selected');
						$('#'+etnia).val(response.datosPacientes.datos[0]['etnia']);							
					}

					if(ctp){
						// var ctpPaciente = response.datosPacientes.datos[0]['centroatencionprimaria'];							
						// $('#'+ctp+' option[value='+ctpPaciente+']').attr('selected', 'selected');
						$('#'+ctp).val(response.datosPacientes.datos[0]['centroatencionprimaria']);								
					}

					if(nac){
						// var nacPaciente = response.datosPacientes.datos[0]['nacionalidad'];							
						// $('#'+nac+' option[value='+nacPaciente+']').attr('selected', 'selected'); //select
						$('#'+nac).val(response.datosPacientes.datos[0]['nacionalidad']);								
					}

					if(domicilio){
						$('#'+domicilio).val(response.datosPacientes.datos[0]['direccion']);
					}

					if(correo){
						$('#'+correo).val(response.datosPacientes.datos[0]['email']); //input
					}

					if(telefonoCelular){
						$('#'+telefonoCelular).val(response.datosPacientes.datos[0]['fono1']); //input
					}

					if(telefonoFijo){
						$('#'+telefonoFijo).val(response.datosPacientes.datos[0]['PACfono']); //input
					}

					if(PACafro){
						// var afrodescendiente = response.datosPacientes.datos[0]['PACafro'];		
						// $('#'+PACafro+' option[value='+afrodescendiente+']').attr('selected', 'selected');	
						$('#'+PACafro).val(response.datosPacientes.datos[0]['PACafro']);						
					}



					if(permiso.permisos !="" && permiso.permisos==854){
									
						if(prevision){
							var previsionPaciente = response.datosPacientes.datos[0]['prevision'];
							var respuesta1        = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
							var select    = document.getElementById(prevision);
							for(var i=0;i<respuesta1.length;i++){
								var selected="";
								if (respuesta1[i].id == previsionPaciente)
									selected=" selected ";
									select.options[i] = new Option(respuesta1[i].prevision, respuesta1[i].id);
								}

								$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected');
							}
						}else{
							if(prevision){
								var previsionPaciente = response.datosPacientes.datos[0]['prevision'];
								if(previsionPaciente == 0 || previsionPaciente == 1 || previsionPaciente == 2 || previsionPaciente == 3 ||previsionPaciente == 4 || previsionPaciente == 5 || previsionPaciente == 6 || previsionPaciente == 7 || previsionPaciente == 8 || previsionPaciente == 9 || previsionPaciente == 10 || previsionPaciente == 11 || previsionPaciente == 12 || previsionPaciente == 13 || previsionPaciente == 14 || previsionPaciente == 15 || previsionPaciente == 16 || previsionPaciente == 17 || previsionPaciente == 18 || previsionPaciente == 19 || previsionPaciente == 22 || previsionPaciente == 25 || previsionPaciente == 26 || previsionPaciente == 27 || previsionPaciente == 28 || previsionPaciente == 30 || previsionPaciente == 31 || previsionPaciente == 32 || previsionPaciente == 34 || previsionPaciente == 35 || previsionPaciente == 36 || previsionPaciente == 37 || previsionPaciente == 38 || previsionPaciente == 39 || previsionPaciente == 40 || previsionPaciente == 41 || previsionPaciente == 42 || previsionPaciente == 43 || previsionPaciente == 44 || previsionPaciente == 45 || previsionPaciente == 46 || previsionPaciente == 47 || previsionPaciente == 48 || previsionPaciente == 49 || previsionPaciente == 50){
									var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
									var select    = document.getElementById(prevision);
									for(var i=0;i<respuesta.length;i++){
										var selected="";
										if (respuesta[i].id == previsionPaciente)
											selected=" selected ";
											select.options[i] = new Option(respuesta[i].prevision, respuesta[i].id);
										}
									$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected');	
									// $('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select	
									// var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisionesSinFonasa', 'POST', 'JSON', 1);																
									// console.log(respuesta)
									// for (var i=0; i<respuesta.length; i++) {
									// 	$(prevision).append('<option value="' + respuesta[i].id + '">' + respuesta[i].prevision + '</option>');
									// }
									// $('#'+prevision).prop('disabled', true);
									$('#'+prevision).css( 'pointer-events', 'none' );
									$('#'+prevision).css('background-color', '#eeeeee');
								}else{
									// $(prevision)[0].disabled = true;
									var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
									var idregions = ["0", "1", "2","3"];
									var select = document.getElementById(prevision);
									for(var i=0;i<regions.length;i++){
										var selected="";
										if (idregions[i] == previsionPaciente)
											selected=" selected ";
											select.options[i] = new Option(regions[i], idregions[i]);
										}
									$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
									// $('#'+prevision).prop('disabled', true);
									$('#'+prevision).css( 'pointer-events', 'none' );
									$('#'+prevision).css('background-color', '#eeeeee');
									//$(prevision).attr('disabled', true);
								}							
							}
						}

						if(formaPago){
							var formaPagoPaciente = response.datosPacientes.datos[0]['conveniopago'];							
							$('#'+formaPago+' option[value='+formaPagoPaciente+']').attr('selected', 'selected'); //select							
						}

						break;
			}
		}else{
			// alert("2")
			switch(response.status){
				case "success":
					$('#modal_indicePacienteExterno').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
					var permiso = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=permisoAdmision', 'POST', 'JSON', 1);
														
					if(idPaciente){	 						
						$('#'+idPaciente).val(response.datosPacientes.datos[0]['id']);
					}

					if(doc_documento){								
						$('#'+doc_documento).val(0);								
					}

					if(response.datosPacientes.datos[0]['fallecido']=="S"){
						// alert("hola")
						if(pacienteFall){								
							$('#'+pacienteFall).val(response.datosPacientes.datos[0]['fallecido']);
						}							
					}else{
						$('#'+pacienteFall).val("");
					}

					if(nombre){
						$('#'+nombre).val(response.datosPacientes.datos[0]['nombres']);						
					}

					if(response.datosPacientes.datos[0]['extranjero'] == "S"){
						$('#'+run).val(response.datosPacientes.datos[0]['rut_extranjero']);
					}else{
						if(run){
							$('#'+run).val(response.datosPacientes.datos[0]['rutFormateado']);						
						}						
					}

					if(ApellidoPaterno){
						$('#'+ApellidoPaterno).val(response.datosPacientes.datos[0]['apellidopat']);
					}

					if(ApellidoMaterno){
						$('#'+ApellidoMaterno).val(response.datosPacientes.datos[0]['apellidomat']);
					}

					if(fechaNac){
						$('#'+fechaNac).val(response.datosPacientes.datos[0]['fechanac']);							
					}

					if(calcularEdad){
						//$('#'+calcularEdad).text(response.datosPacientes.datos[0]['fechanac']['fechanacEdadActual']);
						document.getElementById(calcularEdad).innerHTML = response.datosPacientes.datos[0]['fechanacEdadActual']; //label
					}

					if(sexo){
						//var sexoPaciente = response.datosPacientes.datos[0]['sexo'];							
						//$('#'+sexo+' option[value='+sexoPaciente+']').attr('selected', 'selected');	
						$('#'+sexo).val(response.datosPacientes.datos[0]['sexo']);						
					}

					if(etnia){
						//var etniaPaciente = response.datosPacientes.datos[0]['etnia'];							
						//$('#'+etnia+' option[value='+etniaPaciente+']').attr('selected', 'selected');	
						$('#'+etnia).val(response.datosPacientes.datos[0]['etnia']);						
					}

					if(paisNacimiento){
						// var paisNacimientoPaciente = response.datosPacientes.datos[0]['paisNacimiento'];		
						// $('#'+paisNacimiento+' option[value='+paisNacimientoPaciente+']').attr('selected', 'selected');
						$('#'+paisNacimiento).val(response.datosPacientes.datos[0]['paisNacimiento']);							
					}

					if(ctp){
						// var ctpPaciente = response.datosPacientes.datos[0]['centroatencionprimaria'];							
						// $('#'+ctp+' option[value='+ctpPaciente+']').attr('selected', 'selected');
						$('#'+ctp).val(response.datosPacientes.datos[0]['centroatencionprimaria']);							
					}

					if(nac){
						// var nacPaciente = response.datosPacientes.datos[0]['nacionalidad'];							
						// $('#'+nac+' option[value='+nacPaciente+']').attr('selected', 'selected'); //select	
						$('#'+nac).val(response.datosPacientes.datos[0]['nacionalidad']);					
					}

					if(domicilio){
						$('#'+domicilio).val(response.datosPacientes.datos[0]['restodedireccion']);
					}

					if(correo){
						$('#'+correo).val(response.datosPacientes.datos[0]['email']); //input
					}

					if(telefonoCelular){
						$('#'+telefonoCelular).val(response.datosPacientes.datos[0]['fono1']); //input
					}

					if(telefonoFijo){
						$('#'+telefonoFijo).val(response.datosPacientes.datos[0]['PACfono']); //input
					}

					if(PACafro){
						// var afrodescendientePaciente = response.datosPacientes.datos[0]['PACafro'];	
						// $('#'+PACafro+' option[value='+afrodescendientePaciente+']').attr('selected', 'selected');
						$('#'+PACafro).val(response.datosPacientes.datos[0]['PACafro']);							
					}

					if(sistemaExterno == 'DAU'){
						if(region){
							$('#'+region).val(response.datosPacientes.datos[0]['region']);
						}

						if(ciudad){
							obtenerValorCiudad(response.datosPacientes.datos[0]['ciudad']);	
						}
						
						if(comuna){
							//$('#'+comuna).val(response.datosPacientes.datos[0]['idcomuna']);
							obtenerValorComuna(response.datosPacientes.datos[0]['idcomuna']);	
						}
					}

					if(calle){
						$('#'+calle).val(response.datosPacientes.datos[0]['calle']);
					}

					if(numero){
						$('#'+numero).val(response.datosPacientes.datos[0]['numero']);
					}

					if(sector){
						$('#'+sector).val(response.datosPacientes.datos[0]['sector_domicilio']);
					}

					if(prais){
						if (response.datosPacientes.datos[0]['prais']==null) {response.datosPacientes.datos[0]['prais']="0";}
						$('#'+prais).val(response.datosPacientes.datos[0]['prais']);
					}

					if(prevision){
						//var previsionPaciente = response.datosPacientes.datos[0]['prevision'];							
						//$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select	
						$('#'+prevision).val(response.datosPacientes.datos[0]['prevision']);	
												
					}

					if(permiso.permisos !="" && permiso.permisos==854){
						if(prevision){
							var previsionPaciente = response.datosPacientes.datos[0]['prevision'];
							var respuesta1        = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
							var select    = document.getElementById(prevision);
							for(var i=0;i<respuesta1.length;i++){
								var selected="";
								if (respuesta1[i].id == previsionPaciente)
									selected=" selected ";
									select.options[i] = new Option(respuesta1[i].prevision, respuesta1[i].id);
								}
							$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected');
						}
					}else{
						if(prevision){
							var previsionPaciente = response.datosPacientes.datos[0]['prevision'];
							if(previsionPaciente == 0 || previsionPaciente == 1 || previsionPaciente == 2 || previsionPaciente == 3 || previsionPaciente == 4 || previsionPaciente == 5 || previsionPaciente == 6 || previsionPaciente == 7 || previsionPaciente == 8 || previsionPaciente == 9 || previsionPaciente == 10 || previsionPaciente == 11 || previsionPaciente == 12 || previsionPaciente == 13 || previsionPaciente == 14 || previsionPaciente == 15 || previsionPaciente == 16 || previsionPaciente == 17 || previsionPaciente == 18 || previsionPaciente == 19 || previsionPaciente == 22 || previsionPaciente == 25 || previsionPaciente == 26 || previsionPaciente == 27 || previsionPaciente == 28 || previsionPaciente == 30 || previsionPaciente == 31 || previsionPaciente == 32 || previsionPaciente == 34 || previsionPaciente == 35 || previsionPaciente == 36 || previsionPaciente == 37 || previsionPaciente == 38 || previsionPaciente == 39 || previsionPaciente == 40 || previsionPaciente == 41 || previsionPaciente == 42 || previsionPaciente == 43 || previsionPaciente == 44 || previsionPaciente == 45 || previsionPaciente == 46 || previsionPaciente == 47 || previsionPaciente == 48 || previsionPaciente == 49 || previsionPaciente == 50){
								var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisiones', 'POST', 'JSON', 1);																
								var select    = document.getElementById(prevision);
								for(var i=0;i<respuesta.length;i++){
									var selected="";
									if (respuesta[i].id == previsionPaciente)
										selected=" selected ";
										select.options[i] = new Option(respuesta[i].prevision, respuesta[i].id);
									}
								$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected');	
								if(previsionPaciente == 4){
									
									$('#'+prevision).css( 'pointer-events', 'auto' );


								}else{
									
									// $('#'+prevision).prop('disabled', true);
									$('#'+prevision).css( 'pointer-events', 'none' );
									$('#'+prevision).css('background-color', '#eeeeee');
								}
								// $('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select	
								// var respuesta = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','accion=cargarPrevisionesSinFonasa', 'POST', 'JSON', 1);																
								// console.log(respuesta)
								// for (var i=0; i<respuesta.length; i++) {
								// 	$(prevision).append('<option value="' + respuesta[i].id + '">' + respuesta[i].prevision + '</option>');
								// }
							}
							/*else{
							// $(prevision)[0].disabled = true;
							var regions   = ["FONASA A", "FONASA B", "FONASA C","FONASA D"];
							var idregions = ["0", "1", "2","3"];
							var select = document.getElementById(prevision);
							for(var i=0;i<regions.length;i++){
							var selected="";
							if (idregions[i] == previsionPaciente)
							selected=" selected ";
							select.options[i] = new Option(regions[i], idregions[i]);
							}
							$('#'+prevision+' option[value='+previsionPaciente+']').attr('selected', 'selected'); //select									
							$('#'+prevision).prop('disabled', true);
							//$(prevision).attr('disabled', true);
							}	*/						
						}
				}

				if(formaPago){
						var formaPagoPaciente = response.datosPacientes.datos[0]['conveniopago'];							
						$('#'+formaPago+' option[value='+formaPagoPaciente+']').attr('selected', 'selected'); //select							
				}

				var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=calcularHoraDif', 'POST', 'JSON', 1);	
				var existeConexion = exiteConexionInternet();
				if(existeConexion){					
					switch(response.fonasa){
						case "successPrevisionNoRegistra":
							var funcion = function(response){
								switch(response.status){
									case "success":
										modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&nombreFonasa=frm_nombres_dau&ApellidoPaternoFonasa=frm_AP_dau&ApellidoMaternoFonasa=frm_AM_dau&direccionFonasa=frm_direccion&previsionFonasa=frm_prevision&sexoFonasa=frm_sexo&fechaNac=frm_Naciemito&calcularEdad=labelEdad','#pacienteFonasaCertificado','80%','auto','');
										break;

									case "noContetar":
										modalMensaje2("Error de Conexión Fonasa", 'El servicio externo de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
										break;

									default:    modalMensaje2("Error de Conexión Fonasa", 'El servicio externo de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
								}
							}
							ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+id+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);
							break;

						case "successPrevisionRegistrada":
							var funcion = function(response){
								switch(response.status){
									case "success":		
										modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&nombreFonasa=frm_nombres_dau&ApellidoPaternoFonasa=frm_AP_dau&ApellidoMaternoFonasa=frm_AM_dau&direccionFonasa=frm_direccion&previsionFonasa=frm_prevision&sexoFonasa=frm_sexo&fechaNac=frm_Naciemito&calcularEdad=labelEdad','#pacienteFonasaCertificado','80%','auto','');
										break;

									case "noContetar":
										modalMensaje2("Error de Conexión Fonasa", 'El servicio externo de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
										break;
							
									default:    modalMensaje2("Error de Conexión Fonasa", 'El externo servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
								}
							}
							
							ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+id+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);
							break;

						case "successPrevisionRestringida":
							modalMensaje2("Atencion", 'Este paciente ya fue sincronizado el día de hoy.', '', 550, 300, 'info', 'primary');
							break;
					}
					break;
				}
				else{
					modalMensaje2("Error de Conexión a Internet", 'El servicio de Internet no está disponible, <b>no hay comunicación con sistemas externos</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
				}
			}
		}

	}
});


