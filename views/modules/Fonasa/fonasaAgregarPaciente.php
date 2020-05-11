<?php
session_start();
require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
require_once('../../../class/Util.class.php');             $objUtil           = new Util;
require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
// ini_set('max_execution_time', 600); //300 seconds = 5 minutes 
// 		ini_set('memory_limit', '128M'); 
$parametros                   = $objUtil->getFormulario($_POST);
$parametros["datosFonasa"]    = json_decode(stripslashes($parametros["datosFonasa"]),true);
$parametros['frm_rut']        = $parametros["datosFonasa"]["beneficiario"]["ben_rut_sdv"];
$datos                        = $objPac->listarPaciente($objCon, $parametros);


//highlight_string(print_r($parametros["datosFonasa"]),true);
// require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
// $parametros                              = $objUtil->getFormulario($_POST);
// $parametros['frm_id_paciente']           = $parametros['id'];
// $datos                                   = $objPac->listarPaciente($objCon,$parametros);
// $cargarPrevision                         = $objPrevision->listarPrevision($objCon,$parametros);
// $_SESSION['modules']["Fonasa"]["Fonasa"] = $parametros;

/*	
	json_encode de PHP a JS
	json_decode de JS  a PHP
*/

// highlight_string(print_r($datos), true);

// highlight_string(print_r($_POST), true);

?>

<style>
	.input-group-addon, .input-group-btn {
		width: 0% !important;		
	}

	/*.input-group-addon {
		position: relative !important;
		left: -27% !important;	
	}

	.input-group .form-control {
		width: 68% !important;
	}*/
</style>

<div class="row">
	<div class="col-lg-12">
		<h3 class="titulos"><span>Certificado de Fonasa</span></h3>
	</div>
</div>

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Fonasa/fonasaAgregarPaciente.js?v=0.0.34"></script>

<br>
<form id="frm_indicePacienteFonasaAgregar" class="formularios" name="frm_indicePacienteFonasaAgregar" role="form" method="POST">
	<input type="" style="opacity: 0; height: 0px;" name="nombre"        	 	id="nombre"        			value="<?=$_SESSION['frm_nombres_dau']?>">
	<input type="" style="opacity: 0; height: 0px;" name="apellidoPa"    	 	id="apellidoPa"   			value="<?=$_SESSION['frm_AP_dau']?>">
	<input type="" style="opacity: 0; height: 0px;" name="apellidoMa"    	 	id="apellidoMa"    			value="<?=$_SESSION['frm_AM_dau']?>">
	<input type="" style="opacity: 0; height: 0px;" name="run" 	      		 	id="run" 	         		value="<?=$_SESSION['frm_rut']?>">
	<input type="" style="opacity: 0; height: 0px;" name="fechaNac"      	 	id="fechaNac"      			value="<?=$_SESSION['frm_Naciemito']?>">
	<input type="" style="opacity: 0; height: 0px;" name="calcularEdad"  	 	id="calcularEdad"  			value="<?=$_SESSION['labelEdad']?>">
	<input type="" style="opacity: 0; height: 0px;" name="sexo"  	      	 	id="sexo"  	     			value="<?=$_SESSION['frm_sexo']?>">
	<input type="" style="opacity: 0; height: 0px;" name="frm_previsionDau"  	id="frm_previsionDau"  		value="<?=$_SESSION['frm_prevision']?>">
	<input type="" style="opacity: 0; height: 0px;" name="idPaciente"  	     	id="idPaciente"  	    	value="<?=$_SESSION['idPacienteDau'];?>"> <!-- este del form -->
	<input type="" style="opacity: 0; height: 0px;" name="id_doc_documento"  id="id_doc_documento"  	value="<?=$_SESSION['id_doc_documentoDau'];?>">

	
	<!-- <input type="" name="id"  	      		id="id"  	    		value="<?=$datos[0]['id'];?>"> -->
	





	<table width="80%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" >
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
					<tr>
						<td width="1%"><img src="/indice_paciente_2017/assets/img/fonasa/borde_L.jpg" width="20" height="25"></td>
						<td width="98%" bgcolor="#0080C0" class="titulo_certificador">&nbsp;<strong>Certificador Previsional</strong></td>
						<td align="right" width="1%"><img src="/indice_paciente_2017/assets/img/fonasa/borde_R.jpg" width="20" height="25"></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td style="border-left:1px solid #06C; border-right:1px solid #06C;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E5F7FF">
					<tr>
						<td width="19%" height="72" align="right"><img src="/indice_paciente_2017/assets/img/fonasa/Logo_de_Fonasa.png" height="60" /></td>
						<td width="61%" align="center" class="sub_titulo_certificador"><strong>CERTIFICACION PARA ATENCION DE SALUD</strong></td>
						<td width="22%" align="center" valign="middle" style="width: 15%;"><img src="/indice_paciente_2017/assets/img/fonasa/logo_hospital.png" style="width: 50%;"/></td>
					</tr>
					<tr>
						<td height="25">&nbsp;</td>
						<td colspan="2" align="right" valign="middle" class="tit7">
							Nro Folio: <samp class="folio"><strong>
								<label id="FOLIO"><?=$parametros["datosFonasa"]["beneficiario"]["folio"]?></label></strong></samp>&nbsp;&nbsp;<input type="hidden" name="frm_idFolio" id="frm_idFolio" value="<?=$parametros["datosFonasa"]["beneficiario"]["folio"]?>">
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td height="33" align="center" valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C; color:#006699">
				<strong>
					<!-- <?=$certificado?> -->
					<center><?=$parametros["datosFonasa"]["certificado"]["cerFonasa"]?></center>
				</strong>
			</td>
		</tr>

		<tr>
			<td height="33"  valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C;">
				<table width="100%" border="0" cellspacing="0"  >
					<tr class="tit7">
						<td width="24" rowspan="4" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
							<img src="/indice_paciente_2017/assets/img/fonasa/imgbar01.jpg"/>
						</td>
						<td width="67" height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-top:1px solid #99E0FF;">
							<strong style="color: #006699;">Nombres</strong>
						</td>
						<td width="140" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF; color: #006699;">
							<!-- <?=$ben_nombres?>  -->
							<input type="hidden" id="frm_nombreBeneficiario" name="frm_nombreBeneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["nombres"]?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["nombres"]?>
						</td>
						<td width="77" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; color: #006699;">
							<strong style="color: #006699;">A. Paterno</strong>
						</td>
						<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF; color: #006699;">
							<!-- <?=$ben_apell1?> -->
							<input type="hidden" id="frm_apell1Beneficiario" name="frm_apell1Beneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["apell1"]?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["apell1"]?>
						</td>
						<td width="78" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; color: #006699;">
							<strong style="color: #006699;">A. Materno</strong>
						</td>
						<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF; color: #006699;">
							<!-- <?=$ben_apell2?> -->
							<input type="hidden" id="frm_apell2Beneficiario" name="frm_apell2Beneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["apell2"]?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["apell2"]?>
						</td>
					</tr>

					<tr class="tit7">
						<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; color: #006699;">
							<strong style="color: #006699;">Rut</strong>
						</td>
						<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
							<!-- <?=$ben_rut?> -->
							<input type="hidden" id="frm_rutBeneficiario" name="frm_rutBeneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["rut"]?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["rut"]?>
						</td>
						<td bgcolor="#E5F7FF">
							<strong style="color: #006699;">Fecha Nac.</strong>
						</td>
						<td style="border-bottom:1px solid #CCF0FF; color: #006699; ">
							<input type="hidden" id="frm_fechaNacimientoBeneficiario" name="frm_fechaNacimientoBeneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]?>">
							<?=date("d-m-Y",strtotime($parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]));?>
							<!-- <?=$parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]?> -->
						</td>
						<td bgcolor="#E5F7FF">
							<strong style="color: #006699;">Sexo</strong>
						</td>
						<td style="border-bottom:1px solid #CCF0FF; color: #006699;"; >
							<input type="hidden" id="frm_sexoBeneficiario" name="frm_sexoBeneficiario" value="<? switch ($parametros["datosFonasa"]["beneficiario"]["sexo"]) {
								case 'MASCULINO':
									echo "M";
								break;
								
								case 'FEMENINO':
									 echo "F";
								break;

								case 'Masculino':
									 echo "M";
								break;

								case 'Femenino':
									echo "F";
								break;
							}?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["sexo"]?>
						</td>
					</tr>

					<tr class="tit7">
						<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
							<strong style="color: #006699;">Direccion</strong>
						</td>
						<td style="border-bottom:1px solid #CCF0FF; color: #006699;" colspan="5">
							<!-- <?=$ben_direccion?> -->
							<input type="hidden" id="frm_direccionBeneficiario" name="frm_direccionBeneficiario" value="<?=$parametros["datosFonasa"]["beneficiario"]["direccion"]?>">
							<?=$parametros["datosFonasa"]["beneficiario"]["direccion"]?>
						</td>
					</tr>

					<tr>
						<td height="22" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
							&nbsp;
						</td>
						<td style="border-bottom:1px solid #99E0FF;">
						<!-- <input type="hidden" name="tramo" id="tramo" value="<?=$tramo?>" />
						<input type="hidden" name="direccionFonasa" id="direccionFonasa" value="<?=$ben_direccion?>" />
						<input type="hidden" name="folioFonasa" id="folioFonasa" value="<?=$folio?>" />
						<input type="hidden" name="fechaFonasa" id="fechaFonasa" value="<?=$fecha_act_fonasa?>" />
						<input type="hidden" name="horaFonasa" id="horaFonasa"  value="<?=$hrs_act_fonasa?>"/>
						<input type="hidden" name="usuario" id="usuario" value="<?=$usuario?>" /> -->
					</td>
					<td bgcolor="#E5F7FF" style="border-bottom:1px solid #99E0FF;">
						&nbsp;
					</td>
					<td style="border-bottom:1px solid #99E0FF;">
						&nbsp;
					</td>
					<td bgcolor="#E5F7FF" style="border-bottom:1px solid #99E0FF;">
						&nbsp;
					</td>
					<td style="border-bottom:1px solid #99E0FF;">
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height="33"  valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C; border-bottom:1px solid #06C;">
			<table width="100%" border="0" cellspacing="0">
				<tr class="tit7">
					<td width="24" rowspan="4" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
						<img src="/indice_paciente_2017/assets/img/fonasa/imgbar02.jpg"  />
					</td>
					<td width="67" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-top:1px solid #99E0FF;">
						<strong style="color: #006699;">Nombres</strong>
					</td>
					<td width="140" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_nombre?> -->
						<!-- <input type="hidden" name="nombreFonasa" id="nombreFonasa" value="<?=$ben_nombres?>" /> -->
						<?=$parametros["datosFonasa"]["afiliado"]["nombres"]?>
					</td>
					<td width="77" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF;">
						<strong style="color: #006699;">A. Paterno</strong>
					</td>
					
					<td width="124" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_apell1?> -->
						<!-- <input type="hidden" name="paternoFonasa" id="paternoFonasa" value="<?=$ben_apell1?>"/> -->
						<?=$parametros["datosFonasa"]["afiliado"]["apell1"]?>
					</td>
					
					<td width="78" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<strong style="color: #006699;">A. Materno</strong>
					</td>

					<td width="124" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_apell2?> -->
						<!-- <input type="hidden" name="maternoFonasa" id="maternoFonasa" value="<?=$ben_apell2?>" /> -->
						<?=$parametros["datosFonasa"]["afiliado"]["apell2"]?>
					</td>
				</tr>

				<tr class="tit7">
					<td bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
						<strong style="color: #006699;">Rut</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_rut?>
						<input type="hidden" name="rutFonasa" id="rutFonasa" value="" />
						<input type="hidden" name="rut_sdv" id="rut_sdv" value="<?=$rut_sdv?>" /> -->
						<?=$parametros["datosFonasa"]["afiliado"]["rut"]?>
					</td>

					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Fecha Nac.</strong>
					</td>
					
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						<?=date("d-m-Y",strtotime($parametros["datosFonasa"]["afiliado"]["fecnac"]));?>
						<!--<input type="hidden" name="nacimientoFonasa" id="nacimientoFonasa" value="<?=date("d-m-Y",strtotime($ben_fec_nacimiento));?>" /> -->
						<!-- <?=$parametros["datosFonasa"]["afiliado"]["fecnac"]?> -->
					</td>
					
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Grupo I.</strong>						
					</td>
					
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						
						<input type="hidden" name="previsionFonasa" id="previsionFonasa" value="<? switch($parametros["datosFonasa"]["afiliado"]["grupo"]){
						case 'A': echo "0"; break;
						case 'B': echo "1"; break;
						case 'C': echo "2"; break;
						case 'D': echo "3"; break;}
						?>"/> 
						<?=$parametros["datosFonasa"]["afiliado"]["grupo"]?>
					</td>
				</tr>

				<tr class="tit7">
					<td height="23" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;" >
						<strong style="color: #006699;">Sexo</strong>
					</td>

					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_sexo?>
						<input type="hidden" name="sexoFonasa" id="sexoFonasa" value="<?
						switch($ben_sexo){
							case 'MASCULINO': echo "M"; break;
							case 'FEMENINO': echo "F"; break;
							case 'Masculino': echo "M"; break;
							case 'Femenino': echo "F"; break;
						}?>" /> -->
						<?=$parametros["datosFonasa"]["afiliado"]["sexo"]?>
					</td>

					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Estado</strong>
					</td>

					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$afi_estado?> -->
						<?=$parametros["datosFonasa"]["afiliado"]["estado"]?>
					</td>

					<td bgcolor="#E5F7FF">
						&nbsp;
					</td>

					<td style="border-bottom:1px solid #CCF0FF">
						
					</td>
				</tr>

				<? if(!$datos[0]["rut"]){ ?>
				<tr class="tit7">
					<td height="19" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
						<strong style="color: #006699;">Acción</strong>
					</td>

					<td style="border-bottom:1px solid #99E0FF;">
						
					</td>

					<td bgcolor="#E5F7FF">
						&nbsp; 
					</td>

					<td>
						&nbsp; 
					</td>

					<td bgcolor="#E5F7FF">
						&nbsp; 
					</td>

					<!-- <td align="right">
						<button id="btnGuardarPacienteFonasa" type="button" class="btn btn-primary" alt="" title="">
							<i class="fa fa-save" aria-hidden="true"></i></i> Guardar
						</button>
					</td> -->
					<tr align="center">
						<td colspan="7">
							<br>
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Paciente no encontrado ¿Desea crearlo con los datos de Fonasa?.
								<button id="btnGuardarPacienteFonasa" type="button" class="btn btn-warning" alt="" title="">
									<!-- <i class="fa fa-save" aria-hidden="true"></i></i> --> Si
								</button>

								<button id="btnGuardarPacienteFonasaCerrarNo" type="button" class="btn btn-warning" alt="" title="">
									<!-- <i class="fa fa-save" aria-hidden="true"></i></i> --> No
								</button>								
							</div>
						</td>
					</tr>
				</tr>
				<?}else{?>
					<tr class="tit7">
						<td height="19" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
							<strong style="color: #006699;"></strong>
						</td>

						<td style="border-bottom:1px solid #99E0FF;">
							
						</td>

						<td bgcolor="#E5F7FF">
							&nbsp; 
						</td>

						<td>
							&nbsp; 
						</td>

						<td bgcolor="#E5F7FF">
							&nbsp; 
						</td>

						<td align="right">
							<button id="btnGuardarPacienteFonasaEsconder" hidden="hidden" type="button" class="btn btn-primary" alt="" title="">
								<i class="fa fa-save" aria-hidden="true"></i></i> Guardar
							</button>
						</td>
					</tr>

					<tr align="center">
						<td colspan="7">
							<br>
							<div class="alert alert-info">
								<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Este Paciente se encuentra en nuestros Registros.
							</div>
						</td>
					</tr>
				<?}?>						
			</table>			
		</table>			
	</td>
</table>
</tr>
</table>
</form>



