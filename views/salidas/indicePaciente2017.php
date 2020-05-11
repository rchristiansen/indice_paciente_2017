<?php
session_start();
	require_once('../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();	
	$SAU = $_POST['sistema'];
	// $_SESSION['modulos']["salidas"]["indicePaciente2017"] = $sistema;	
	//highlight_string(print_r($sistema,true));
?>

<style>
	.embed-responsive-16by9 {
		padding-bottom: 40.25% !important;
	}

	#modalContenido .modal-footer{   
		display: none !important;
	}

</style>

<div class="embed-responsive embed-responsive-16by9"> <!-- embed-responsive embed-responsive-16by9 -->
	<iframe id="iframeSistemas" class="embed-responsive-item" src="/indice_paciente_2017" width="10%" height="10%" frameborder="0" allowfullscreen></iframe> 
	<!-- class="embed-responsive-item" -->
</div>

<!-- <script>
	$('#iframeSistemas').ready(function(){		
		ajaxRequest('/indice_paciente_2017/views/modules/Pacientes/agregarPaciente.php','sistema=<?=$SAU?>', 'POST', 'JSON', 1, '', true);
	});
</script> -->

