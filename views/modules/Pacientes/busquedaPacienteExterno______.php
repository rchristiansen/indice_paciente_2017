<?
	ini_set('max_execution_time', 600);
	ini_set('memory_limit', '128M');
	require_once('../../../class/Connection.class.php'); $objCon      = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');       $objUtil     = new Util;
	require_once('../../../class/Paciente.class.php');   $objPac      = new Paciente;

	
	if($_POST['back']==1){		
		$sistemaExterno  = $_POST['sistemaExterno'];	
		$fonasa          = $_POST['fonasa'];
		$nombre          = $_POST['nombres'];
		$run             = $_POST['run'];		
		$ApellidoPaterno = $_POST['AP'];
		$ApellidoMaterno = $_POST['AM'];
		$fechaNac        = $_POST['fechaNac'];
		$calcularEdad    = $_POST['calcularEdad'];	
		$sexo            = $_POST['sexo'];
		$etnia           = $_POST['etnia'];
		$ctp           	 = $_POST['cap'];
		$nac             = $_POST['nac'];	
		$domicilio       = $_POST['direccion'];
		$correo          = $_POST['correo'];
		$telefonoCelular = $_POST['telefonoCelular'];
		$telefonoFijo    = $_POST['telefonoCelularFijo'];
		$prevision       = $_POST['prevision'];
		$formaPago       = $_POST['formaPago'];
		$idPaciente      = $_POST['idPaciente'];
		$tipoDocumento   = $_POST['tipoDocumentoLabel'];
		$doc_documento   = $_POST['doc_documento'];
		$paisNacimiento  = $_POST['paisNacimiento'];
		$PACafro         = $_POST['PACafro'];
		$region          = $_POST['region'];
		$ciudad          = $_POST['ciudad'];
		$calle           = $_POST['calle'];
		$numero          = $_POST['numero'];
		$sector          = $_POST['sector'];
		$prais           = $_POST['prais'];
		
		

	}else{
		if($_POST){
			// echo "if";		
			$campos           = $objUtil->getFormulario($_POST);
	  		$datos            = $objPac->listarPacienteExterno($objCon,$campos);
	  		$sistemaExterno   = $_POST['sistemaExterno'];
	  		$fonasa           = $_POST['fonasa'];  		
	  		$nombre           = $_POST['nombre'];
	  		$run              = $_POST['run'];
	  		$ficha            = $_POST['ficha'];
	  		$ApellidoPaterno  = $_POST['ApellidoPaterno'];
	  		$ApellidoMaterno  = $_POST['ApellidoMaterno'];
	  		$fechaNac         = $_POST['fechaNac'];
	  		$calcularEdad     = $_POST['calcularEdad'];
	  		$sexo             = $_POST['sexo'];
	  		$etnia            = $_POST['etnia'];
	  		$ctp              = $_POST['ctp'];
	  		$nac              = $_POST['nac'];
	  		$domicilio        = $_POST['domicilio'];
	  		$correo           = $_POST['correo'];
	  		$telefonoCelular  = $_POST['telefonoCelular'];
	  		$telefonoFijo     = $_POST['telefonoFijo'];
	  		$prevision        = $_POST['prevision'];
	  		$idPaciente       = $_POST['idPaciente'];
	  		$pacienteFall     = $_POST['pacienteFall'];	
	  		$tipoDocumento    = $_POST['tipoDocumentoLabel'];	//add - 11-12-2017
			$doc_documento    = $_POST['doc_documento'];	//add - 11-12-2017
			$paisNacimiento   = $_POST['paisNacimiento'];
			$PACafro          = $_POST['PACafro'];
			$region           = $_POST['region'];
			$ciudad           = $_POST['ciudad'];
			$calle            = $_POST['calle'];
			$numero           = $_POST['numero'];
			$sector           = $_POST['sector'];
			$prais            = $_POST['prais'];

	  		
	  		
	  		
		}else{
	    	// echo "else";
	      	$campos = 0;
	    	$sistemaExterno     = $_GET['sistemaExterno'];    	
	    }
	}

    
?>
<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/busquedaPacienteExterno.js?v=0.0.176"></script>

<form id="frm_indice_pacienteExterno" name="frm_indice_paciente" class="formularios" role="form" method="POST">
	<div class="row">
	    <div class="col-lg-12 row">
	  		<h3 class="titulos"><span>Buscar Pacientes</span></h3>
	  	</div>
	</div>

	<div class="col-lg-12 row">
		<form id="frm_indice_paciente" name="frm_indice_paciente" class="formularios" role="form" method="POST">
		<input type="hidden" name="sistemaExterno"   	id="sistemaExterno" 		value="<?=$sistemaExterno?>">
		<input type="hidden" name="fonasa"           	id="fonasa"         		value="<?=$fonasa?>">		
		<input type="hidden" name="nombre"           	id="nombre"         		value="<?=$nombre?>">
		<input type="hidden" name="run"              	id="run"            		value="<?=$run?>">
		<input type="hidden" name="ficha"            	id="ficha"          		value="<?=$ficha?>">
		<input type="hidden" name="ApellidoPaterno"  	id="ApellidoPaterno"    	value="<?=$ApellidoPaterno?>">
		<input type="hidden" name="ApellidoMaterno"  	id="ApellidoMaterno"    	value="<?=$ApellidoMaterno?>">
		<input type="hidden" name="fechaNac"         	id="fechaNac"           	value="<?=$fechaNac?>">
		<input type="hidden" name="calcularEdad"     	id="calcularEdad"       	value="<?=$calcularEdad?>">
		<input type="hidden" name="sexo"             	id="sexo"               	value="<?=$sexo?>">
		<input type="hidden" name="etnia"            	id="etnia"              	value="<?=$etnia?>">
		<input type="hidden" name="paisNacimiento"    	id="paisNacimiento"       	value="<?=$paisNacimiento?>">
		<input type="hidden" name="ctp"              	id="ctp"                	value="<?=$ctp?>">
		<input type="hidden" name="nac"              	id="nac"                	value="<?=$nac?>">
		<input type="hidden" name="domicilio"        	id="domicilio"          	value="<?=$domicilio?>">
		<input type="hidden" name="correo"        	 	id="correo"         		value="<?=$correo?>">
		<input type="hidden" name="telefonoCelular" 	id="telefonoCelular" 		value="<?=$telefonoCelular?>">
		<input type="hidden" name="telefonoFijo"     	id="telefonoFijo" 	    	value="<?=$telefonoFijo?>">
		<input type="hidden" name="prevision"        	id="prevision" 	    		value="<?=$prevision?>">
		<input type="hidden" name="formaPago"        	id="formaPago" 	    		value="<?=$formaPago?>">
		<input type="hidden" name="idPaciente"       	id="idPaciente" 	    	value="<?=$idPaciente?>">	
		<input type="hidden" name="pacienteFall"   		id="pacienteFall" 			value="<?=$pacienteFall?>">
		<input type="hidden" name="tipoDocumentoLabel"  id="tipoDocumentoLabel" 	value="<?=$tipoDocumentoLabel?>">
		<input type="hidden" name="doc_documento"  		id="doc_documento" 			value="<?=$doc_documento?>">
		<input type="hidden" name="PACafro"             id="PACafro" 		        value="<?=$PACafro?>">
		<input type="hidden" name="comuna"  		     id="comuna" 			    value="<?=$comuna?>"> <!-- add egs 13-04-2018 -->
		<input type="hidden" name="region"  		     id="region" 			    value="<?=$region?>">
		<input type="hidden" name="ciudad"  		     id="ciudad" 			    value="<?=$ciudad?>">
		<input type="hidden" name="calle"   		     id="calle" 			    value="<?=$calle?>">
		<input type="hidden" name="numero"   		     id="numero" 			    value="<?=$numero?>">
		<input type="hidden" name="sector"   		     id="sector" 			    value="<?=$sector?>">
		<input type="hidden" name="prais"   		     id="prais" 			    value="<?=$prais?>">
		
		
		

			<div class="row">

				<div class="form-group col-lg-1">
					<select id="documento" name="documento" class="form-control">
						<option value="1" <?if($campos["documento"]==1) echo "selected"?> >Rut</option>              <!-- rut -->
                    	<option value="2" <?if($campos["documento"]==2) echo "selected"?> >N° Documento</option>     <!-- nroDocumento -->
					</select>
				</div>

				<div class="form-group col-lg-2" >
					<input name="frm_documentoExterno" id="frm_documentoExterno" class="form-control  " placeholder="Documento"
						<?if($campos["frm_rut"]){?>
									value="<?=$objUtil->formatearNumero($campos['frm_rut']).'-'.$objUtil->generaDigito($campos['frm_rut'])?>"
						<?}else{?> 	value="<?=$campos['frm_documentoExterno']?>" <?}?>
					>
				</div>

				<div class="form-group col-lg-1">
					<input name="frm_nroFichaExterno" id="frm_nroFichaExterno" class="form-control" placeholder="Nro Ficha" value="<?=$campos['frm_nroFichaExterno']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_APaternoExterno" id="frm_APaternoExterno" class="form-control" placeholder="Apellido Paterno" value="<?=$campos['frm_APaternoExterno']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_AMaternoExterno" id="frm_AMaternoExterno" class="form-control" placeholder="Apellido Materno" value="<?=$campos['frm_AMaternoExterno']?>">
				</div>

				<div class="form-group col-lg-2">
					<input name="frm_nombresDosExterno" id="frm_nombresDosExterno" class="form-control" placeholder="Nombres" value="<?=$campos['frm_nombresDosExterno']?>">
				</div>

				<div class="form-group col-lg-1">
					<button id="btnBuscarPacienteExterno" type="button" class="btn btn-default enviar"><img src="/indice_paciente_2017/assets/img/IP-05.png" alt="Buscar"></button>
					<?php
					if(count($campos)>1){
						?>
						<button type="button" class="btn btn-default" alt="Limpiar" title="Limpiar" id="btnEliminarFiltrosPaEx"><img src="/indice_paciente_2017/assets/img/IP-08.png" ></button>
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
			<table id="table_pacienteExterno" class="table display table-condensed table-hover" width="100%">
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
	<? if($sistemaExterno != 'pharmanet' && $sistemaExterno != 'atencionAPS'){ ?>
		<button type="button" class="btn btn-primary" alt="" title="" id="btnNuevoPaciente" >Nuevo Paciente
			<img src="/indice_paciente_2017/assets/img/IP-06.png">
		</button>
	<?}?>
