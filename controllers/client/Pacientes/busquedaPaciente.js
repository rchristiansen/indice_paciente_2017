$(document).ready(function(){
	// Enlazar boton.
	enlaceBoton();
	$.validity.start();
	/***************EVENTOS**************/
	tabla("#table_paciente");
	validar("#frm_id_paciente"      ,"numero");
	validar("#frm_nroDocumento"          	,"rut");
	// validar("#frm_nroDocumento" 	,"numero");
	validar("#frm_nroFicha"     	,"numero");
	validar("#frm_APaterno"           	,"letras");
	validar("#frm_AMaterno"           	,"letras");
	validar("#frm_nombresDos"      	,"letras");
	
	$("#table_paciente").on('click','.externo',function() {		
		if ( $.fn.DataTable.isDataTable('#table_paciente') ) {
			$('#table_paciente').DataTable().destroy();
		}
		var id      = $(this).attr('id'); //caputandp el id
		
		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=calcularHoraDif', 'POST', 'JSON', 1);

		switch(response.fonasa){
			case "successPrevisionNoRegistra":
				// alert("successPrevisionNoRegistra");
				var id      = $(this).attr('id'); //caputandp el id
				var llamada = "DAU";
				var funcion = function(response){ //FUNCION 2				
					switch(response.status){
						case "success":
							var fn_cerrar = function(){
								$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null );
							};
							var botones = [{ id: 'btnCerrar', value: 'Cerrar', function: fn_cerrar, class: 'btn btn-default'}];   
							
							modalFormularioSinCancelar('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto',botones);								
						// modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto','');
						break;

						case "noContetar":
							modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
						break;
						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}				
				}//FIN FUNCION 2			
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);														
				ajaxContent('/dau/views/modules/admision/admision.php','id='+$(this).attr('id'),'#contenidoDAU','', true);
				$('#'+modalIDdau).modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad

			break;

			case "successPrevisionRegistrada":
				// alert("successPrevisionRegistrada");
				var id = $(this).attr('id'); //caputandp el id
				var llamada = "DAU";
				var funcion = function(response){ //FUNCION 2				
					switch(response.status){
						case "success":
							var fn_cerrar = function(){
								$('#pacienteFonasaCertificado').modal( 'hide' ).data( 'bs.modal', null );
							};
							var botones = [{ id: 'btnCerrar', value: 'Cerrar', function: fn_cerrar, class: 'btn btn-default'}];   
							
							modalFormularioSinCancelar('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto',botones);								
						// modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto','');
						break;

						case "noContetar":
							modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
						break;
						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}				
				}//FIN FUNCION 2			
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);														
				ajaxContent('/dau/views/modules/admision/admision.php','id='+$(this).attr('id'),'#contenidoDAU','', true);
				$('#'+modalIDdau).modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
			break;

			case "successPrevisionRestringida":
				// alert("id paciente :"+id);
				var id = $(this).attr('id'); //caputandp el id
				ajaxContent('/dau/views/modules/admision/admision.php','id='+$(this).attr('id'),'#contenidoDAU','', true);
				$('#'+modalIDdau).modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
			break;
		}
		// var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=sistemaExterno', 'POST', 'JSON', 1);
		// switch(response.status){			
		// 	case "success":	
		// 		    $('#'+modalIDdau).modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutad
		// 			ajaxContent('../dau/views/modules/admision/admision.php','datosPaciente='+JSON.stringify(response.datosPacientes),'#contenidoDAU','', true);
		// 	break;
		// }
	});

	$("#table_paciente").on('click','.verDetalle',function() {
		var id       = $(this).attr('id'); //caputandp el id
		var llamada = "IP";
		var response = ajaxRequest('/indice_paciente_2017/controllers/server/Pacientes/main_controller.php','id='+id+'&accion=calcularHoraDif', 'POST', 'JSON', 1);
		switch(response.fonasa){
			case "successPrevisionNoRegistra":				
				var funcion = function(response){ //FUNCION 2				
					switch(response.status){
						case "success":														
							modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&nombreFonasa=frm_nombres&ApellidoPaternoFonasa=frm_AP&ApellidoMaternoFonasa=frm_AM&direccionFonasa=frm_direccion&previsionFonasa=frm_prevision&sexoFonasa=frm_sexo&fechaNac=frm_Naciemito&calcularEdad=labelEdad','#pacienteFonasaCertificado','80%','auto','');							
							// modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto','');
						break;

						case "noContetar":
							modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
						break;
						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}				
				}//FIN FUNCION 2			
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);														
				ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+$(this).attr('id'),'#contenidoPaciente','', true);
			break;

			case "successPrevisionRegistrada":				
				var funcion = function(response){ //FUNCION 2				
					switch(response.status){
						case "success":								
							// modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&llamada='+llamada,'#pacienteFonasaCertificado','80%','auto','');
							modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id+'&nombreFonasa=frm_nombres&ApellidoPaternoFonasa=frm_AP&ApellidoMaternoFonasa=frm_AM&direccionFonasa=frm_direccion&previsionFonasa=frm_prevision&sexoFonasa=frm_sexo&fechaNac=frm_Naciemito&calcularEdad=labelEdad','#pacienteFonasaCertificado','80%','auto','');
						break;

						case "noContetar":
							modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo mas tarde.', '', 550, 300, 'danger', 'remove');
						break;
						default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
					}				
				}			
				ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);														
				ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+$(this).attr('id'),'#contenidoPaciente','', true);
			break;

			case "successPrevisionRestringida":				
				ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+$(this).attr('id'),'#contenidoPaciente','', true);
			break;
		}
			
		// var funcion = function(response){ //FUNCION 2				
		// 	switch(response.status){
		// 		case "success":								
		// 			modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaDetallePaciente.php','datosFonasa='+response.datosFonasa+'&id='+id,'#pacienteFonasaCertificado','80%','auto','');
		// 		break;
		// 		default:    modalMensaje("Error generico", response, "error_generico", 400, 300);
		// 	}				
		// }//FIN FUNCION 2			
		// ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','id='+$(this).attr('id')+'&accion=confirmarPacienteFonasaDetalle', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', funcion);														
		// ajaxContent('/indice_paciente_2017/views/modules/Pacientes/detallePaciente.php','id='+$(this).attr('id'),'#contenido','', true);						
	});


	// $("#frm_tipoDocumento").Rut({
	// 	on_error: function(){
	// 		return false;
	// 	},
	// 	on_success: function(){

	// 	},
	// 	format_on: 'keyup'
	// });
	$('#documento').change(function(){
		if($('#documento option:selected').val()==1){
			$("#frm_nroDocumento").Rut({
				on_error: function(){
					return false;
				},
				on_success: function(){

				},
				format_on: 'keyup'
			});
		}else{
			$("#frm_nroDocumento").off();
			validar("#frm_nroDocumento"          	,"numero");
		}
	});
	$('#documento').change();

	$("#btnNuevoPaciente").click(function(){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/agregarPaciente.php','','#contenidoPaciente','', true);
	});

	$("#btnEliminarFiltrosPa").click(function(){
		var dau = $("#sistemaExterno").val();
		if(dau){
			$("#frm_nroDocumento").val("");
			$("#frm_nroFicha").val("");
			$("#frm_APaterno").val("");
			$("#frm_AMaterno").val("");
			$("#frm_nombresDos").val("");
			// $( "#table_paciente" ).remove();			
			$("#btnEliminarFiltrosPa" ).hide();		
			$("#contenidoTabla" ).hide();
			$("#table_paciente_info" ).hide();
			$("#table_paciente_paginate" ).hide();			
		}else{
			unsetSesion();
			view("#contenidoPaciente");
		}

		// unsetSesion();
		// view("#contenidoPaciente");

		
	});

	$("#btnBuscarPaciente").click(function(){
		// alert()
		clearDataTable("table_paciente");
		$.validity.start();
		//var result;
		if($("#frm_nroDocumento").val()!=""){
			if($('#documento option:selected').val()==1){
				var rutValido= $.Rut.validar($("#frm_nroDocumento").val());
				if(rutValido==false){	
					$('#frm_nroDocumento').assert(false,'El Run Ingresado, no es valido');	
				}
			}
		}

		$('#frm_APaterno').val(quitarEspacio($('#frm_APaterno').val()));
		if($("#frm_APaterno").val().length < 2 && $("#frm_APaterno").val()!=""){
			$('#frm_APaterno').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		$('#frm_AMaterno').val(quitarEspacio($('#frm_AMaterno').val()));
		if($("#frm_AMaterno").val().length < 2 && $("#frm_AMaterno").val()!=""){
			$('#frm_AMaterno').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		$('#frm_nombresDos').val(quitarEspacio($('#frm_nombresDos').val()));
		if($("#frm_nombresDos").val().length < 2 && $("#frm_nombresDos").val()!=""){
			$('#frm_nombresDos').assert(false,"Debe Ingresar Mínimo 2 Caracteres");
		}

		if($("#frm_nroFicha").val()==0 && $("#frm_nroFicha").val()!=""){
			$('#frm_nroFicha').assert(false,"Debe Buscar un Nro Distinto a 0");
		}

		if($("#frm_rut").val()==0 && $("#frm_rut").val()!=""){
			$('#frm_rut').assert(false,"Debe Buscar un Nro Distinto a 0");
		}

		if($("#frm_nroDocumento").val()==0 && $("#frm_nroDocumento").val()!=""){
			$('#frm_nroDocumento').assert(false,"Debe Buscar un Nro Distinto a 0");
		}

		// if($("#frm_id_paciente").val()==0 && $("#frm_id_paciente").val()!=""){
		// 		$('#frm_id_paciente').assert(false,"Debe Buscar un Nro Distinto a 0");
		// }

		result = $.validity.end();
		if(result.valid==false){
			return false;
		}	
		

		if($('#documento option:selected').val()==1){
			var rut = $("#frm_nroDocumento").val();
			rut     = $.Rut.quitarFormato(rut);
			rut     = rut.substring(0, rut.length-1);

			var dau = $("#sistemaExterno").val();

			if( $('#frm_nroDocumento').val()!='' || $('#frm_nroFicha').val()!='' || $('#frm_APaterno').val()!='' || $('#frm_AMaterno').val()!='' || $('#frm_nombresDos').val()!='' ){
				//alert("rut")
				$("#frm_nroDocumento").val("");
				if(dau){
					// alert("if dau")
					ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php',$("#frm_indice_paciente").serialize()+'&frm_rut='+rut,'#contenidoPaciente','', true);
				}else{	
					// alert("else dau")			
					ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php',$("#frm_indice_paciente").serialize()+'&frm_rut='+rut,'#contenidoPaciente','', true);
				}
			}
		}else{
			// var dau = $("#sistemaExterno").val();
			if($('#documento option:selected').val()==2){
				if( $('#frm_nroDocumento').val()!='' || $('#frm_nroFicha').val()!='' || $('#frm_APaterno').val()!='' || $('#frm_AMaterno').val()!='' || $('#frm_nombresDos').val()!='' ){
					//alert("no rut")
					if(dau){
						ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php',$("#frm_indice_paciente").serialize()+'&frm_nroDocumento='+$("#frm_nroDocumento").val(),'#contenidoPaciente','', true);
					}else{
						ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php',$("#frm_indice_paciente").serialize()+'&frm_nroDocumento='+$("#frm_nroDocumento").val(),'#contenidoPaciente','', true);
					}
				}
			}
		}			
	});	

});