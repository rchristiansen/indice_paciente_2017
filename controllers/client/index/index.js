$(document).ready(function(){
	var sistemaExterno = $("#sistemaExterno").val();
	var sistema = $("#sistema").val();
	if(sistemaExterno != ""){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPaciente.php?sistemaExterno='+sistemaExterno+'&sistema='+sistema,'','#contenidoPaciente','', true);
		return false;
	}

	if($("#banderaGES").val() == 1){
		ajaxContent('/indice_paciente_2017/views/modules/Pacientes/agregarPaciente.php?banderaGES='+$("#banderaGES").val(),'','#contenidoPaciente','', true);
		return false;

	}
	setPosition("busquedaPaciente");
	view("#contenidoPaciente");


});