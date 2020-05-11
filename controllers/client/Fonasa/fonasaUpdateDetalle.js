$(document).ready(function(){ //(document).ready Inicio
	
	calendario("#datePickerRECFonasaUpdate");
	validar("#datePickerRECFonasaUpdate"             ,"fecha");
	validar("#frm_horaFonasa"                        ,"hora");
	validar("#frm_motivo"                            ,"letras_numeros");
	$('#frm_horaFonasa').datetimepicker({ dateFormat: '', timeFormat: 'hh:mm tt', timeOnly: true, pickDate: false  });

	// $('#frm_horaFonasa').timeEntry(
	// 	{show24Hours: true,
	// 	 showSeconds: true
	// 	}
	// );

	// if($("#datePickerRECFonasaUpdate") == ""){
	// 	$.validity.start();
	// 	$('#datePickerRECFonasaUpdate').assert(false,"Debe Ingresar Fecha de Actualización");
	// 	$.validity.end();
	// 	return false;
	// }

	// if($("#frm_horaFonasa") == ""){
	// 	$.validity.start();
	// 	$('#frm_horaFonasa').assert(false,"Debe Ingresar Hora de Actualización");
	// 	$.validity.end();
	// 	return false;
	// }

	// if($("#frm_horaFonasa") == ""){
	// 	$.validity.start();
	// 	$('#frm_motivo').assert(false,"Debe Ingresar Motivo de Actualización");
	// 	$.validity.end();
	// 	return false;
	// }	

});//(document).ready Fin