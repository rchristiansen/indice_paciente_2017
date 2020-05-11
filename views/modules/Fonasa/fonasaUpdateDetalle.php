<?php
	session_start();
	$parametros['reg_usuario_insercion']    = $_SESSION['MM_Username'];
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="titulos"><span>Actualizando Paciente</span></h3>
	</div>
</div>

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Fonasa/fonasaUpdateDetalle.js?v=0.0.6"></script>



<form id="frm_indicePacienteUpdateHJNC" class="formularios" name="frm_indicePacienteUpdateHJNC" role="form" method="POST">
<input type="hidden" name="frm_llamada" id="frm_llamada" value="<?=$_POST["llamada"]?>">

	<div class="row" id="contenedor1">
		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Usuario</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">	
						<input type="hidden" name="reg_usuario_insercion" id="reg_usuario_insercion" value="<?=$parametros['reg_usuario_insercion']?>">		
						<label><?=$parametros['reg_usuario_insercion']?></label>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Fecha</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class='input-group date' id="datePickerRECFonasaUpdate">
						<input type='text' class="form-control" name="frm_fechaUpdate" id="frm_fechaUpdate"  placeholder="DD/MM/YY" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Hora</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class='input-group date' id="datePickerRECFona">
						<input name="frm_horaFonasa" id="frm_horaFonasa" class="form-control" placeholder="9:30:50">
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
			<label class="encabezado">Motivo</label>
			</div>
			<div class="form-group col-lg-5">
				<textarea class="form-control" rows="5" id="frm_motivo" name="frm_motivo" placeholder="Motivo"></textarea>
			</div>
		</div>
	</div>
</form>