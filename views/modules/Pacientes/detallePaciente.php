<?php
	session_start();
	require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
	require_once('../../../class/Util.class.php');             $objUtil           = new Util;
	require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
	require_once('../../../class/Comuna.class.php');     	   $objComuna   	  = new Comuna;
	require_once('../../../class/Nacionalidad.class.php');     $objNacionalidad   = new Nacionalidad;
	require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
	require_once('../../../class/Convenio.class.php');         $objConvenio       = new Convenio;
	require_once('../../../class/Extranjero.class.php');       $objDocExtra       = new Extranjero;
	require_once('../../../class/Fallecido.class.php');        $objFallecido      = new Fallecido;
	require_once('../../../class/Localidad.class.php');        $objLocalidad      = new Localidad;
	require_once('../../../class/Sector.class.php');           $objSector         = new Sector;
	require_once('../../../class/Etnia.class.php');            $objEtnia          = new Etnia;

	$parametros                                          = $objUtil->getFormulario($_POST);
	$parametros['frm_id_paciente']                       = $parametros['id'];
	$cargarEtnia       									 = $objEtnia->listarEtnia($objCon);
	$datos                                               = $objPac->listarPaciente($objCon,$parametros);
	$cargarComunas                                       = $objComuna->listarComuna($objCon,$parametros);
	$cargarNacionalidad                                  = $objNacionalidad->listarNacionalidad($objCon,$parametros);
	$cargarPrevision                                     = $objPrevision->listarPrevision($objCon,$parametros);
	$cargarPrevisionSinFonasas                           = $objPrevision->listarPrevisionSinFonasa($objCon);
	$cargarConvenio                                      = $objConvenio->listarConvenio($objCon,$parametros);
	$cargarDocExtra                                      = $objDocExtra->listarDocumentoExtranjero($objCon,$parametros);
	$datosRip                                            = $objFallecido->listarInfoFallecido($objCon,$parametros);
	$EdadRip                                             = $objFallecido->calcularEdadFallecido($objCon,$parametros);
	$cargarRegiones                    					 = $objLocalidad->listarRegiones($objCon);
	$cargarCiudades                    					 = $objLocalidad->listarCiudades($objCon);
	$cargarComunas                     					 = $objLocalidad->listarComunas($objCon);
	$cargarSectorDomicilio             					 = $objSector->listarSectorDomicilio($objCon);

	$_SESSION['modulos']["Paciente"]["detalle_Paciente"] = $parametros;
	$_SESSION['modulos']["Paciente"]["datos"]            = $datos;	
	$dias_transcurridos=$objUtil->diasTranscurridos($datos[0]["act_fonasa_fecha"],date("Y-m-d"));
	//echo "la diferencia de dias es ". $dias_transcurridos ;
	// highlight_string(print_r($datos));
	$objCon                                              = null;
?>

<input type="hidden" name="ciudad"      id="ciudad"      value="<?=$datos[0]["ciudad"]?>">
<input type="hidden" name="comuna"      id="comuna"      value="<?=$datos[0]["idcomuna"]?>">


<style>
	.SumoSelect > .CaptionCont {
		width: 287px !important;
	}	

	.col-sm-4 {
		width: 33.333333% !important;
	}
</style>
<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/detallePacienteNew.js?v=0.0.24"></script>
<!-- <input type="text" value="<?=$EdadRip[0]['EDAD']?>"> -->
<div class="row">
	<div class="col-lg-12">
		<div class="btn_volver">
			<button id="btnVolver1" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
		</div>
		<h3 class="titulos">
			<span>Detalle Paciente (ID: <label id="FOLIO"> <?php echo $parametros['frm_id_paciente'];?> </label> )</span>
		</h3>
	</div>
</div>
<form id="frm_indicePaciente" class="formularios" name="frm_indicePaciente" role="form" method="POST">
<div class="row" id="contenedor1" style="margin-left: 4%;margin-right: 4%;"> <!-- Primer Row -->
	<div class=" form-group col-md-6"> <!-- Primer form-group col-md-6 -->
		<?if($datos[0]['fallecido']=="S"){?>
			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png">
				<span>
					Datos Demográfico del Paciente Fallecido &nbsp; 
					<img src="/indice_paciente_2017/assets/img/cruz.png" height="13" width="10"> &nbsp;
					(<?=date("d/m/Y", strtotime($datos[0]['fechanac']));?> - <?=date("d/m/Y", strtotime($datosRip[0]['fal_fecha_difuncion']))?>)
				</span>
			</h3>
		<?}else{?>
			<!-- <h3 class="titulos"><span>Información del Paciente</span></h3> -->
			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png">
				<span>Datos Demográfico</span>
			</h3>
		<?}?>
		
		<!-- <br> -->
		<div class="row" hidden>
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Extranjero</label>
			</div>
			<div class="form-group col-lg-5">
				<input type="checkbox" id="frm_extranjero" name="frm_extranjero" disabled <?php if($datos[0]['extranjero']=="S") echo "checked";?>>
				<input type="text" hidden id="frm_checkExtranjero" name="frm_checkExtranjero" value="<?=$datos[0]['extranjero']?>">
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
						<input class="form-control" id="frm_rut_pac" name="frm_rut_pac" 
							<?if($datos[0]['rut']!=0){?>
								disabled value="<?=$objUtil->formatearNumero($datos[0]['rut'])."-".$objUtil->generaDigito($datos[0]['rut'])?>"
							<?}else{?>
								value="<?=$datos[0]['rut']?>" placeholder="12345678-k"
							<?}?> 
						>
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					</div>
				</div>
			</div>			
		</div>

		<div class="row" id="divDocumento" hidden>
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Documento</label>
			</div>
			<div class="form-group col-lg-3">
				<select id="frm_documento" name="frm_documento" class="form-control" disabled>
					<option value="">Seleccione Documento</option>
					<?php for ($i=0; $i<count($cargarDocExtra) ; $i++) {?>
						<option value="<?=$cargarDocExtra[$i]['id_doc_extranjero']?>" <?if($datos[0]["id_doc_extranjero"]==$cargarDocExtra[$i]['id_doc_extranjero']){echo "selected";}?>>
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
			<div class="form-group col-lg-3">
				<input class="form-control" id="frm_nroDocumento" name="frm_nroDocumento" 
				<?if($datos[0]["rut_extranjero"]!=0){?> 
					value="<?=$datos[0]["rut_extranjero"]?>" disabled
				<?}else{?>
					value="<?=$datos[0]["rut_extranjero"]?>"
				<?}?>
			>
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
						<input name="frm_nroFicha" id="frm_nroFicha" class="form-control" placeholder="Nro de Ficha" disabled value="<?=$datos[0]['nroficha']?>">
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
						<input name="frm_nombres" id="frm_nombres" class="form-control" placeholder="Nombre del Paciente" value="<?=$datos[0]['nombres']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
						<input name="frm_AP" id="frm_AP" class="form-control" placeholder="Apellido Paterno" value="<?=$datos[0]['apellidopat']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
						<input name="frm_AM" id="frm_AM" class="form-control" placeholder="Apellido Materno" value="<?=$datos[0]['apellidomat']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
					<input hidden type="text" name="PacienteFallecido" id="PacienteFallecido" value="<?=$datos[0]['fallecido']?>"> <!-- paciente fallecido -->
					<div class='input-group date' id="datePickerREC">
						<input type='text' class="form-control" name="frm_Naciemito" id="frm_Naciemito" 
						<?if($datos[0]['fechanac']==0000-00-00){?> 
							value="<?=date("d/m/Y")?>" 
						<?}else{?> 
							value="<?=date("d-m-Y", strtotime($datos[0]['fechanac']));?>" 
						<?}?> 
						placeholder="DD/MM/YY" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> />

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
				<?if($datos[0]['fallecido']=="S"){?>
					<label class="encabezado">Datos de Defunción</label>
				<?}else{?>
					<label class="encabezado">Edad</label>
				<?}?>
			</div>
			<div class="form-group col-lg-4">
				<label id="labelEdad">
				<?if($datos[0]['fechanac']==0000-00-00){?>
					<?=$objUtil->edadActualCompleto(date("Y-m-d"))?>
				<?}else{?>
					<?if($datos[0]['fallecido']=="S"){?>						
						<label>(<a href="#" id="cruz" class="item-menu" data-toggle="tooltip" data-placement="right" title="Mas Información">Fallecido</a>)</label>
					<?}else{?>
							<?=$objUtil->edadActualCompleto($datos[0]['fechanac'])?>
						<?}?>
					<?}?>
			</label>	
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Sexo</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_sexo" name="frm_sexo" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					<option value="">Seleccione Sexo</option>
					<option value="M" <?if($datos[0]["sexo"]=="M"){	echo "selected";}?> >MASCULINO</option>
                    <option value="F" <?if($datos[0]["sexo"]=="F"){	echo "selected";}?> >FEMENINO</option>
                    <option value="O" <?if($datos[0]["sexo"]=="O"){	echo "selected";}?> >INDETERMINADO</option>
                    <option value="D" <?if($datos[0]["sexo"]=="D"){	echo "selected";}?> >DESCONOCIDO</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Estado Civil</label>
			</div>
			<div class="form-group col-lg-4">
				<select id="frm_estadoCivil" name="frm_estadoCivil" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					<option value="">Seleccione Estado Civil</option>
					<option value="2" <?if($datos[0]["estadocivil"]=="2"){	echo "selected";}?> >CASADA(O)</option>
					<option value="5" <?if($datos[0]["estadocivil"]=="5"){	echo "selected";}?> >CONVIVIENTE</option>
					<option value="7" <?if($datos[0]["estadocivil"]=="7"){	echo "selected";}?> >DESCONOCIDO</option>
					<option value="6" <?if($datos[0]["estadocivil"]=="6"){	echo "selected";}?> >DIVORCIADA(O)</option>
					<option value="4" <?if($datos[0]["estadocivil"]=="4"){	echo "selected";}?> >SEPARADA(O)</option>
					<option value="1" <?if($datos[0]["estadocivil"]=="1"){	echo "selected";}?> >SOLTERA(O)</option>
					<option value="3" <?if($datos[0]["estadocivil"]=="3"){	echo "selected";}?> >VIUDA(O)</option>
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
				<select id="frm_nacionalidad" name="frm_nacionalidad" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					<option value="">Seleccione Nacionalidad</option>
					<option value="NOI" <?if($datos[0]["nacionalidad"]=="NOI"){	echo "selected";}?>>NO INFORMADA</option>
					<?php for($i=0; $i<count($cargarNacionalidad); $i++){?>
					<option value="<?=$cargarNacionalidad[$i]['NACcodigo']?>" <?if($datos[0]["nacionalidad"]==$cargarNacionalidad[$i]['NACcodigo']){echo "selected";}?>>
								   <?=$cargarNacionalidad[$i]['NACdescripcion']?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Pais Nacimiento</label>
			</div>
			<div class="form-group col-lg-4">
				<!-- <select id="frm_nacionalidad" name="frm_nacionalidad" class="form-control sumoNacionalidad"> -->
				<select id="frm_paisNacimiento" name="frm_paisNacimiento" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					<option value="">Seleccione País Nacimiento</option>
					<option value="NOI" <?if($datos[0]["paisNacimiento"]=="NOI"){	echo "selected";}?>>NO INFORMADA</option>
					<?php for($i=0; $i<count($cargarNacionalidad); $i++){?>
					<option value="<?=$cargarNacionalidad[$i]['NACcodigo']?>" <?if($datos[0]["paisNacimiento"]==$cargarNacionalidad[$i]['NACcodigo']){echo "selected";}?>>
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
				<select id="frm_etnia" name="frm_etnia" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
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
				<input type="checkbox" id="frm_afro" name="frm_afro" value="1" <?php if($datos[0]['PACafro']==1) echo "checked";?> <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-xs-6 col-md-2"></div>
			<div class="col-xs-6 col-md-7">
				<div div class="row">
					<center>
						<?if($datos[0]['fallecido']!="S"){?>
						<button id="btnActualizarDatos" type="button" class="btn btn-primary" alt="" title="" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Actualizar Datos</button>
						<?}?>
						<button id="btnNuevoPaciente"   type="button" class="btn btn-primary" alt="" title="" ><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Paciente</button>
						<!-- <button id="btnBuscar"          type="button" class="btn btn-primary" alt="" title="" ><i class="fa fa-search" aria-hidden="true"></i> Buscar</button> -->
						<?if($datos[0]['fallecido']!="S"){?>
						<button id="btnFallecido"       type="button" class="btn btn-primary" alt="" title="" ><i class="fa fa-adjust" aria-hidden="true"></i> Estado Paciente</button>
						<?}?>
					</center>
				</div>
			</div>
			<div class="col-xs-6 col-md-2"></div>
		</div>

		</div> <!-- Cierre del primer form-group col-md-6 -->

		<div class=" form-group col-md-6"> <!-- Segundo form-group col-md-6 -->	
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
						<?if($datos[0]["prevision"]==0 || $datos[0]["prevision"]==1 || $datos[0]["prevision"]==2 || $datos[0]["prevision"]==3){?>
							<select id="frm_prevision" name="frm_prevision" class="form-control" disabled <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
								<option value="">Seleccione Previsión</option>
								<?php for($i=0; $i<count($cargarPrevision); $i++){?>
								<option value="<?=$cargarPrevision[$i]['id']?>" <?if($datos[0]["prevision"]==$cargarPrevision[$i]['id']){echo "selected";}?> >
									<?=$cargarPrevision[$i]['prevision']?>
								</option>
								<?php }}else{?>
											 <?if($datos[0]["prevision"]!=0 || $datos[0]["prevision"]!=1 || $datos[0]["prevision"]!=2 || $datos[0]["prevision"]!=3){?>
											 	<select id="frm_prevision" name="frm_prevision" class="form-control">
											 		<option value="">Seleccione Prevision</option>
											 			<?php for($i=0; $i<count($cargarPrevisionSinFonasas); $i++){?>
											 			<option value="<?=$cargarPrevisionSinFonasas[$i]['id']?>" <?if($datos[0]["prevision"]==$cargarPrevisionSinFonasas[$i]['id']){echo "selected";}?> >
                                                        			   <?=$cargarPrevisionSinFonasas[$i]['prevision']?>
                                                    	</option>
                                                    	<?}?>
											 		</select>
											 	</select>
										<?}}?>
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
						<select id="frm_convenio" name="frm_convenio" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
							<option value="">Seleccione Convenio</option>
							<?php for($i=0; $i<count($cargarConvenio); $i++){?>
							<option value="<?=$cargarConvenio[$i]['instCod']?>" <?if($datos[0]["conveniopago"]==$cargarConvenio[$i]['instCod']){echo "selected";}?> >
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
						<input type="checkbox" id="frm_prais" name="frm_prais" value="1" <?php if($datos[0]['prais']==1) echo "checked";?> <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>
				<!-- <input type="text" name="fechaFonasaValidar" id="fechaFonasaValidar" value="<?=$datos[0]["act_fonasa_fecha"]?>"> -->
				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<?if($datos[0]["act_fonasa_fecha"] == "0000-00-00"){?>
						<div class="alert alert-success">					
							<center>
								<strong>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								</strong>
								&nbsp;&nbsp;&nbsp; Actualizar Prevision 								
								<?if($dias_transcurridos>=1){?> 
								&nbsp;&nbsp;&nbsp; <img src="/indice_paciente_2017/assets/img/fonasa/Logo_de_Fonasa.png" id="verificarPrevision" style="cursor: pointer;" /> 
								<? } ?> 
							</center>
						</div>
					<?}else{?>
					<?if($datos[0]["act_fonasa_fecha"]){?>

						<div class="alert alert-success">					
							<center>
								<strong>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								</strong>
								&nbsp;&nbsp;&nbsp; Previsión Actualizada el día 
								<label id="fonasaFecha"><?=$objUtil->cambiarFormatoFecha($datos[0]["act_fonasa_fecha"])?></label> a las 
								<label id="fonasaHora"><?=$datos[0]["act_fonasa_hrs"]?></label>. Nro Folio <label id="fonasaFolio"><?=$datos[0]["act_fonasa_folio"]?><label> 
								<?if($dias_transcurridos>=1){?> 
								&nbsp;&nbsp;&nbsp; <img src="/indice_paciente_2017/assets/img/fonasa/Logo_de_Fonasa.png" id="verificarPrevision" style="cursor: pointer;" /> 
								<? } ?> 
							</center>
						</div>
					<?}else{?>
						<?if($datos[0]["act_fonasa_fecha"]==""){?>

						<div class="alert alert-warning" id="divWarning">
							<center>							
								<strong>
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								</strong> La Prevision NO registra fecha de Actualizacion.
							</center>							
						</div>
						
						
						<div class="alert alert-success" id="divSuccess" hidden="true">					
							<center>
								<strong>
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
								</strong>
								&nbsp;&nbsp;&nbsp; Previsión Actualizada el día 
								<label id="fonasaFecha"><?=$objUtil->cambiarFormatoFecha($datos[0]["act_fonasa_fecha"])?></label> a las 
								<label id="fonasaHora"><?=$datos[0]["act_fonasa_hrs"]?></label>. Nro Folio <label id="fonasaFolio"><?=$datos[0]["act_fonasa_folio"]?><label> 
								<?if($dias_transcurridos>=1){?> 
								&nbsp;&nbsp;&nbsp; <img src="/indice_paciente_2017/assets/img/logo_fonasa.gif" style="cursor: pointer;" id="verificarPrevision" /> 
								<? } ?> 
							</center>
						</div> 
												
					<?}?><?}}?>
					
				</div>
			</div> <!-- Fin de collapse2 -->

			<h3 class="titulos">
				<img src="/indice_paciente_2017/assets/img/arrow.png" data-toggle="collapse" href="#collapse1" style="cursor: pointer;">
				<span>Datos Localización y Contacto</span>
			</h3>
									
			
			<div id="collapse1" class="collapse in">							
				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Región</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_regionIndicePaciente" name="frm_regionIndicePaciente" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
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
						<input name="frm_nombreCalleIndicePaciente" id="frm_nombreCalleIndicePaciente" class="form-control" placeholder="Nombre Calle" value="<?=$datos[0]['calle']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Número Dirección</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_numeroDireccionIndicePaciente" id="frm_numeroDireccionIndicePaciente" class="form-control" placeholder="Número Direccion" value="<?=$datos[0]['numero']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Resto Dirección</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_direccion" id="frm_direccion" class="form-control" placeholder="Reesto de Dirección" value="<?=$datos[0]['direccion']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Sector Domicilio</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_sectorDomicilioIndicePaciente" name="frm_sectorDomicilioIndicePaciente" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
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
						<select id="frm_tipoDomicilioIndicePaciente" name="frm_tipoDomicilioIndicePaciente" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>> 
							<option value='U' <?if($datos[0]["conruralidad"]=="U"){ echo "selected";}?>>Urbano</option>
							<option value='R' <?if($datos[0]["conruralidad"]=="R"){ echo "selected";}?>>Rural</option>                           
						</select>
					</div><!-- fin del input-group -->
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Centro de Atención Primaria</label>
					</div>
					<div class="form-group col-lg-5">
						<!-- <select id="frm_centroAtencion" name="frm_centroAtencion" class="form-control sumoAtencion"> -->
						<select id="frm_centroAtencion" name="frm_centroAtencion" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
							<option value="">Seleccione Centro</option>
							<option value='17' <?if($datos[0]["centroatencionprimaria"]=="17"){	echo "selected";}?> >Consultorio DIPRECA</option>
							<option value='1'  <?if($datos[0]["centroatencionprimaria"]=="1"){	echo "selected";}?> >Consultorio Dr. Amador Neghme</option>
							<option value='2'  <?if($datos[0]["centroatencionprimaria"]=="2"){	echo "selected";}?> >Consultorio Dr. Remigio Sapunar</option>
							<option value='3'  <?if($datos[0]["centroatencionprimaria"]=="3"){	echo "selected";}?> >Consultorio Dr. Victor Bertin Soto</option>
							<option value='4'  <?if($datos[0]["centroatencionprimaria"]=="4"){	echo "selected";}?> >Consultorio Dra. Iris Véliz</option>
							<option value='5'  <?if($datos[0]["centroatencionprimaria"]=="5"){	echo "selected";}?> >Consultorio Putre</option>
							<option value='18' <?if($datos[0]["centroatencionprimaria"]=="18"){	echo "selected";}?> >Eugenio Petruccelli</option>
							<option value='6'  <?if($datos[0]["centroatencionprimaria"]=="6"){	echo "selected";}?> >Hospital Hjn Procedimiento</option>
							<option value='7'  <?if($datos[0]["centroatencionprimaria"]=="7"){	echo "selected";}?> >Policlínico Estudiantil U. De Tarapacá</option>
							<option value='8'  <?if($datos[0]["centroatencionprimaria"]=="8"){	echo "selected";}?> >Policlínico JUNAEB</option>
							<option value='9'  <?if($datos[0]["centroatencionprimaria"]=="9"){	echo "selected";}?> >Posta Rural De Alcérreca</option>
							<option value='10' <?if($datos[0]["centroatencionprimaria"]=="10"){	echo "selected";}?> >Posta Rural De Belén</option>
							<option value='11' <?if($datos[0]["centroatencionprimaria"]=="11"){	echo "selected";}?> >Posta Rural De Codpa</option>
							<option value='12' <?if($datos[0]["centroatencionprimaria"]=="12"){	echo "selected";}?> >Posta Rural De Poconchile</option>
							<option value='13' <?if($datos[0]["centroatencionprimaria"]=="13"){	echo "selected";}?> >Posta Rural De San Miguel</option>
							<option value='14' <?if($datos[0]["centroatencionprimaria"]=="14"){	echo "selected";}?> >Posta Rural De Sobraya</option>
							<option value='15' <?if($datos[0]["centroatencionprimaria"]=="15"){	echo "selected";}?> >Posta Rural De Ticnamar</option>
							<option value='16' <?if($datos[0]["centroatencionprimaria"]=="16"){	echo "selected";}?> >Posta Rural De Visviri</option>
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
								<input name="frm_telefonoFijo" id="frm_telefonoFijo" class="form-control" placeholder="Teléfono Fijo" value="<?=$datos[0]['PACfono']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Teléfono Celular</label>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="input-group col-lg-12">
								<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
								<span class="input-group-addon">+56 9</span>
								<input name="frm_telefonoCelular" id="frm_telefonoCelular" class="form-control" placeholder="Teléfono Celular" value="<?=$datos[0]['fono1']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
								<input name="frm_frm_otrosTelefonosIndicePaciente" id="frm_otrosTelefonosIndicePaciente" class="form-control" placeholder="Otros Teléfonos" value="<?=$datos[0]['PACfonoOtros']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
								<input name="frm_email" id="frm_email" class="form-control" placeholder="Email" value="<?=$datos[0]['email']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
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
								<input name="frm_telefonoFijoAvis" id="frm_telefonoFijoAvis" class="form-control" placeholder="Teléfono Fijo Avis" value="<?=$datos[0]['PACcelular']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
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
								<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
								<input name="frm_telefonoCelularAvis" id="frm_telefonoCelularAvis" class="form-control" placeholder="Teléfono Celular Avis" value="<?=$datos[0]['fono2']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
							</div>
						</div>
					</div>
				</div>

			</div><!-- Fin de collapse1 -->

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
						<input name="frm_ocupacionLaboral" id="frm_ocupacionLaboral" class="form-control" placeholder="Ocupación Laboral" value="<?=$datos[0]['ocupacion']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Lugar de Trabajo</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_lugarTrabajo" id="frm_lugarTrabajo" class="form-control" placeholder="Lugar de Trabajo" value="<?=$datos[0]['lugartrabajo']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row" id="contenedor2">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Dirección</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_direccion_laboral" id="frm_direccion_laboral" class="form-control" placeholder="Dirección de Trabajo" value="<?=$datos[0]['direcciontrabajo']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Teléfono</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_telefono_laboral" id="frm_telefono_laboral" class="form-control" placeholder="Teléfono de Trabajo" value="<?=$datos[0]['fono3']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row" >
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Comuna</label>
					</div>
					<div class="form-group col-lg-5">
						<!-- <select id="frm_comunaLaboral" name="frm_comunaLaboral" class="form-control sumoComunaLaboral"> -->
						<select id="frm_comunaLaboral" name="frm_comunaLaboral" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
							<option value="">Seleccione Comuna</option>
							<?php for($i=0; $i<count($cargarComunas); $i++){?>
							<option value="<?=$cargarComunas[$i]['id']?>" <?if($datos[0]["comunatrabajo"]==$cargarComunas[$i]['id']){echo "selected";}?>>
								<?=$cargarComunas[$i]['comuna']?>
							</option>
							<?php }?>
						</select>
					</div>
				</div>
			</div> <!-- fin de collapse3 -->

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
						<input name="frm_NombresPadre" id="frm_NombresPadre" class="form-control" placeholder="Nombres" value="<?=$datos[0]['nombrespadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_Padre" id="frm_AP_Padre" class="form-control" placeholder="Apellido Paterno" value="<?=$datos[0]['apellidopatpadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>

				<div class="row" id="contenedor3">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_Padre" id="frm_AM_Padre" class="form-control" placeholder="Apellido Materno" value="<?=$datos[0]['apellidomatpadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>
			</div> <!-- fin de collapse4 -->

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
						<input name="frm_NombresMadre" id="frm_NombresMadre" class="form-control" placeholder="Nombres" value="<?=$datos[0]['nombresmadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_Madre" id="frm_AP_Madre" class="form-control" placeholder="Apellido Paterno" value="<?=$datos[0]['apellidopatmadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_Madre" id="frm_AM_Madre" class="form-control" placeholder="Apellido Materno" value="<?=$datos[0]['apellidomatmadre']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
					</div>
				</div>
			</div><!-- Fin de collapse5 -->

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
						<input name="frm_nombres_otroContacto" id="frm_nombres_otroContacto" class="form-control" placeholder="Nombres" value="<?=$datos[0]['nombrescontacto']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Paterno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AP_otroContacto" id="frm_AP_otroContacto" class="form-control" placeholder="Apellido Paterno" value="<?=$datos[0]['apellidopatcontacto']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Apellido Materno</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_AM_otroContacto" id="frm_AM_otroContacto" class="form-control" placeholder="Apellido Materno" value="<?=$datos[0]['apellidomatcontacto']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Parentesco</label>
					</div>
					<div class="form-group col-lg-5">
						<select id="frm_parentesco" name="frm_parentesco" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
							<option value="">Seleccione Parentesco</option>
							<option value="0"  <?if($datos[0]["tipocontacto"]=="0"){	echo "selected";}?> > No Informado </option>
							<option value="8"  <?if($datos[0]["tipocontacto"]=="8"){	echo "selected";}?> > Abuelo(a) </option>
							<option value="11" <?if($datos[0]["tipocontacto"]=="11"){	echo "selected";}?> > Conviviente </option>
							<option value="10" <?if($datos[0]["tipocontacto"]=="10"){	echo "selected";}?> > Conyuge </option>
							<option value="16" <?if($datos[0]["tipocontacto"]=="16"){	echo "selected";}?> > Cuñado(a) </option>
							<option value="5"  <?if($datos[0]["tipocontacto"]=="5"){	echo "selected";}?> > Hermano(a) </option>
							<option value="4"  <?if($datos[0]["tipocontacto"]=="4"){	echo "selected";}?> > hijo(a) </option>
			                <option value="1"  <?if($datos[0]["tipocontacto"]=="1"){	echo "selected";}?> > Jefe / Jefa de Hogar </option>
			                <option value="3"  <?if($datos[0]["tipocontacto"]=="3"){	echo "selected";}?> > Madre </option>
			                <option value="6"  <?if($datos[0]["tipocontacto"]=="6"){	echo "selected";}?> > Nieto(a) </option>
			                <option value="17" <?if($datos[0]["tipocontacto"]=="17"){	echo "selected";}?> > No Pariente </option>
			                <option value="13" <?if($datos[0]["tipocontacto"]=="13"){	echo "selected";}?> > Nuera / Yerno </option>
			                <option value="15" <?if($datos[0]["tipocontacto"]=="15"){	echo "selected";}?> > Padrastro / Madrastra </option>
			                <option value="2"  <?if($datos[0]["tipocontacto"]=="2"){	echo "selected";}?> > Padre </option>
			                <option value="9"  <?if($datos[0]["tipocontacto"]=="9"){	echo "selected";}?> > Primo(a) </option>
			                <option value="12" <?if($datos[0]["tipocontacto"]=="12"){	echo "selected";}?> > Sobrino(a) </option>
			                <option value="14" <?if($datos[0]["tipocontacto"]=="14"){	echo "selected";}?> > Suegro (a) </option>
			                <option value="7"  <?if($datos[0]["tipocontacto"]=="7"){	echo "selected";}?> > Tío(a) </option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
					<div class="form-group col-lg-4">
						<label class="encabezado">Teléfono</label>
					</div>
					<div class="form-group col-lg-5">
						<input name="frm_telefono_otroContacto" id="frm_telefono_otroContacto" class="form-control" placeholder="Teléfono" value="<?=$datos[0]['telefonocontacto']?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
					</div>
				</div>
			</div><!-- FIN de collapse6 -->
		</div><!-- Cierre del Segundo form-group col-md-6 -->		
</div> <!-- Cierre del Primer Row -->
</form>

