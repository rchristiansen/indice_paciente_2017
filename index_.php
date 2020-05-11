<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Indice de Paciente</title>
	  <!--CSS FILES-->
	<?php if (!isset($_REQUEST["sistemaExterno"]) || !isset($_REQUEST["sistema"])) {?>
		<link href="/indice_paciente_2017/assets/frameworks/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="/indice_paciente_2017/assets/libs/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/indice_paciente_2017/assets/css/main.css">
		<link rel="stylesheet" href="/indice_paciente_2017/assets/css/animate.css">	  
		<link href="/indice_paciente_2017/assets/libs/pNotify/pnotify.custom.css" media="all" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/indice_paciente_2017/assets/libs/DataTables/datatables.css"/>
		<link rel="stylesheet" href="/indice_paciente_2017/assets/frameworks/bootstrap/css/bootstrap-datepicker3.css"/>
		<link rel="stylesheet" href="/indice_paciente_2017/assets/libs/jQuery/jquery-ui-1.12.0.css">
		<link rel="stylesheet" href="/indice_paciente_2017/assets/libs/validity/jquery.validity.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="/indice_paciente_2017/assets/libs/sumoselect/sumoselect.css">
		<link rel="stylesheet" type="text/css" href="/indice_paciente_2017/assets/libs/jqueryTimeEntry/jquery.timeentry.css">
		<link rel="stylesheet" type="text/css" href="/indice_paciente_2017/assets/libs/bootstrap-select-1.12.1/dist/css/bootstrap-select.min.css">
		<link rel="stylesheet" type="text/css" href="/indice_paciente_2017/assets/libs/dateTimePicker/bootstrap-datetimepicker.css">


		<!--JS FILES-->	  
		<script src="/indice_paciente_2017/assets/libs/jQuery/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/sumoselect/jquery.sumoselect.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/jqueryTimeEntry/jquery.timeentry.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/jQuery/jquery-ui-1.12.0.js"></script>
		<script src="/indice_paciente_2017/assets/frameworks/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/pNotify/pnotify.custom.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/DataTables/datatables.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/DataTables/highlight.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/js/main.js?v=0.0.14"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/blockUI/blockUI.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/validaCamposFranz/validCampoFranz.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/Rut/rut.js"></script>
		<script src="/indice_paciente_2017/assets/frameworks/bootstrap/js/bootstrap-datepicker.min.js"></script>
		<script src="/indice_paciente_2017/assets/libs/validity/jquery.validity.core.js" type="text/javascript" charset="utf-8"></script>
		<script src="/indice_paciente_2017/assets/libs/validity/jquery.validity.outputs.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/bootstrap-select-1.12.1/dist/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="/indice_paciente_2017/assets/libs/dateTimePicker/moment.js"></script>
		  <script type="text/javascript" src="/indice_paciente_2017/assets/libs/dateTimePicker/locale/es.js"></script>
		  <script type="text/javascript" src="/indice_paciente_2017/assets/libs/dateTimePicker/bootstrap-datetimepicker.js"></script>
	<?php }?>
		<script type="text/javascript" src="/indice_paciente_2017/controllers/client/index/index.js?v=0.0.17"></script>
	</head>
	<br>


	<input type="hidden" name="sistemaExterno" id="sistemaExterno" value="<?=$_REQUEST["sistemaExterno"]?>">
	<input type="hidden" name="sistema" id="sistema" value="<?=$_REQUEST["sistema"]?>">

	<div id="row" onDrop="return false">
		<div id="contenidoPaciente" class="container-fluid"></div>
	</div>


</html>