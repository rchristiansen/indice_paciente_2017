<?php 
	session_start();
	require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');             $objUtil           = new Util;
	require_once('../../../class/Fallecido.class.php');        $objFallecido      = new Fallecido;
	$parametros                                          = $objUtil->getFormulario($_POST);
	$parametros['frm_id_paciente']                       = $parametros['id'];
	$datos                                               = $objFallecido->listarInfoFallecido($objCon,$parametros);
	$EdadRip                                             = $objFallecido->calcularEdadFallecido($objCon,$parametros);
	$objCon                                              = null;
	//highlight_string(print_r($EdadRip,true));
?>

<div class="row">
	<div class="col-lg-12">		
		<h3 class="titulos"><span>Información Defunción</span></h3>
	</div>
</div>

<br>

<form id="frm_indicePaciente" class="formularios" name="frm_indicePaciente" role="form" method="POST">
	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Reportado por</label>
		</div>
		<div class="form-group col-lg-5">
			<input name="frm_reportado" id="frm_reportado" class="form-control" value="<?=$datos[0]['fal_reporta']?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Fecha Defunción</label>
		</div>
		<div class="form-group col-lg-2">
			<input name="frm_difunsion" id="frm_difunsion" class="form-control" value="<?=date("d-m-Y", strtotime($datos[0]['fal_fecha_difuncion']))?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Edad Defunción</label>
		</div>
		<div class="form-group col-lg-2">
			<input name="frm_edadDefunsion" id="frm_edadDefunsion" class="form-control" value="<?=$EdadRip[0]['Edad'] .' Años'?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Fecha Notificación</label>
		</div>
		<div class="form-group col-lg-2">
			<input name="frm_notificacion" id="frm_notificacion" class="form-control" value="<?=date("d-m-Y", strtotime($datos[0]['fal_fecha_notificacion']))?>" disabled>
		</div>
	</div>	

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Hora</label>
		</div>
		<div class="form-group col-lg-2">
			<input name="frm_notificacion" id="frm_notificacion" class="form-control" value="<?=$datos[0]['fal_hora_difuncion']?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Observación</label>
		</div>
		<div class="form-group col-lg-5">
			<textarea class="form-control" rows="5" id="frm_observacion" name="frm_observacion" disabled><?=$datos[0]['fal_observacion']?></textarea>
		</div>
	</div>
</form>