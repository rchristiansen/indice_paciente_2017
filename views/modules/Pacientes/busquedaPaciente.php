<?php
		session_start();
		/*ini_set('memory_limit', '144M'); //Raise to 144 MB
		ini_set('max_execution_time', 300);*/

		ini_set('max_execution_time', 600); //300 seconds = 5 minutes 
		ini_set('memory_limit', '128M'); 
		/*ini_set('post_max_size', '64M');*/
		require_once('../../../class/Connection.class.php'); $objCon      = new Connection; $objCon->db_connect();
		require_once('../../../class/Util.class.php');       $objUtil     = new Util;
		require_once('../../../class/Paciente.class.php');   $objPac      = new Paciente;
		//echo isset($_REQUEST['sistemaExterno']);
		if($_POST){
			//echo "if";
			 $campos = $objUtil->getFormulario($_POST);
			 if($_REQUEST['sistemaExterno']=="")
  			 	$_SESSION['modulos']["Pacientes"]["BusquedaPaciente"] = $campos;
  			 $datos  = $objPac->listarPaciente($objCon,$campos);
		}else if(isset($_SESSION['modulos']["Pacientes"]["BusquedaPaciente"])){
			 //echo "else if";
			 if($_REQUEST['sistemaExterno']==""){
			 	$campos = $_SESSION['modulos']["Pacientes"]["BusquedaPaciente"];
      		 	$datos  = $objPac->listarPaciente($objCon,$campos);
			 }
      		 	
    	}else{
    		//echo "else";
      		$campos = 0;
    	}
    	/*echo "<br>". */
    	$sistemaExterno = $_REQUEST['sistemaExterno'];  
    	$bandera = 0;  
		$objCon=null;		
		//highlight_string(print_r($campos,true));

	?>
	<style>
		.inputSmall {
			width: 140px !important;
		}
	</style>


	
	<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/busquedaPaciente.js?v=0.0.92"></script>
	<!-- <script type="text/javascript" src="/indice_paciente_2017/controllers/client/salida.js"></script> -->
	<div class="row">
	    <div class="col-lg-12 row">
	  		<h3 class="titulos"><span>Buscar Pacientes</span></h3>
	  	</div>
	</div>

	<!-- <input type="text" name="" value="<?=$id[0]['MAXIMO']?>"> -->
	<div class="col-lg-12 row">
		<form id="frm_indice_paciente" name="frm_indice_paciente" class="formularios" role="form" method="POST">
		<input type="hidden" name="sistemaExterno" id="sistemaExterno" value="<?=$sistemaExterno?>">
			<div class="row">		

				<div class="form-group col-lg-1">
					<select id="documento" name="documento" class="form-control">
						<option value="1" <?if($campos["documento"]==1) echo "selected"?> >Rut</option>              <!-- rut -->
                    	<option value="2" <?if($campos["documento"]==2) echo "selected"?> >N° Documento</option>     <!-- nroDocumento -->
					</select>
				</div>

				<div class="form-group col-lg-2" >
					
					<input name="frm_nroDocumento" id="frm_nroDocumento" class="form-control  " placeholder="Documento" 
						<?if($campos["frm_rut"]){?> 
									value="<?=$objUtil->formatearNumero($campos['frm_rut']).'-'.$objUtil->generaDigito($campos['frm_rut'])?>" 
						<?}else{?> 	value="<?=$campos['frm_nroDocumento']?>" <?}?>
					>
				</div>

				<div class="form-group col-lg-1">
					<input name="frm_nroFicha" id="frm_nroFicha" class="form-control" placeholder="Nro Ficha" value="<?=$campos['frm_nroFicha']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_APaterno" id="frm_APaterno" class="form-control" placeholder="Apellido Paterno" value="<?=$campos['frm_APaterno']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_AMaterno" id="frm_AMaterno" class="form-control" placeholder="Apellido Materno" value="<?=$campos['frm_AMaterno']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_nombresDos" id="frm_nombresDos" class="form-control" placeholder="Nombres" value="<?=$campos['frm_nombresDos']?>">
				</div>

				<div class="form-group col-lg-1">
					<button id="btnBuscarPaciente" type="button" class="btn btn-default enviar"><img src="/indice_paciente_2017/assets/img/IP-05.png" alt="Buscar"></button>
					<?php
					if(count($campos)>1){
						?>
						<button type="button" class="btn btn-default" alt="Limpiar" title="Limpiar" id="btnEliminarFiltrosPa"><img src="/indice_paciente_2017/assets/img/IP-08.png" ></button>
						<?php
					}
					?>
				</div>
			</div>
		</form>
	</div>
	<br>

	<div class="row" id="divCompletoTable">
		<div class="col-lg-12">
			<table id="table_paciente" class="table display table-condensed table-hover" width="100%">
				<thead>
					<tr class="encabezado">
							
							<th width="12%">Tipo de Documento</th>
							<th width="12%">Nro Documento</th>
							<th width="12%">Nro Ficha</th>
							<th width="12%">Apellido Paterno</th>
							<th width="12%">Apellido Materno</th>
							<th width="12%">Nombres</th>
					</tr>
				</thead>
				<tbody id="contenidoTabla">
				<?php if(isset($_REQUEST['sistemaExterno']) && $_REQUEST['sistemaExterno']!=""){
						$clase ="externo";	
						// unset($_SESSION['modulos']["Pacientes"]["BusquedaPaciente"]);	
						$bandera=1;					
					  }else{
						$clase ="verDetalle";							
					  }
				for($i=0;$i<count($datos);$i++){?>

					<tr id="<?=$datos[$i]['id']?>" class=" <?=$clase_color?> detalle <?=$clase?> puntero">						
						<td> <!-- Tipo de Documento -->
							<!-- <?php if($datos[$i]['rut']==0 && $datos[$i]['extranjero']!="S"){ //FUE REGISTRADO RUT EN 0
								echo "RUT AAAA";
							}?> -->

							<?php if(($datos[$i]['rut'] || $datos[$i]['rut']==0) && $datos[$i]['extranjero']!="S"){ //FUE REGISTRADO RUT VALIDO
								echo "RUT";
							}?>

							<?php if(($datos[$i]['rut_extranjero']== 0 || $datos[$i]['rut_extranjero']) && $datos[$i]['id_doc_extranjero']==1){ //TIPO DE DOC "DNI"
								echo "DNI";
							}?>

							<?php if(($datos[$i]['rut_extranjero']== 0 || $datos[$i]['rut_extranjero']) && $datos[$i]['id_doc_extranjero']==2){ //TIPO DE DOC "PASAPORTE"
								echo "PASAPORTE";
							}?>

							<?php if(($datos[$i]['rut_extranjero']== 0 || $datos[$i]['rut_extranjero']) && $datos[$i]['id_doc_extranjero']==3){ //TIPO DE DOC "OTROS"
								echo "OTROS";
							}?>

							<?php if($datos[$i]['rut']==0 && ($datos[$i]['rut_extranjero'] || $datos[$i]['rut_extranjero']==0) && $datos[$i]['extranjero']=="S" && ($datos[$i]['id_doc_extranjero']=="" || $datos[$i]['id_doc_extranjero']==0)){
								echo "No definido";
							}?>					

						</td>

						<td> <!-- Nro Documento -->
							<?php if($datos[$i]['rut']==0 && $datos[$i]['extranjero']!="S"){ ?> <!-- Rut en 0 -->
									<?=$datos[$i]['rut'];?>
							<?}?>
							
							<?php if($datos[$i]['rut']){ ?> <!-- Rut valido  -->
									<?=$objUtil->formatearNumero($datos[$i]['rut']).'-'.$objUtil->generaDigito($datos[$i]['rut']);?>
							<?}?>

							<?php if(($datos[$i]['rut_extranjero'] || $datos[$i]['rut_extranjero']==0) && $datos[$i]['id_doc_extranjero']==1){ ?> <!-- NRO DE DNI  -->
								<?=$datos[$i]['rut_extranjero'];?>
							<?}?>

							<?php if(($datos[$i]['rut_extranjero'] || $datos[$i]['rut_extranjero']==0) && $datos[$i]['id_doc_extranjero']==2){ ?> <!-- NRO DE PASAPORTE  -->
								<?=$datos[$i]['rut_extranjero'];?>
							<?}?>

							<?php if(($datos[$i]['rut_extranjero'] || $datos[$i]['rut_extranjero']==0) && $datos[$i]['id_doc_extranjero']==3){ ?> <!-- NRO DE OTROS  -->
								<?=$datos[$i]['rut_extranjero'];?>
							<?}?> 

							<?php if($datos[$i]['extranjero']=="S" && ($datos[$i]['rut_extranjero'] || $datos[$i]['rut_extranjero']==0) && $datos[$i]['rut']==0 && ($datos[$i]['id_doc_extranjero']=="" || $datos[$i]['id_doc_extranjero']==0) ){ ?>
								<?=$datos[$i]['rut_extranjero'];?>
							<?}?>
						</td>

						<td> <!-- Nro Ficha -->
							<?=$datos[$i]['nroficha'];?>
						</td>
						<td><!-- Apellido Paterno -->
							<?=$datos[$i]['apellidopat'];?>
						</td>
						<td><!-- Apellido Materno -->
							<?=$datos[$i]['apellidomat'];?>
						</td>
						<td><!-- Nombres -->
							<?=$datos[$i]['nombres'];?>
						</td>
					</tr>
				<?}?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- <?php if ($muestra) {	?> -->
	
	<!-- <?php } ?> -->
	<?

	if($bandera==0 || isset($_REQUEST["sistema"])){?>
	<button type="button" class="btn btn-primary" alt="" title="" id="btnNuevoPaciente" >Nuevo Paciente
		<img src="/indice_paciente_2017/assets/img/IP-06.png">
	</button>
	<?}?>

