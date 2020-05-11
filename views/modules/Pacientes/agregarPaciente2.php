<?php
session_start();
require_once('../../../class/Connection.class.php'); 	   $objCon            = new Connection; $objCon->db_connect();
require_once('../../../class/Util.class.php');       	   $objUtil           = new Util;
require_once('../../../class/Comuna.class.php');     	   $objComuna   	  = new Comuna;
require_once('../../../class/Nacionalidad.class.php');     $objNacionalidad   = new Nacionalidad;
require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
require_once('../../../class/Convenio.class.php');         $objConvenio       = new Convenio;
require_once('../../../class/Extranjero.class.php');       $objDocExtra       = new Extranjero;
$cargarComunas      = $objComuna->listarComuna($objCon,"");
$cargarNacionalidad = $objNacionalidad->listarNacionalidad($objCon,"");
$cargarPrevision    = $objPrevision->listarPrevision($objCon,"");
$cargarConvenio     = $objConvenio->listarConvenio($objCon,"");
$cargarDocExtra     = $objDocExtra->listarDocumentoExtranjero($objCon,"");
$objCon=null;
?>
<style>
	.SumoSelect > .CaptionCont {
		width: 287px !important;
	}
</style>
<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Pacientes/agregarPaciente.js"></script>
<div class="row">
	<div class="col-lg-12">
		<div class="btn_volver">
			<button id="btnVolver" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
		</div>
		<h3 class="titulos"><span>Nuevo Paciente</span></h3>
	</div>
</div>
<form id="frm_indicePaciente" class="formularios" name="frm_indicePaciente" role="form" method="POST">
	<div class="row">
		<div class="col-md-6" style="background-color: red;">
			<div id="accordion" role="tablist" aria-multiselectable="true">
				<div class="card">
					<div class="card-header" role="tab" id="headingOne">
						<h5 class="mb-0">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<h3 class="titulos"><span>Información Paciente 1</span></h3>
							</a>
						</h5>
					</div>

					<!-- <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"> -->
					<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOnee">
						<div class="card-block">
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
								<div class="form-group col-lg-5">
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
								<div class="form-group col-lg-5">
									<input class="form-control" id="frm_nroDocumento" name="frm_nroDocumento" placeholder="N° Documento">
								</div>
							</div>

							<div class="row" id="divRut">
								<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
								<div class="form-group col-lg-4">
									<label class="encabezado">Rut</label>
								</div>
								<div class="form-group col-lg-3">
									<input class="form-control" id="frm_rut_pac" name="frm_rut_pac" placeholder="12345678-k" value="">
								</div>

			<!-- <div class="form-group col-lg-1">
				<input class="form-control" id="frm_rutDigito_pac" name="frm_rutDigito_pac" value="" disabled="true">
			</div> -->

			<!-- <div>
				<button type="button" class="btn btn-primary" alt="" title="" id="btnPorRut" >Por Rut </button>
			</div> -->
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Ficha</label>
			</div>
			<div class="form-group col-lg-3">
				<input name="frm_nroFicha" id="frm_nroFicha" class="form-control" placeholder="Nro de Ficha" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Nombres</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_nombres" id="frm_nombres" class="form-control" placeholder="Nombre del Paciente" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Apellido Paterno</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_AP" id="frm_AP" class="form-control" placeholder="Apellido Paterno" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Apellido Materno</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_AM" id="frm_AM" class="form-control" placeholder="Apellido Materno" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Dirección</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_direccion" id="frm_direccion" class="form-control" placeholder="Dirección" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Comuna</label>
			</div>
			<div class="form-group col-lg-5">
				<select id="frm_comuna" name="frm_comuna" class="form-control sumoComuna">
					<option value="">Seleccione Comuna</option>
					<?php for($i=0; $i<count($cargarComunas); $i++){?>
					<option value="<?=$cargarComunas[$i]['id']?>">
						<?=$cargarComunas[$i]['comuna']?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Centro de Atención Primaria</label>
			</div>
			<div class="form-group col-lg-5">
				<select id="frm_centroAtencion" name="frm_centroAtencion" class="form-control sumoAtencion">
					<option value="">Seleccione Centro</option>
					<option value='1' >Consultorio Dr. Amador Neghme</option>
					<option value='2' >Consultorio Dr. Remigio Sapunar</option>
					<option value='3' >Consultorio Dr. Victor Bertin Soto</option>
					<option value='4' >Consultorio Dra. Iris Véliz</option>
					<option value='5' >Consultorio Putre</option>
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
					<option value='17'>Consultorio DIPRECA</option>
					<option value='18'>Eugenio Petruccelli</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Fecha de Nacimiento</label>
			</div>
			<div class="form-group col-lg-5">
				<div class='input-group date' id="datePickerREC">
					<input type='text' class="form-control" name="frm_Naciemito" id="frm_Naciemito" value="" placeholder="DD/MM/YY" />
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Sexo</label>
			</div>
			<div class="form-group col-lg-5">
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
			<div class="form-group col-lg-5">
				<select id="frm_estadoCivil" name="frm_estadoCivil" class="form-control">
					<option value="">Seleccione Estado Civil</option>
					<option value="1">SOLTERA(O)</option>
					<option value="2">CASADA(O)</option>
					<option value="3">VIUDA(O)</option>
					<option value="4">SEPARADA(O)</option>
					<option value="5">CONVIVIENTE</option>
					<option value="6">DIVORCIADA(O)</option>
					<option value="7">DESCONOCIDO</option>
				</select>
			</div>
		</div>
	</div>
</div>
</div>

<div class="card">
	<div id="accordion" role="tablist" aria-multiselectable="true">
		<div class="card-header" role="tab" id="headingTwo">
			<h5 class="mb-0">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					<h3 class="titulos"><span>Información Paciente 2</span></h3>
				</a>
			</h5>
		</div>
		<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="card-block">
				<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Email</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_email" id="frm_email" class="form-control" placeholder="Email" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Teléfono Fijo</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_telefonoFijo" id="frm_telefonoFijo" class="form-control" placeholder="Teléfono Fijo" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Teléfono Celular</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_telefonoCelular" id="frm_telefonoCelular" class="form-control" placeholder="Teléfono Celular" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Teléfono Fijo Avis</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_telefonoAvis" id="frm_telefonoCelular" class="form-control" placeholder="Teléfono Fijo Avis" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Teléfono Celular Avis</label>
			</div>
			<div class="form-group col-lg-5">
				<input name="frm_telefonoCelularFijo" id="frm_telefonoCelularFijo" class="form-control" placeholder="Teléfono Celular Avis" value="">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Etnia</label>
			</div>
			<div class="form-group col-lg-5">
				<select id="frm_etnia" name="frm_etnia" class="form-control">
					<option value="">Seleccione Etnia</option>
					<option value="1">SIN ETNIA</option>
					<option value="2">AYMARA</option>
					<option value="3">ALACALUFE</option>
					<option value="4">ATACAMEÑO</option>
					<option value="5">COLLA</option>
					<option value="6">MAPUCHE</option>
					<option value="7">QUECHUA</option>
					<option value="8">RAPANUI</option>
					<option value="9">YAGAN</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Nacionalidad</label>
			</div>
			<div class="form-group col-lg-5">
				<select id="frm_nacionalidad" name="frm_nacionalidad" class="form-control sumoNacionalidad">
					<option value="">Seleccione Nacionalidad</option>
					<option value="NOINF">NO INFORMADA</option>
					<?php for($i=0; $i<count($cargarNacionalidad); $i++){?>
					<option value="<?=$cargarNacionalidad[$i]['nacionalidad']?>">
								   <?=$cargarNacionalidad[$i]['nacionalidadnombre']?>
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

		<div class="row">
			<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
			<div class="form-group col-lg-4">
				<label class="encabezado">Previsión</label>
			</div>
			<div class="form-group col-lg-5">
				<select id="frm_prevision" name="frm_prevision" class="form-control sumoPrevision">
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
			<div class="form-group col-lg-5">
				<select id="frm_convenio" name="frm_convenio" class="form-control sumoConvenio">
					<option value="">Seleccione Convenio</option>
					<?php for($i=0; $i<count($cargarConvenio); $i++){?>
					<option value="<?=$cargarConvenio[$i]['instCod']?>">
								   <?=$cargarConvenio[$i]['instNombre']?>
					</option>
					<?php }?>
				</select>
			</div>
		</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-md-6" style="background-color: yellow;">
		<div class="card">
			<div class="card-header" role="tab" id="headingThree">
				<h5 class="mb-0">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						<h3 class="titulos"><span>Información Laboral</span></h3>
					</a>
				</h5>
			</div>
			<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="card-block">
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

					<div class="row">
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

					<div class="row">
						<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
						<div class="form-group col-lg-4">
							<label class="encabezado">Comuna</label>
						</div>
						<div class="form-group col-lg-5">
							<select id="frm_comunaLaboral" name="frm_comunaLaboral" class="form-control sumoComunaLaboral">
								<option value="">Seleccione Comuna</option>
								<?php for($i=0; $i<count($cargarComunas); $i++){?>
								<option value="<?=$cargarComunas[$i]['id']?>">
									<?=$cargarComunas[$i]['comuna']?>
								</option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" role="tab" id="headingFour">
				<h5 class="mb-0">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						<h3 class="titulos"><span>Datos del Padre</span></h3>
					</a>
				</h5>
			</div>
			<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
				<div class="card-block">
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

					<div class="row">
						<div class="form-group col-lg-1"></div> <!-- Espacio de Margen -->
						<div class="form-group col-lg-4">
							<label class="encabezado">Apellido Materno</label>
						</div>
						<div class="form-group col-lg-5">
							<input name="frm_AM_Padre" id="frm_AM_Padre" class="form-control" placeholder="Apellido Materno" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" role="tab" id="headingFive">
				<h5 class="mb-0">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						<h3 class="titulos"><span>Datos de la Madre</span></h3>
					</a>
				</h5>
			</div>
			<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
				<div class="card-block">
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
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" role="tab" id="headingSix">
				<h5 class="mb-0">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
						<h3 class="titulos"><span>Datos de otro Contacto</span></h3>
					</a>
				</h5>
			</div>
			<div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix">
				<div class="card-block">
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
								<option value="0" > no informado </option>
								<option value="1" > jefe / jefa de hogar </option>
								<option value="2" > padre </option>
								<option value="3" > madre </option>
								<option value="4" > hijo(a) </option>
								<option value="5" > hermano(a) </option>
								<option value="6" > nieto(a) </option>
								<option value="7" > tío(a) </option>
								<option value="8" > abuelo(a) </option>
								<option value="9" > primo(a) </option>
								<option value="10"> conyuge </option>
								<option value="11"> conviviente </option>
								<option value="12"> sobrino(a) </option>
								<option value="13"> nuera / yerno </option>
								<option value="14"> suegro (a) </option>
								<option value="15"> padrastro/madrastra </option>
								<option value="16"> cuñado(a) </option>
								<option value="17"> no pariente </option>
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
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-md-4"></div>
	<div class="col-xs-6 col-md-4">
		<div div class="row">
			<center>
				<button id="btnGuardarPaciente"   type="button" class="btn btn-primary" alt="" title="">Guardar</button>
				<button id="btnBuscar"            type="button" class="btn btn-primary" alt="" title="">Buscar</button>
			</center>
		</div>
	</div>
	<div class="col-xs-6 col-md-4"></div>
</div>
</div>
</form>