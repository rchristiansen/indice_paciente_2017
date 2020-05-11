<?php
	session_start();
	//require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');             $objUtil           = new Util;
	$parametros               = $objUtil->getFormulario($_POST);
?>

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Fonasa/buscarPacienteFonasa.js?v=0.0.3"></script>
<form id="frm_buscarPacienteFonasa" class="formularios" name="frm_buscarPacienteFonasa" role="form" method="POST">
	<div class="row" id="divRut">
			<div class="form-group col-lg-4"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-1">
				<label class="encabezado">Run</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">				
						<input class="form-control" id="frm_rut_pacFonasa" name="frm_rut_pacFonasa" placeholder="12345678-k" maxlength="12">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>						
					</div>
				</div>
			</div>
			<!-- <button id="btnValiddarFonasa" type="button" class="btn btn-primary" alt="" title=""><i class="fa fa-search" aria-hidden="true"></i> Validar</button> -->	
		</div>
</form>