<?php
	session_start();
	require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');             $objUtil           = new Util;
	require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
	$parametros                                                    = $objUtil->getFormulario($_POST);
	$parametros['frm_id_paciente']                                 = $parametros['id'];
	$datos                                                         = $objPac->listarPaciente($objCon,$parametros);
	date_default_timezone_set("America/Santiago");
	$hora                                                          = date("G:i");
	$_SESSION['modulos']["Paciente"]["detalle_Paciente_Fallecido"] = $parametros;
	//highlight_string(print_r($_SESSION['modulos']["Paciente"]["detalle_Paciente_Fallecido"],true));
?>
<!-- <style>
	#modalContenido .modal-footer{   
		display: none !important;
	}
</style> -->

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/PacienteFallecido/PacienteEstado.js?v=0.0.3"></script>

<form id="frm_indicePacienteFallecido" class="formularios" name="frm_indicePacienteFallecido" role="form" method="POST">
	<div class="row">
		<div class="col-lg-12">		
			<h3 class="titulos">
				<span>Datos del Paciente Fallecido ID : <? echo $parametros['frm_id_paciente']?> </span>
			</h3>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Nombres</label>
		</div>
		<div class="form-group col-lg-5">
			<input name="frm_nombres" id="frm_nombres" class="form-control"  value="<?=$datos[0]['nombres'].' '.$datos[0]['apellidopat'].' '.$datos[0]['apellidomat']?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Fecha Nacimiento</label>
		</div>
		<div class="form-group col-lg-2">
			<input name="frm_Naciemito" id="frm_Naciemito" class="form-control"  value="<?=date("d-m-Y", strtotime($datos[0]['fechanac']));?>" disabled>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
		<label class="encabezado">Reporta</label>
		</div>
		<div class="form-group col-lg-5">
			<select id="frm_reporta" name="frm_reporta" class="form-control">
				<option value="">Seleccione</option>
				<option value="FAMILIARES">FAMILIARES</option>
	            <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>			
			</select>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Fecha Defunción</label>
		</div>
		<div class="form-group col-lg-4">		
			<div class='input-group date' id="datePickerREC1">
				<input name="frm_fechaDefuncion" id="frm_fechaDefuncion" class="form-control" placeholder="DD/MM/YY" value="">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Fecha Notificación</label>
		</div>		
		<div class="form-group col-lg-4">		
			<div class='input-group date' id="datePickerREC2">
				<input name="frm_notificacion" id="frm_notificacion" class="form-control"  placeholder="DD/MM/YY" value="" disabled>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>				
			</div>			
		</div>
		<img src="/indice_paciente_2017/assets/img/clear.png" style="cursor: pointer;" id="clearFechas" hidden="true">
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Hora Defunción</label>
		</div>
		<div class="form-group col-lg-2">		
			<div class="form-group">
				<div class='input-group date' id='datetimepicker3'>
					<input name="frm_hora" id="frm_hora" class="form-control"  value="<?=$hora?>"  disabled>
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-time"></span>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
		<div class="form-group col-lg-4">
			<label class="encabezado">Observación</label>
		</div>
		<div class="form-group col-lg-5">
			<textarea class="form-control" rows="5" id="frm_observacion" name="frm_observacion"></textarea>
		</div>
	</div>

	<!-- <div class="row">
		<div class="form-group col-lg-10">
			<button type="button" class="btn btn-primary derecha" id="btnRegistroRip" name="btnRegistroRip"><i class="fa fa-save" aria-hidden="true"></i> Guardar Paciente Fallecido</button>
		</div>
	</div> -->
</form>