$("#frm_buscarPacienteFonasa").keypress(function(event){
	var t = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if(t == 13){
		
		// $("#btnGuardar").focus();
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
					var pacienteFonasaBuscar = function(response){	//FUNCION 3						
						switch(response.status){
							case "success":							
								$('#pacienteFonasa').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
								// var botones2 = [
								// { id: 'btnGuardar', value: '<i class="fa fa-save" aria-hidden="true"></i> Guardar', function: function fn(){}, class: 'btn btn-primary' }
								// ]
								modalFormulario('Datos Fonasa','/indice_paciente_2017/views/modules/Fonasa/fonasaAgregarPaciente.php','datosFonasa='+response.datosFonasa,'#pacienteFonasaCertificado','80%','auto','');
							break;

							case "error":
								//alert("colocar mensaje");
								modalDetalle("Información de Fonasa", "/indice_paciente_2017/views/modules/Fonasa/informacionFonasa.php", "", "#modal_errorFonasa", "60%", "100%");  //cuando no se encuentra en la bd de fonasa
							break;

							case "noContetar":
								modalMensaje2("Error de Conexión Fonasa", 'El servicio de <b>Fonasa no responde</b>, intentelo de nuevo.', '', 550, 300, 'danger', 'remove');
							break;

							
							
							default:    modalMensaje("Error generico", response.status, "error_generico", 400, 300);
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
	}
});
$(document).ready(function(){

	validar("#frm_rut_pacFonasa","rut");

	var runOK=0;
	$("#frm_rut_pacFonasa").Rut({
		on_error: function(){
			// $.validity.start();
			// $('#frm_rut_pacFonasa').assert(false,'Ingrese un run valido');
			runOK=0;
			// result.valid=false;
			// var result = $.validity.end();
			// return false;
		},
		on_success: function(){
			// $.validity.start();
			runOK=1;
			// var result = $.validity.end();			
			// return false;
		},
		format_on: 'keyup'
	});

	// $("#btnValiddarFonasa").click(function(){
	// 	$.validity.start();	

	// 	if($("#frm_rut_pacFonasa").val()==""){
	// 		$('#frm_rut_pacFonasa').assert(false,'Debe Ingrese un Run');			
	// 	}			
		
	// 	if(runOK==0 && $("#frm_rut_pacFonasa").val()!="" ){
	// 		$('#frm_rut_pacFonasa').assert(false,'El Run Ingresado, no es valido');
	// 	}else{
	// 		result = $.validity.end();
	// 		if(result.valid==false){
	// 			return false;
	// 		}			
	// 		var funcion = function miFuncion(){                 //FUNCION 2								
	// 			var pacienteFonasaBuscar = function(response){	//FUNCION 3	
	// 				alert("pacienteFonasaBuscar")
	// 				//$('#pacienteFonasaSearch').modal( 'hide' ).data( 'bs.modal', null ); // para eliminar modal una vez ejecutada
	// 				 $('#pacienteFonasa').modal('hide');
	// 			}
	// 			rut     = $("#frm_rut_pacFonasa").val();
	// 			rut     = $.Rut.quitarFormato(rut);         // rut junto al digito Verificador
	// 			rut     = rut.substring(0, rut.length-1); //Saca el digito Verificador
	// 			ajaxRequest('/indice_paciente_2017/controllers/server/Fonasa/main_controller.php','rut='+rut+'&accion=confirmarPacienteFonasa', 'POST', 'JSON', 1,'Verificando Paciente en Fonasa ...', pacienteFonasaBuscar);
	// 		}
	// 		modalConfirmacion("Advertencia", "ATENCIÓN, se procedera a validar al Paciente Por Fonasa, <b>¿Desea continuar?</b>", funcion);	
	// 	}
			
	// });
});