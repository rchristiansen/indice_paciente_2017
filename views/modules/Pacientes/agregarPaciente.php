<?php
	session_start();
	require_once('../../../class/Connection.class.php'); 	   $objCon            = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');       	   $objUtil           = new Util;
	require_once('../../../class/Comuna.class.php');     	   $objComuna   	  = new Comuna;
	require_once('../../../class/Nacionalidad.class.php');     $objNacionalidad   = new Nacionalidad;
	require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
	require_once('../../../class/Convenio.class.php');         $objConvenio       = new Convenio;
	require_once('../../../class/Extranjero.class.php');       $objDocExtra       = new Extranjero;
	require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
	require_once('../../../class/Localidad.class.php');        $objLocalidad      = new Localidad;
	require_once('../../../class/Sector.class.php');           $objSector         = new Sector;
	require_once('../../../class/Etnia.class.php');            $objEtnia          = new Etnia;
	
	$cargarEtnia        = $objEtnia->listarEtnia($objCon);
	$cargarComunas      = $objComuna->listarComuna($objCon,"");
	$cargarNacionalidad = $objNacionalidad->listarNacionalidad($objCon,"");
	$cargarPrevision    = $objPrevision->listarPrevision($objCon,"");
	$cargarConvenio     = $objConvenio->listarConvenio($objCon,"");
	$cargarDocExtra     = $objDocExtra->listarDocumentoExtranjero($objCon,"");
	$ultimoID           = $objPac->consultarUltimoID($objCon);
	$cargarRegiones                    = $objLocalidad->listarRegiones($objCon);
	$cargarSectorDomicilio             = $objSector->listarSectorDomicilio($objCon);

	if($_POST['sistemaExterno']){
		$_SESSION['frm_nombres_dau']     = 'frm_nombres_dau';
		$_SESSION['frm_AP_dau']     	 = 'frm_AP_dau';
		$_SESSION['frm_AM_dau']     	 = 'frm_AM_dau';
		$_SESSION['frm_rut']     		 = 'frm_rut';
		$_SESSION['frm_Naciemito']       = 'frm_Naciemito';		
		$_SESSION['labelEdad']       	 = 'labelEdad';
		$_SESSION['frm_sexo']       	 = 'frm_sexo';
		$_SESSION['frm_prevision']       = 'frm_prevision';
		$_SESSION['idPacienteDau']       = 'idPacienteDau';
		$_SESSION['id_doc_documentoDau'] = 'id_doc_documentoDau';
		
	}else{
		unset($_SESSION['frm_nombres_dau']);
		unset($_SESSION['frm_AP_dau']);
		unset($_SESSION['frm_AM_dau']);
		unset($_SESSION['frm_rut']);
		unset($_SESSION['frm_Naciemito']);		
		unset($_SESSION['labelEdad']);
		unset($_SESSION['frm_sexo']);
		unset($_SESSION['frm_prevision']);
		unset($_SESSION['idPacienteDau']);
		unset($_SESSION['id_doc_documentoDau']);
	}
	//highlight_string(print_r($ultimoID));
	$objCon=null;
?>
<style>
	.SumoSelect > .CaptionCont {
		width: 287px !important;
	}

	.col-sm-4 {
		width: 33.333333% !important;
	}
</style>

<!-- <script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/agregarPaciente.js"></script> -->
<!-- egs -->
<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/agregarPacienteNew.js?v=<?=round(microtime(true) * 1000);?>"></script>
<script type="text/javascript">
	if($("#sistemaExterno").val()!=""){
		function numeros() {
			key = event.keyCode || event.which;
			tecla = String.fromCharCode(key).toString();
    	letras = "0123456789";//Se define todo el abecedario que se quiere que se muestre.
    	especiales = [8]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    	tecla_especial = false
    	for(var i in especiales) {
    		if(key == especiales[i]) {
    			tecla_especial = true;
    			break;
    		}
    	}

    	if(letras.indexOf(tecla) == -1 && !tecla_especial)
    		event.returnValue = false;
    	}

    	calendario("#datePickerREC_Externo");

    	
	}
</script>

<?
if($_GET['banderaGES']==1){
	
}else{?>

<div class="row">
	<div class="col-lg-12">
		<div class="btn_volver">
			<button <?if($_POST['sistemaExterno']){?> id="btnVolver_ext" <?}else{?> id="btnVolver" <?}?> type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
		</div>
		<h3 class="titulos"><span>Nuevo Paciente</span></h3>
	</div>
</div>

<?}?>
<form id="frm_indicePaciente" class="formularios" name="frm_indicePaciente" role="form" method="POST">
<input type="hidden" name="sistemaExterno" 		id="sistemaExterno"  	 value="<?=$_POST['sistemaExterno']?>">
<input type="hidden" name="nombres"        		id="nombres"         	 value="<?=$_POST['nombres']?>">
<input type="hidden" name="run"        	   		id="run"        	     value="<?=$_POST['run']?>">
<input type="hidden" name="AP"        	   		id="AP"        	    	 value="<?=$_POST['AP']?>">
<input type="hidden" name="AM"        	   		id="AM"        	    	 value="<?=$_POST['AM']?>">
<input type="hidden" name="fechaNac"  	   		id="fechaNac"   	     value="<?=$_POST['fechaNac']?>">
<input type="hidden" name="calcularEdad"      	id="calcularEdad"      	  value="<?=$_POST['calcularEdad']?>">
<input type="hidden" name="sexo"      	  		id="sexo"            	 value="<?=$_POST['sexo']?>">
<input type="hidden" name="etnia"      	        id="etnia"           	 value="<?=$_POST['etnia']?>">
<input type="hidden" name="cap"      	        id="cap"             	 value="<?=$_POST['cap']?>">
<input type="hidden" name="nac"      	        id="nac"             	 value="<?=$_POST['nac']?>">
<input type="hidden" name="direccion"           id="direccion"       	 value="<?=$_POST['direccion']?>">
<input type="hidden" name="correo"              id="correo"          	 value="<?=$_POST['correo']?>">
<input type="hidden" name="telefonoCelular"     id="telefonoCelular"     value="<?=$_POST['telefonoCelular']?>">
<input type="hidden" name="telefonoCelularFijo" id="telefonoCelularFijo" value="<?=$_POST['telefonoCelularFijo']?>">
<input type="hidden" name="prevision" 			id="prevision" 			 value="<?=$_POST['prevision']?>">
<input type="hidden" name="formaPago" 			id="formaPago" 			 value="<?=$_POST['formaPago']?>">
<input type="hidden" name="idPaciente" 			id="idPaciente" 		 value="<?=$_POST['idPaciente']?>">
<input type="hidden" name="fonasa" 				id="fonasa" 		 	 value="<?=$_POST['fonasa']?>">
<input type="hidden" name="pacienteFall" 		id="pacienteFall" 		 value="<?=$_POST['pacienteFall']?>">
<input type="hidden" name="tipoDocumentoLabel" 	id="tipoDocumentoLabel"  value="<?=$_POST['tipoDocumentoLabel']?>">
<input type="hidden" name="doc_documento" 		id="doc_documento"  	 value="<?=$_POST['doc_documento']?>">
<input type="hidden" name="afrodescendiente"    id="afrodescendiente"  	 value="<?=$_POST['afrodescendiente']?>">
<input type="hidden" name="prais"               id="prais"  	         value="<?=$_POST['prais']?>">
<input type="hidden" name="paisNacimiento"      id="paisNacimiento"      value="<?=$_POST['paisNacimiento']?>">
<input type="hidden" name="region"      		id="region"     		 value="<?=$_POST['region']?>">
<input type="hidden" name="ciudad"      		id="ciudad"     		 value="<?=$_POST['ciudad']?>">
<input type="hidden" name="comuna"      		id="comuna"     		 value="<?=$_POST['comuna']?>">
<input type="hidden" name="calle"      		    id="calle"        		 value="<?=$_POST['calle']?>">
<input type="hidden" name="numeroDireccion"	    id="numeroDireccion"     value="<?=$_POST['numeroDireccion']?>">
<input type="hidden" name="sector"       	    id="sector"              value="<?=$_POST['sector']?>">
<input type="hidden" name="otrosTelefonos"      id="otrosTelefonos"      value="<?=$_POST['otrosTelefonos']?>">
<!-- egs  -->
<input type="hidden" name="banderaGES" id="banderaGES" value="<?=$_GET['banderaGES']?>">









<div class="row" id="contenedor1" style="margin-left: 4%;margin-right: 4%;"> <!-- Primer Row -->
	<div class=" form-group col-md-6"> <!-- Primer form-group col-md-6 -->

		<!-- <h3 class="titulos"><span>Información Paciente</span></h3> -->
		<h3 class="titulos">
			<img src="/indice_paciente_2017/assets/img/arrow.png">
			<span>Datos Demográficos</span>
		</h3>	
	
		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Extranjero</label>
			</div>
			<div class="form-group col-lg-5">
				<input type="checkbox" id="frm_extranjero" name="frm_extranjero" value="N">
			</div>
		</div>		

		<div class="row" id="divDocumento" hidden>
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Documento</label>
			</div>
			<div class="form-group col-lg-3">
				<select id="frm_documento" name="frm_documento" class="form-control">
					<option value="">Seleccione Documento</option>
					<?php for ($i=0; $i<count($cargarDocExtra) ; $i++) {?>
						<option value="<?=$cargarDocExtra[$i]['id_doc_extranjero']?>">
									   <?=$cargarDocExtra[$i]['nombre_doc_extranjero']?>
						</option>
					<?}?>
				</select>
			</div>
		</div>

		<div class="row" id="divNroDocumento" hidden >
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">N° Documento</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">
						<input class="form-control" id="frm_nroDocumento" name="frm_nroDocumento" placeholder="N° Documento">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row" id="divRut">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Run</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">				
						<input class="form-control" id="frm_rut_pac" name="frm_rut_pac" placeholder="12345678-k" value="">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					</div>
				</div>
			</div>		
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Ficha</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">	
						<input name="frm_nroFicha" id="frm_nroFicha" class="form-control" placeholder="Nro de Ficha" value="0" disabled>
						<span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
					</div>
				</div>	
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Nombres</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">
						<input name="frm_nombres" id="frm_nombres" class="form-control" placeholder="Nombre del Paciente" value="">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Apellido Paterno</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">
						<input name="frm_AP" id="frm_AP" class="form-control" placeholder="Apellido Paterno" value="">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Apellido Materno</label>
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group col-lg-12">
						<input name="frm_AM" id="frm_AM" class="form-control" placeholder="Apellido Materno" value="">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					</div>
				</div>									
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Fecha de Nacimiento</label>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class='input-group date' <?if($_POST['sistemaExterno']){?> id="datePickerREC_Externo" <?}else{?> id="datePickerREC" <?}?>>
						<input type='text' class="form-control"  <?if($_POST['sistemaExterno']){?> name="frm_Naciemito_ext" id="frm_Naciemito_ext"  <?}else{?> name="frm_Naciemito" id="frm_Naciemito" <?}?> value="" placeholder="DD/MM/YY" />
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
				<label class="encabezado">Edad</label>
			</div>
			<div class="form-group col-lg-4">
				<label id="labelEdadIP"></label>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Sexo</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_sexo" name="frm_sexo" class="form-control">
					<option value="">Seleccione Sexo</option>
					<option value="M">MASCULINO</option>
                    <option value="F">FEMENINO</option>
                    <option value="O">INDETERMINADO</option>
                    <option value="D">DESCONOCIDO</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Estado Civil</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_estadoCivil" name="frm_estadoCivil" class="form-control">
					<option value="">Seleccione Estado Civil</option>
					<option value="2">CASADA(O)</option>
					<option value="5">CONVIVIENTE</option>
					<option value="7">DESCONOCIDO</option>
					<option value="6">DIVORCIADA(O)</option>
					<option value="4">SEPARADA(O)</option>
					<option value="1">SOLTERA(O)</option>
					<option value="3">VIUDA(O)</option>
				</select>
			</div>			
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Nacionalidad</label>
			</div>
			<div class="form-group col-lg-4">
				<!-- <select id="frm_nacionalidad" name="frm_nacionalidad" class="form-control sumoNacionalidad"> -->
				<select id="frm_nacionalidad" name="frm_nacionalidad" class="form-control ">
					<option value="">Seleccione Nacionalidad</option>
					<option value="NOINF">NO INFORMADA</option>
					<?php for($i=0; $i<count($cargarNacionalidad); $i++){?>
					<option value="<?=$cargarNacionalidad[$i]['NACcodigo']?>"  <?if($datos[0]["nacionalidad"]==$cargarNacionalidad[$i]['NACcodigo']){echo "selected";}?>>
						<?=$cargarNacionalidad[$i]['NACdescripcion']?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">País de Nacimiento</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_paisNacimiento" name="frm_paisNacimiento" class="form-control ">
					<option value="">Seleccione País Nacimiento</option>
					<option value="NOINF">NO INFORMADA</option>
					<?php for($i=0; $i<count($cargarNacionalidad); $i++){?>
					<option value="<?=$cargarNacionalidad[$i]['NACcodigo']?>" <?if($datos[0]["paisNacimiento"]==$cargarNacionalidad[$i]['NACcodigo']){echo "selected";}?> >
						<?=$cargarNacionalidad[$i]['NACpais']?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Pueblo Originario</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_etnia" name="frm_etnia" class="form-control">
					<option value="">Seleccione Pueblo Originario</option>
					<?php for($i=0; $i<count($cargarEtnia); $i++){?>
                        <option value="<?=$cargarEtnia[$i]['etnia_id']?>" <?if($datos[0]["etnia"]==$cargarEtnia[$i]['etnia_id']){echo "selected";}?> >
                        <?=$cargarEtnia[$i]['etnia_descripcion']?>
                        </option>
                    <?php }?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Afrodescendiente</label>
			</div>
			<div class="form-group col-lg-5">
				<input type="checkbox" id="frm_afro" name="frm_afro" value="1">
			</div>
		</div>

		<br><br>
		<div class="row">
			<div class="col-xs-6 col-md-3"></div>
			<div class="col-xs-6 col-md-4">
				<div div class="row">
					<center>
						<button id="btnGuardarPaciente"   type="button" class="btn btn-primary" alt="" title=""><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
						<!-- <button id="btnBuscar"            type="button" class="btn btn-primary" alt="" title=""><i class="fa fa-search" aria-hidden="true"></i> Buscar</button> -->
						<button <?if($_POST['sistemaExterno']){?> id="btnAddFonasa_Externo" <?}else{?> id="btnAddFonasa" <?}?> type="button" class="btn btn-primary" alt="" title=""><i class="fa fa-plus" aria-hidden="true"></i> Agregar Por Fonasa</button>
					</center>
				</div>
			</div>
			<div class="col-xs-6 col-md-3"></div>
		</div>
		
	</div> <!-- Cierre del primer form-group col-md-6 -->

	<div class=" form-group col-md-6"> <!-- Segundo form-group col-md-6 -->	
	<!-- <br> -->
		<h3 class="titulos">
			<img id="arrowDatosPrevisionales" src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse2" style="cursor: pointer;">
			<span>Datos Previsionales</span>
		</h3>				

		<div id="collapse2" class="collapse in"> <!-- inicio de collapse2 -->
			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Previsión</label>
				</div>
				<div class="form-group col-lg-3">
					<!-- <select id="frm_prevision" name="frm_prevision" class="form-control sumoPrevision"> -->
					<select id="frm_prevision" name="frm_prevision" class="form-control">
						<option value="">Seleccione Previsión</option>
						<?php for($i=0; $i<count($cargarPrevision); $i++){?>
						<option value="<?=$cargarPrevision[$i]['id']?>">
							<?=$cargarPrevision[$i]['prevision']?>
						</option>
						<?php }?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Convenio de Pago</label>
				</div>
				<div class="form-group col-lg-3">
					<!-- <select id="frm_convenio" name="frm_convenio" class="form-control sumoConvenio"> -->
					<select id="frm_convenio" name="frm_convenio" class="form-control">
						<option value="">Seleccione Convenio</option>
						<?php for($i=0; $i<count($cargarConvenio); $i++){?>
						<option value="<?=$cargarConvenio[$i]['instCod']?>">
							<?=$cargarConvenio[$i]['instNombre']?>
						</option>
						<?php }?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">PRAIS</label>
				</div>
				<div class="form-group col-lg-5">
					<input type="checkbox" id="frm_afro" name="frm_prais" value="1">
				</div>
			</div>
			
		</div> <!-- fin de collapse2 -->

		<h3 class="titulos">
			<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse1" style="cursor: pointer;">
			<span>Datos Localización y Contacto</span>
		</h3>

		<div id="collapse1" class="collapse in"> <!-- inicio de collapse1 -->

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Región</label>
				</div>
				<div class="form-group col-lg-5">
					<select id="frm_regionIndicePaciente" name="frm_regionIndicePaciente" class="form-control">
						<option value=""> Seleccione Región </option>
						<?php for($i=0; $i<count($cargarRegiones); $i++){?>                   
						<option value="<?=$cargarRegiones[$i]['REG_Id']?>" <?if($datos[0]["region"]==$cargarRegiones[$i]['REG_Id']){echo "selected";}?> >
						<?=$cargarRegiones[$i]['REG_Descripcion']?>
						</option>
						<?php } ?>
					</select>
				</div>
			</div>

		    <div class="row">
				<div id="divSeleccionCiudadesIndicePaciente" hidden = "true"> 
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Ciudad</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_ciudadIndicePaciente" name="frm_ciudadIndicePaciente" class="form-control" >
						</select>
					</div>
				</div>	
			</div>

			<div class="row">
				<div id="divSeleccionComunasIndicePaciente" hidden = "true"> 
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Comuna</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_comunaIndicePaciente" name="frm_comunaIndicePaciente" class="form-control" >
						</select>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Nombre Calle</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_nombreCalleIndicePaciente" id="frm_nombreCalleIndicePaciente" class="form-control" placeholder="Nombre Calle" value="">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Número Dirección</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_numeroDireccionIndicePaciente" id="frm_numeroDireccionIndicePaciente" class="form-control" placeholder="Número Dirección" value="">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Resto Dirección</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_direccion" id="frm_direccion" class="form-control" placeholder="Resto de Dirección" value="">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Sector Domicilio</label>
				</div>
				<div class="form-group col-lg-5">
					<select id="frm_sectorDomicilioIndicePaciente" name="frm_sectorDomicilioIndicePaciente" class="form-control" >
						<option value="">Seleccione Sector</option>
                        <?php for($i=0; $i<count($cargarSectorDomicilio); $i++){?>
                        	<option value="<?=$cargarSectorDomicilio[$i]['id_sector_domiciliario']?>" <?if($datos[0]["sector_domicilio"]==$cargarSectorDomicilio[$i]['id_sector_domiciliario']){echo "selected";}?>>
                            <?=$cargarSectorDomicilio[$i]['descripcion_sector_domiciliario']?>
                            </option>
                        <?}?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Tipo Domicilio</label>
				</div>
				<div class="form-group col-lg-5">
					<select id="frm_tipoDomicilioIndicePaciente" name="frm_tipoDomicilioIndicePaciente" class="form-control" >
                        <option value='U'>Urbano</option>
                        <option value='R'>Rural</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Centro de Atención Primaria</label>
				</div>
				<div class="form-group col-lg-5">
					<!-- <select id="frm_centroAtencion" name="frm_centroAtencion" class="form-control sumoAtencion"> -->
					<select id="frm_centroAtencion" name="frm_centroAtencion" class="form-control">
						<option value="">Seleccione Centro</option>
						<option value='17'>Consultorio DIPRECA</option>
						<option value='1' >Consultorio Dr. Amador Neghme</option>
						<option value='2' >Consultorio Dr. Remigio Sapunar</option>
						<option value='3' >Consultorio Dr. Victor Bertin Soto</option>
						<option value='4' >Consultorio Dra. Iris Véliz</option>
						<option value='5' >Consultorio Putre</option>
						<option value='18'>Eugenio Petruccelli</option>
						<option value='6' >Hospital Hjn Procedimiento</option>
						<option value='7' >Policlínico Estudiantil U. De Tarapacá</option>
						<option value='8' >Policlínico JUNAEB</option>
						<option value='9' >Posta Rural De Alcérreca</option>
						<option value='10'>Posta Rural De Belén</option>
						<option value='11'>Posta Rural De Codpa</option>
						<option value='12'>Posta Rural De Poconchile</option>
						<option value='13'>Posta Rural De San Miguel</option>
						<option value='14'>Posta Rural De Sobraya</option>
						<option value='15'>Posta Rural De Ticnamar</option>
						<option value='16'>Posta Rural De Visviri</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Teléfono Fijo</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
							<input name="frm_telefonoFijo" id="frm_telefonoFijo" class="form-control" placeholder="Teléfono Fijo" maxlength="10" value="" <?if($_POST['sistemaExterno']){?> onkeypress="numeros()" <?}?>>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div><!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Teléfono Celular</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<span class="input-group-addon">+56 9</span>
							<input name="frm_telefonoCelular" id="frm_telefonoCelular" class="form-control" placeholder="Teléfono Celular" maxlength="8" value="" <?if($_POST['sistemaExterno']){?> onkeypress="numeros()" <?}?>>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Otros Teléfonos</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
							<input name="frm_otrosTelefonosIndicePaciente" id="frm_otrosTelefonosIndicePaciente" class="form-control" placeholder="Otros Teléfonos" value="" <?if($_POST['sistemaExterno']){?> <?}?>>
						</div>
					</div>
				</div>
			</div>	

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Email</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input name="frm_email" id="frm_email" class="form-control" placeholder="Email" value="">
						</div>
					</div>
				</div>
			</div>		

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Teléfono Fijo Avis</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
							<input name="frm_telefonoFijoAvis" id="frm_telefonoFijoAvis" class="form-control" placeholder="Teléfono Fijo Avis" value="">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Teléfono Celular Avis</label>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="input-group col-lg-12">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<span class="input-group-addon">+56 9</span>
							<input name="frm_telefonoCelularAvis" id="frm_telefonoCelularAvis" class="form-control" placeholder="Teléfono Celular Avis" value="" maxlength="8">
						</div>
					</div>
				</div>
			</div>
		</div>	<!-- fin de collapse1 -->	

		<h3 class="titulos">
			<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse3" style="cursor: pointer;">
			<span>Información Laboral</span>
		</h3>

		<div id="collapse3" class="panel-collapse collapse"> <!-- inicio de collapse3 -->
			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Ocupación Laboral</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_ocupacionLaboral" id="frm_ocupacionLaboral" class="form-control" placeholder="Ocupación Laboral" value="">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Lugar de Trabajo</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_lugarTrabajo" id="frm_lugarTrabajo" class="form-control" placeholder="Lugar de Trabajo" value="">
				</div>
			</div>

			<div class="row" id="contenedor2">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Dirección</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_direccion_laboral" id="frm_direccion_laboral" class="form-control" placeholder="Dirección de Trabajo" value="">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Teléfono</label>
				</div>
				<div class="form-group col-lg-5">
					<input name="frm_telefono_laboral" id="frm_telefono_laboral" class="form-control" placeholder="Teléfono de Trabajo" value="">
				</div>
			</div>

			<div class="row" >
				<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
				<div class="form-group col-lg-4">
					<label class="encabezado">Comuna</label>
				</div>
				<div class="form-group col-lg-5">
					<!-- <select id="frm_comunaLaboral" name="frm_comunaLaboral" class="form-control sumoComunaLaboral"> -->
					<select id="frm_comunaLaboral" name="frm_comunaLaboral" class="form-control">
						<option value="">Seleccione Comuna</option>
						<?php for($i=0; $i<count($cargarComunas); $i++){?>
						<option value="<?=$cargarComunas[$i]['id']?>">
									   <?=$cargarComunas[$i]['comuna']?>
						</option>
						<?php }?>
					</select>
				</div>
			</div>
		</div> <!-- fin de collapse3 -->

		<div>
			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse4" style="cursor: pointer;">
				<span>Datos del Padre</span>
			</h3>

			<div id="collapse4" class="panel-collapse collapse"> <!-- inicio de collapse4 -->
				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Nombres</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_NombresPadre" id="frm_NombresPadre" class="form-control" placeholder="Nombres" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_Padre" id="frm_AP_Padre" class="form-control" placeholder="Apellido Paterno" value="">
					</div>
				</div>

				<div class="row" id="contenedor3">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_Padre" id="frm_AM_Padre" class="form-control" placeholder="Apellido Materno" value="">
					</div>
				</div>
			</div> <!-- fin de collapse4 -->
		</div>

		<div>
			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse5" style="cursor: pointer;">
				<span>Datos de la Madre</span>
			</h3>
			<div id="collapse5" class="panel-collapse collapse"> <!-- inicio de collapse5 -->
				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Nombres</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_NombresMadre" id="frm_NombresMadre" class="form-control" placeholder="Nombres" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_Madre" id="frm_AP_Madre" class="form-control" placeholder="Apellido Paterno" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_Madre" id="frm_AM_Madre" class="form-control" placeholder="Apellido Materno" value="">
					</div>
				</div>
			</div> <!-- fin de collapse5 -->
		</div>

		<div>
			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse6" style="cursor: pointer;">
				<span>Datos de otro Contacto</span>
			</h3>
			<div id="collapse6" class="panel-collapse collapse"> <!-- inicio de collapse6 -->
				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Nombres</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_nombres_otroContacto" id="frm_nombres_otroContacto" class="form-control" placeholder="Nombres" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_otroContacto" id="frm_AP_otroContacto" class="form-control" placeholder="Apellido Paterno" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_otroContacto" id="frm_AM_otroContacto" class="form-control" placeholder="Apellido Materno" value="">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Parentesco</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_parentesco" name="frm_parentesco" class="form-control">
							<option value="">Seleccione Parentesco</option>
							<option value="0" > No Informado </option>
							<option value="8" > Abuelo(a) </option>
							<option value="11"> Conviviente </option>
							<option value="10"> Conyuge </option>
							<option value="16"> Cuñado(a) </option>
							<option value="5" > Hermano(a) </option>
							<option value="4" > Hijo(a) </option>
			                <option value="1" > Jefe / Jefa de Hogar </option>
			                <option value="3" > Madre </option>
			                <option value="6" > Nieto(a) </option>
			                <option value="17"> No Pariente </option>
			                <option value="13"> Nuera / Yerno </option>
			                <option value="15"> Padrastro / Madrastra </option>
			                <option value="2" > Padre </option>
			                <option value="9" > Primo(a) </option>
			                <option value="12"> Sobrino(a) </option>
			                <option value="14"> Suegro (a) </option>
			                <option value="7" > Tío(a) </option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Teléfono</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_telefono_otroContacto" id="frm_telefono_otroContacto" class="form-control" placeholder="Teléfono" value="">
					</div>
				</div>
			</div> <!-- fin de collapse4 -->
		</div>
	</div><!-- Cierre del Segundo form-group col-md-6 -->
</div> <!-- Cierre del Primer Row -->
</form>

