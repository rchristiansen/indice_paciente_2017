function modalFormularioSinCancelar(titulo, url, parametros, idModal, ancho, alto, botones, funcionSalir){
	/*************************EJEMPLO DE ENVIO DE BOTONES***************************************************************/
   // 	var funcion = function miFuncion(){
   //   			alert("funciona");
   // 	}
   // 	var botones = [
   //      { id: 'btnAceptar', value: 'Aceptar', function: funcion, class: 'btn btn-success' }
   //    ]
   //****************************************************************************************************************/
   var time = new Date().getTime();
	var id = idModal.substring(1);
	var modal ='<div id="'+id+'" class="modal fade" tabindex="-1" role="dialog" >'+
				  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
				    		'<div class="modal-content"  id="modalContenido" >'+
				      		'<div class="modal-header">'+
					        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-list" aria-hidden="true"></span>'+
					        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
				      		'</div>'+
						      '<div class="modal-body" id="'+id+time+'">'+
						      '</div>'+
						      '<div class="modal-footer">';
						      // '<button type="button" class="btn btn-default" hidden data-dismiss="modal" id="cancelar'+time+'"> Cancelar</button>';
						      for (var btn in botones){
							     modal+='<button id="'+botones[btn].id+'" type="button" class="btnModalesFrm-'+id+" "+botones[btn].class+'">'+botones[btn].value+'</button>';
							   }
								modal+='</div>' +
					    	'</div>'+
					   '</div>'+
					'</div>';

	//SE AGREGA AL BODY
	$("body").append(modal);

	//CARGAMOS EL CONTENIDO

	var funcionModal = function(){
		//AGREGAMOS LOS EVENTOS A LAS MODALES
		for(var btn in botones){
			$("#"+botones[btn].id).click(botones[btn].function);
		}
		//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
		$('#'+id).off().on('hidden.bs.modal', function (e) {
			$('#'+id).remove();
			$(".btnModalesFrm-"+id).off();
			$("body").removeAttr( "style" );
			$('.validity-tooltip').remove();
		})

		//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
		$('#'+id).modal({
			keyboard: false,
			show: true,
			backdrop: true,
			backdrop: 'static'
		})

		if(typeof funcionSalir !== "undefined"){
			//EVENT QUE  SE LLEVA ACABO CUANDO CONFIRMA LA ALERTA
			$("#cancelar"+time).click(function(){
				funcionSalir();
			});
		}
	}
	ajaxContent(url, parametros, "#"+id+time, 'Cargando Formulario...', true, funcionModal);
}

function message(tipo, mensaje, ancho, ubicacion, id, autoClose, btnCerrar, duracion){//Funcion para mostrar label con errores
	// Tipos alertas ==> succes, info, warning, danger
	/***** Configuracion dependiendo del estado*****/
	/*$("#"+id).remove();*/
	id = id +""+Math.floor(Date.now() / 1000);
	var span;
	switch(tipo){
		case 'success':
				span = '<span class="glyphicon glyphicon-ok-sign"></span>';
		break;

		case 'info':
				span = '<span class="glyphicon glyphicon-info-sign"></span></b>';
		break;

		case 'warning':
				span = '<span class="glyphicon glyphicon-warning-sign"></span>';
		break;

		case 'danger':
				span = '<span class="glyphicon glyphicon-remove-sign"></span>';
		break;
	}
	var hidden= '<span aria-hidden="true">&times;</span>';
	if(typeof(btnCerrar) !=="undefined" && btnCerrar == false){
		hidden = "";
	}
	var duracionCerrar = 5000;
	if(typeof(duracion) !=="undefined" && isNaN(duracion) == false){
		duracionCerrar = duracion;
	}
	var html = '<div id="'+id+'" class="messageAlert">'+
							'<div class="alert alert-'+tipo+'" style="width:'+ancho+';" id="alert'+id+'">'+
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
								hidden+
								'</button>'+
									span+" "+mensaje+
					'</div>';
	$(html).hide().appendTo(ubicacion).slideDown(500);
	if(typeof(autoClose) !=="undefined" && autoClose == true){
		setTimeout(function(){
			$("#alert"+id).slideUp(500, function(){
	          $("#alert"+id).slideUp(500).alert('close');
	          $("#"+id).remove();
	          $(this).off();
	      });
		}, duracionCerrar);
	}
	return id;
}

function ajaxContent(url,parametros,contenedor, mensaje, sincrono, callback){
	var msg = "Cargando...";
	var async = false;
	if(typeof mensaje !== "undefined" && mensaje !="") {
		msg   = mensaje;
	}

	if(typeof (sincrono) === 'boolean' && sincrono == true) {
		async = sincrono;
	}

	$.blockUI({
		message: '<img height="80" src="/indice_paciente_2017/assets/img/loading-5.gif"/><label class="loadingBlock">'+msg+'</label>',
		css: {
			border: 'none',
			backgroundColor:'transparent'
		}
	});
	$(contenedor).fadeOut(100, function(){
		$.ajax({
			type : "POST",
			url  : url,
			data : parametros,
			async: async
		}).done(function(datos){
			$(contenedor).html(datos);
			$(contenedor).fadeIn();
			if(typeof callback === "function" && sincrono){
				callback();
			}
			$.unblockUI();
		}).fail(function(){
			$.unblockUI();
			return false;
		});
	});
}

function ajaxRequest(url,data, http, dataType, iterator, mensaje, callBack){//Funcion para hacer peticiones mediante ajax.
	/*
		iterator => Cantidad de veces que intentara realizar una peticion al servicio.
		Se hace esto porque a veces da error 404.
	*/
	if (iterator == 0){
		return false;
	} 

	var async_type = false;
	var response;

	if(typeof (callBack) === "function"){
		async_type = true;
		if(typeof mensaje !== "undefined"){
			$.blockUI({
				message: '<img height="80" src="/indice_paciente_2017/assets/img/loading-5.gif"/><label class="loadingBlock">'+mensaje+'</label>',
				baseZ: 2000,
				css: {
					border: 'none',
					backgroundColor:'transparent'
				}
			});
		}
   }
   if(typeof (callBack) === 'boolean' && callBack == true)
   	async_type = true;
	$.ajax({
	 	url  : url,
	 	type : http,
	 	data : data,
	 	dataType : dataType,
		async: async_type
	}).done(function(retorno){
		if(async_type){
			if(typeof (callBack) === "function"){
				response = callBack(retorno);
				$.unblockUI();
			}
		}else{
			response = retorno;
		}
	}).fail(function(){
		$.unblockUI();
		return retorno = ajaxRequest(url, data, http, dataType, --iterator, mensaje, callBack); //La hacemos recursiva.
	});
	return response;
}

function view(content){
	var retorno = ajaxRequest('/indice_paciente_2017/controllers/server/view_controller.php', "position_id="+getPosition(), "POST", "text", 1);
	//alert(retorno)
	if (retorno)
		ajaxContent(retorno,'',content,'', true);
}

function setPosition(valor){
	localStorage.setItem("position_id", valor);
}
function getPosition(){
	var position_id = ""; // Por defecto
	if (localStorage.getItem("position_id")!=null) {
		position_id = localStorage.getItem("position_id");
	}
	return position_id;
}

function modalConfirmacion(titulo, body, funcion, funcionSalir){
	/*************************EJEMPLO DE ENVIO DE FUNCION***************************************************************/
   /* 	var funcion = function miFuncion(){
   /*   			alert("funciona");
   /* 	}
   /*******************************************************************************************************************/
   var time = new Date().getTime();
	var modal ='<div id="modalConfirmacion'+time+'" class="modal fade" tabindex="-1" role="dialog" >'+
				  		'<div class="modal-dialog" role="document" >'+
				    		'<div class="modal-content amarillo"  id="modalContenido" >'+
				      		'<div class="modal-header">'+
					        		'<h5 class="modal-title"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <b>'+titulo+'</b></h5>'+
				      		'</div>'+
						      '<div class="modal-body">'+body+'</div>'+
						      '<div class="modal-footer">'+
							      '<button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelar'+time+'">No <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>'+
									'<button type="button" id="idSi" data-dismiss="modal" class="btn btn-success">Si <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>'+
								'</div>'+
					    	'</div>'+
					   '</div>'+
					'</div>';

	//SE AGREGA AL BODY
	$("body").append(modal);

	//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
	$('#modalConfirmacion'+time).off().on('hidden.bs.modal', function (e) {
		$("body").removeAttr( "style" );
		$('#modalConfirmacion'+time).remove();
	})

	//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
	$('#modalConfirmacion'+time).modal({
		keyboard: false,
		show: true,
		backdrop: true,
		backdrop: 'static'
	})

	//EVENT QUE  SE LLEVA ACABO CUANDO CONFIRMA LA ALERTA
	$("#idSi").click(function(){
		funcion();
		$('#modalConfirmacion'+time).modal( 'hide' ).data( 'bs.modal', null );
	});

	if(typeof funcionSalir !== "undefined"){
		//EVENT QUE  SE LLEVA ACABO CUANDO CONFIRMA LA ALERTA
		$("#cancelar"+time).click(function(){
			funcionSalir();
		});
	}
}

// function modalDetalle(titulo, url, parametros, idModal, ancho, alto, functionAceptar){
// 	var id = idModal.substring(1);
// 	var time = new Date().getTime();
// 	var modal ='<div id="modalDetalle'+time+'" class="modal fade " tabindex="-1" role="dialog" >'+
// 				  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
// 				    		'<div class="modal-content"  id="modalContenido" >'+
// 				      		'<div class="modal-header">'+
// 					        		'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
// 					        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'+
// 					        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
// 				      		'</div>'+
// 						      '<div class="modal-body" id="'+id+'">'+
// 						      '</div>'+
// 						      '<div class="modal-footer">'+
// 							      '<button type="button" class="btn btn-primary" id="aceptarDetalle'+time+'"> Aceptar</button>'+
// 								'</div>'+
// 					    	'</div>'+
// 					   '</div>'+
// 					'</div>';

// 	//SE AGREGA AL BODY
// 	$("body").append(modal);
// 	//CARGAMOS EL CONTENIDO
// 	var funcionModal = function(){
// 		//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
// 		$('#modalDetalle'+time).off().on('hidden.bs.modal', function (e) {
// 			$('#modalDetalle'+time).remove();
// 			$("body").removeAttr( "style" );
// 			$('.validity-tooltip').remove();
// 		})

// 		//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
// 		$('#modalDetalle'+time).modal({
// 			keyboard: true,
// 			show: true
// 		});
// 		$("#aceptarDetalle"+time).click(function(){
// 			$('#modalDetalle'+time).modal( 'hide' ).data( 'bs.modal', null );
// 			if(typeof functionAceptar === "function")
// 				functionAceptar();
// 		});
// 	}
// 	ajaxContent(url, parametros, idModal, 'Cargando...', true, funcionModal );
// }

function modalDetalle(titulo, url, parametros, idModal, ancho, alto, functionAceptar){
	var id = idModal.substring(1);
	var time = new Date().getTime();
	var modal ='<div id="modalDetalle'+time+'" class="modal fade " tabindex="-1" role="dialog" >'+
				  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
				    		'<div class="modal-content"  id="modalContenido" >'+
				      		'<div class="modal-header">'+
					        		'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'+
					        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
				      		'</div>'+
						      '<div class="modal-body" id="'+id+'">'+
						      '</div>'+
						      '<div class="modal-footer">'+
							      '<button type="button" class="btn btn-primary" id="aceptarDetalle'+time+'"> Aceptar</button>'+
								'</div>'+
					    	'</div>'+
					   '</div>'+
					'</div>';

	//SE AGREGA AL BODY
	$("body").append(modal);
	//CARGAMOS EL CONTENIDO
	var funcionModal = function(){
		//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
		$('#modalDetalle'+time).off().on('hidden.bs.modal', function (e) {
			$('#modalDetalle'+time).remove();
			$("body").removeAttr( "style" );
			$('.validity-tooltip').remove();
		})

		//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
		$('#modalDetalle'+time).modal({
			keyboard: true,
			show: true
		});
		$("#aceptarDetalle"+time).click(function(){
			$('#modalDetalle'+time).modal( 'hide' ).data( 'bs.modal', null );
			if(typeof functionAceptar === "function")
				functionAceptar();
		});
	}
	ajaxContent(url, parametros, idModal, 'Cargando...', true, funcionModal );
	return "modalDetalle"+time;
}

function modalDetalleSinBotonAceptar(titulo, url, parametros, idModal, ancho, alto, functionAceptar){
	var id = idModal.substring(1);
	var time = new Date().getTime();
	var modal ='<div id="modalDetalle'+time+'" class="modal fade " tabindex="-1" role="dialog" >'+
				  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
				    		'<div class="modal-content"  id="modalContenido" >'+
				      		'<div class="modal-header">'+
					        		'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'+
					        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
				      		'</div>'+
						      '<div class="modal-body" id="'+id+'">'+
						      '</div>'+						      
					    	'</div>'+
					   '</div>'+
					'</div>';

	//SE AGREGA AL BODY
	$("body").append(modal);
	//CARGAMOS EL CONTENIDO
	var funcionModal = function(){
		//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
		$('#modalDetalle'+time).off().on('hidden.bs.modal', function (e) {
			$('#modalDetalle'+time).remove();
			$("body").removeAttr( "style" );
			$('.validity-tooltip').remove();
		})

		//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
		$('#modalDetalle'+time).modal({
			keyboard: true,
			show: true
		});
		$("#aceptarDetalle"+time).click(function(){
			$('#modalDetalle'+time).modal( 'hide' ).data( 'bs.modal', null );
			if(typeof functionAceptar === "function")
				functionAceptar();
		});
	}
	ajaxContent(url, parametros, idModal, 'Cargando...', true, funcionModal );
}
function modalMensaje(titulo, mensaje, idModal, ancho, alto, clase, functionAceptar){
	var clasS;
	if(typeof clase !=="undefined")
		clasS = clase;
	var time = new Date().getTime();
	var modalMensaje ='<div id="'+idModal+time+'" class="modal fade" tabindex="-1" role="dialog" >'+
						  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
						    		'<div class="modal-content '+clasS+'"  id="modalContenidoMensaje" >'+
						      		'<div class="modal-header">'+
							        		'<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnEquis"><span aria-hidden="true">&times;</span></button>'+
							        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'+
							        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
						      		'</div>'+
								      '<div class="modal-body" id="contenidoMensaje">'+ mensaje +
								      '</div>'+
								      '<div class="modal-footer">'+
									      '<button type="button" class="btn btn-primary" id="btn_aceptar_mensaje"> Aceptar</button>'+
										'</div>'+
							    	'</div>'+
							   '</div>'+
							'</div>';
	//SE AGREGA AL BODY
	$("body").append(modalMensaje);

	//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
	$('#'+idModal+time).off().on('hidden.bs.modal', function (e) {
		$('#'+idModal+time).remove();
		$("body").removeAttr( "style" );
		$('.validity-tooltip').remove();
		// if(typeof functionAceptar === "function")
		// 		functionAceptar();
	});

	$("#btnEquis").click(function(){
		$('#'+idModal+time).modal('hide').data('bs.modal', null);
		if(typeof functionAceptar === "function")
			functionAceptar();
	});

	//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
	$('#'+idModal+time).modal({
		keyboard: true,
		show: true,
		backdrop: true,
		backdrop: 'static'
	});

	$("#btn_aceptar_mensaje").click(function(){
		$('#'+idModal+time).modal('hide').data('bs.modal', null);
		if(typeof functionAceptar === "function")
			functionAceptar();
	});
}
function modalFormulario(titulo, url, parametros, idModal, ancho, alto, botones, funcionSalir){
	/*************************EJEMPLO DE ENVIO DE BOTONES***************************************************************/
   // 	var funcion = function miFuncion(){
   //   			alert("funciona");
   // 	}
   // 	var botones = [
   //      { id: 'btnAceptar', value: 'Aceptar', function: funcion, class: 'btn btn-success' }
   //    ]
   //****************************************************************************************************************/
   var time = new Date().getTime();
	var id = idModal.substring(1);
	var modal ='<div id="'+id+'" class="modal fade" tabindex="-1" role="dialog" >'+
				  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
				    		'<div class="modal-content"  id="modalContenido" >'+
				      		'<div class="modal-header">'+
					        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-list" aria-hidden="true"></span>'+
					        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
				      		'</div>'+
						      '<div class="modal-body" id="'+id+time+'">'+
						      '</div>'+
						      '<div class="modal-footer">'+
						      '<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar'+time+'"> Cancelar</button>';
						      for (var btn in botones){
							     modal+='<button id="'+botones[btn].id+'" type="button" class="btnModalesFrm-'+id+" "+botones[btn].class+'">'+botones[btn].value+'</button>';
							   }
								modal+='</div>' +
					    	'</div>'+
					   '</div>'+
					'</div>';

	//SE AGREGA AL BODY
	$("body").append(modal);

	//CARGAMOS EL CONTENIDO

	var funcionModal = function(){
		//AGREGAMOS LOS EVENTOS A LAS MODALES
		for(var btn in botones){
			$("#"+botones[btn].id).click(botones[btn].function);
		}
		//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
		$('#'+id).off().on('hidden.bs.modal', function (e) {
			$('#'+id).remove();
			$(".btnModalesFrm-"+id).off();
			$("body").removeAttr( "style" );
			$('.validity-tooltip').remove();
		})

		//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
		$('#'+id).modal({
			keyboard: false,
			show: true,
			backdrop: true,
			backdrop: 'static'
		})

		if(typeof funcionSalir !== "undefined"){
			//EVENT QUE  SE LLEVA ACABO CUANDO CONFIRMA LA ALERTA
			$("#cancelar"+time).click(function(){
				funcionSalir();
			});
		}
	}
	ajaxContent(url, parametros, "#"+id+time, 'Cargando Formulario...', true, funcionModal);
}

function tabla(referencia){
	var tabla = $(referencia).DataTable({
						"aLengthMenu": [15,30,50,100],
						"iDisplayLength": 15,
						"stateSave": true,
						"autoWidth": false,
						"bSort": true,
						"aaSorting": [],
						"deferRender": true,
						// "bDestroy": true,
						// "processing": true,
      					// "serverSide": true,
      					// "ajax": "/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php",
						language: {
							"sProcessing":     "Procesando...",
							"sLengthMenu":     "Mostrar _MENU_ registros",
							"sZeroRecords":    "No se encontraron resultados",
							"sEmptyTable":     "Ningún dato disponible en esta tabla",
							"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
							"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
							"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
							"sInfoPostFix":    "",
							"sSearch":         "Filtrar tabla:",
							"sUrl":            "",
							"sInfoThousands":  ",",
							"sLoadingRecords": "Cargando...",
							"oPaginate": {
								"sFirst":    "Primero",
								"sLast":     "Último",
								"sNext":     "Siguiente",
								"sPrevious": "Anterior"
							},
							"oAria": {
								"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
								"sSortDescending": ": Activar para ordenar la columna de manera descendente"
							}
						}
					});
	return tabla;
}

function clearDataTable(referencia){//Elimina LocalStorage asociado a un dataTable
	localStorage.setItem( 'DataTables_'+referencia+"_"+window.location.pathname, "");
}

function enlaceBoton(identificador){// ENLACA EL BOTON A LA TECLA ENTER
	$('.formularios').off().keydown(function(e) { //.formularios => Clase del Formulario.
		var key = e.which;
		if (typeof identificador == "undefined") {
			if (key == 13) {
				$(".enviar").click(); // .enviar => Clase del boton que gatilla el submit
			}
		}else{
			if (key == 13) {
				$(identificador).click(); // identificador => identificador del boton que gatilla el submit
			}
		}
	});
}

function unsetSesion(){//Elimina todas las variables de sesion.
	ajaxRequest('/indice_paciente_2017/controllers/server/base_controller.php', "accion=unsetSesion", "POST", "text", 1);
}

function validar(referencia,tipo){
	var caracteres="";
   switch(tipo){
      case 'rut'         :   caracteres = "0123456789-kK";
      						  $(referencia).validCampoFranz(caracteres);
                          break;

      case 'fecha'       :   caracteres = "";
                          	  $(referencia).validCampoFranz(caracteres);
                          break;

      case 'numero'      :   caracteres = "0123456789";
      						  $(referencia).validCampoFranz(caracteres);
                          break;

      case 'numero_comas': caracteres = "0123456789,";
      						  $(referencia).validCampoFranz(caracteres);
     						break;

      case 'letras'      : caracteres = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ ";
      						  $(referencia).validCampoFranz(caracteres);
                          break;
      case 'letras_numeros'     :
      						  caracteres = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóúÁÉÍÓÚ0123456789.:- ";
      						  $(referencia).validCampoFranz(caracteres);
                          break;
      case 'correo'   :   caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@_.-";
      						  $(referencia).validCampoFranz(caracteres);
                          break;
      case 'codigoPortal'   :
      						  caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-";
      						  $(referencia).validCampoFranz(caracteres);
                          break;

      case 'hora'   :
      						  caracteres = "0123456789:";
      						  $(referencia).validCampoFranz(caracteres);
                          break;
   }
   referencia = "#"+$(referencia).attr("id");
   $(referencia).bind('paste', function(event) {
   	var e = event.originalEvent.clipboardData.getData('Text');
      setTimeout( function() {
         	var text = $(referencia).val();
            for (var i = 0; i < text.length; i++) {
            	if(caracteres.indexOf(text[i])==-1){
            		text = text.replace(e, "");
            		break;
            	}
            }
            $(referencia).val(text);
      }, 1, e);
   });

   $(referencia).blur(function() {
   	var string = $(this).val().trim();
   	string = string.replace(/\s+/g, ' ');
   	$(this).val(string);
   });
}

function calendarioFonasa(identificador){
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		monthsTitle: "Meses",
		clear: "Borrar",
		weekStart: 1,
		format: "dd-mm-yyyy"
	};
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'dd-mm-yyyy',
		endDate: '+0d', //para no tomar fechas futuras 
		container: $(container),
		todayHighlight: true,
		autoclose: true,
		language: 'es'
		/*orientation: 'bottom'*/
	};
	$(identificador).datepicker(options);
}

function calendario(identificador){
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		monthsTitle: "Meses",
		clear: "Borrar",
		weekStart: 1,
		format: "dd-mm-yyyy"
	};
	//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'dd-mm-yyyy',
		endDate: '+0d', //para no tomar fechas futuras 
		container: $(identificador),
		todayHighlight: true,
		autoclose: true,
		language: 'es'
		/*orientation: 'bottom'*/
	};
	$(identificador).datepicker(options);
}

function calendario2(identificador){
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		monthsTitle: "Meses",
		clear: "Borrar",
		weekStart: 1,
		format: "dd-mm-yyyy"
	};
	//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'dd-mm-yyyy',
		startDate: '-0d',
        showTodayButton: true, 
		container: $(identificador),
		todayHighlight: true,
		autoclose: true,
		language: 'es'
		/*orientation: 'bottom'*/
	};
	$(identificador).datepicker(options);
}

function ajaxForm(url,formulario, callBack){
	var formData = new FormData($('form')[0]);
	var retorno;
	$.ajax({
	 	url  : url,
	 	type : "POST",
	 	data : formData,
	 	dataType : "JSON",
		cache: false,
        contentType: false,
        processData: false,
		async: true,
		beforeSend: function() {
	 		if(typeof mensaje !== "undefined") {
	 			$.blockUI({
	 				message: '<img height="70" src="/indice_paciente_2017/assets/img/loading-5.gif"/><label class="loadingBlock">'+mensaje+'</label>',
	 				css: {
	 					border: 'none',
	 					backgroundColor:'transparent'
	 				}
	 			});
			}
	   }
	}).done(function(response){
		$.unblockUI();
		callBack(response);
	});
	//return retorno;
}

function formatear(string){
    var retorno = "";
    var guion="";
    var string = String(string);
    if(string[0]=="-"){
    	guion = string.substring(0,1);
    	string = string.substring(1);
    }
    for (var j, i = string.length - 1, j = 0; i >= 0; i--, j++)
     retorno = string.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + retorno;

  	 if(guion=="-"){
  	 	retorno=guion+retorno;
  	 }
    return retorno;
}

function quitarEspacio(string){
		string = string.trim();
		string = string.replace(/\s+/g, ' ');
		return string
}

function quitarFormatoNumeros(string){
	var valor = string.trim();
	valor = valor.replace('/./g', '');
	return valor;
}

function remplazar( pajar, aguja, reemplaza ){
  while (pajar.toString().indexOf(aguja) != -1)
      pajar = pajar.toString().replace(aguja,reemplaza);
  return pajar;
}

function  removerValidity(){
  $.validity.start();
  $.validity.end();
}
function showFile(file, ancho, alto){
	window.open(file, "iddd","width="+ancho+",height="+alto+",menubar=no,status=no,titlebar=yes");
}

function sumoSelect(identificador){
	$(identificador).SumoSelect({
		search: true, searchText: 'Enter here.',
		placeholder: 'Seleccione...',
		csvDispCount: 3,
		captionFormat:'{0} Seleccionados',
		captionFormatAllSelected:'{0},, Todos seleccionados',
		floatWidth: 400,
		forceCustomRendering: false,
		nativeOnDevice: ['Android', 'BlackBerry', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile', 'Silk'],
		outputAsCSV: false,
		csvSepChar: ',',
		okCancelInMulti: false,
		triggerChangeCombined: false,
		selectAll: false,
		search: true,
		searchText: 'Buscar...',
		noMatch: 'Sin coincidencias para "{0}"',
		prefix: '',
		locale: ['OK', 'Cancel', 'Select All'],
		up: false
	});
}

function validarEmail( email ) {
	expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if ( !expr.test(email) ){// INCORRECTO , ENTRA
		return false;
	}else{
		return true;
	}
}

function modalMensaje2(titulo, mensaje, idModal, ancho, alto, clase, icon, functionAceptar){
	var clasS;
	if(typeof clase !=="undefined")
		clasS = clase;
	var time = new Date().getTime();
	var modalMensaje ='<div id="'+idModal+time+'" class="modal fade" tabindex="-1" role="dialog" >'+
						  		'<div class="modal-dialog" role="document" style="width: '+ancho+'; height:'+alto+';">'+
						    		'<div class="modal-content panel-'+clasS+'"  id="modalContenidoMensaje" >'+
						      		'<div class="modal-header panel-heading">'+
							        		'<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnEquis"><span aria-hidden="true">&times;</span></button>'+
							        		'<span style="float:left; font-size: 18px;" class="glyphicon glyphicon-'+icon+'" aria-hidden="true"></span>'+
							        		'<h5 style="margin-left: 23px;" class="modal-title"><b>'+titulo+'</b></h5>'+
						      		'</div>'+
								      '<div class="modal-body" id="contenidoMensaje">'+
								      	'<div class="alert alert-'+clasS+'" role="alert">'+
								      		'<span class="glyphicon glyphicon-'+icon+'" aria-hidden="true"></span> '+mensaje+
								      	'</div>'+
								      '</div>'+
								      '<div class="modal-footer panel-'+clasS+'">'+
									      '<button type="button" class="btn btn-'+clasS+'" id="btn_aceptar_mensaje"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Aceptar</button>'+
										'</div>'+
							    	'</div>'+
							   '</div>'+
							'</div>';
	//SE AGREGA AL BODY
	$("body").append(modalMensaje);

	//PARA ELIMINAR TODO Y QUE NO QUEDE NADA DUPLICADO
	$('#'+idModal+time).off().on('hidden.bs.modal', function (e) {
		$('#'+idModal+time).remove();
		$("body").removeAttr( "style" );
		$('.validity-tooltip').remove();
		// if(typeof functionAceptar === "function")
		// 		functionAceptar();
	});

	$("#btnEquis").click(function(){
		$('#'+idModal+time).modal('hide').data('bs.modal', null);
		if(typeof functionAceptar === "function")
			functionAceptar();
	});

	//SE HACE MODAL Y SE LE SETEAN LAS OPCIONES
	$('#'+idModal+time).modal({
		keyboard: true,
		show: true,
		backdrop: true,
		backdrop: 'static'
	});

	$("#btn_aceptar_mensaje").click(function(){
		$('#'+idModal+time).modal('hide').data('bs.modal', null);
		if(typeof functionAceptar === "function")
			functionAceptar();
	});
}

//CVS 02-04-2019

function cargarContenido(url,parametros,contenedor){
	//FUNCION AJAX ENVIAPETICION A SERVIDOR Y CARGA CONTENIDO HTML EN CONTENEDOR(NORMALMENTE ELEMENTO DIV)
		$(contenedor).html('<div style="position: absolute;top: 50%; left: 50%;"><img style="width:50%; height:50%;" src="assets/img/loading-5.gif"/></div>');
		$(contenedor).fadeOut(25, function(){
			$.ajax({
				type: "POST",
				url:url,
				data:parametros,
				success: function(datos){
					$('.validity-tooltip').remove();
					//$.unblockUI();
					$(contenedor).html(datos);
				}
			});
			$(contenedor).fadeIn();
		});
	//FIN FUNCION AJAX
	}