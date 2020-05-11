<?php
session_start();
require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
require_once('../../../class/Util.class.php');             $objUtil           = new Util;
require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
$parametros                                                 = $objUtil->getFormulario($_POST);
$idPaciente                                                 = $_POST["id"];
$parametros["datosFonasa"]                                  = json_decode(stripslashes($parametros["datosFonasa"]),true);
$parametros['frm_rut']                                      = $parametros["datosFonasa"]["beneficiario"]["ben_rut_sdv"];
$datos                                                      = $objPac->listarPaciente($objCon,$parametros);
$cargarPrevision                                            = $objPrevision->listarPrevision($objCon,$parametros);

// $parametros                              = $objUtil->getFormulario($_POST);
// $parametros['frm_id_paciente']           = $parametros['id'];


// $_SESSION['modules']["Fonasa"]["Fonasa"] = $parametros;

/*	json_encode de PHP a JS
	json_decode de JS  a PHP
*/

//highlight_string(print_r($parametros["datosFonasa"]),true);
// highlight_string(print_r($parametros),true);

?>

<style>
	.input-group-addon, .input-group-btn {
		width: 0% !important;		
	}

	/*.col-sm-4 {
		width: 33.333333% !important;
	}*/

	/*.input-group-addon {
		position: relative !important;
		left: -27% !important;	
	}

	.input-group .form-control {
		width: 68% !important;
	}*/
</style>

<!-- <div class="row"> -->
	<!-- <div class="col-lg-12"> -->
		<!-- <div class="btn_volver">
			<button id="btnVolver" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
		</div> -->
<!-- 		<h3 class="titulos"><span>Certificado de Fonasa</span></h3>
	</div>
</div> -->

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Fonasa/fonasaDetallePaciente.js?v=0.0.75"></script>

<br>
<form id="frm_indicePacienteSincronizarFonasa" class="formularios" name="frm_indicePacienteSincronizarFonasa" role="form" method="POST">
	<input type="hidden" name="frm_id_paciente"       id="frm_id_paciente"       value="<?=$idPaciente?>">
	<input type="hidden" name="frm_idFolio"           id="frm_idFolio"           value="<?=$parametros["datosFonasa"]["beneficiario"]["folio"]?>">
	<input type="hidden" name="frm_llamada"           id="frm_llamada"           value="<?=$parametros["llamada"]?>">
	<input type="hidden" name="nombreFonasa"          id="nombreFonasa"          value="<?=$parametros["nombreFonasa"]?>">
	<input type="hidden" name="ApellidoPaternoFonasa" id="ApellidoPaternoFonasa" value="<?=$parametros["ApellidoPaternoFonasa"]?>">
	<input type="hidden" name="ApellidoMaternoFonasa" id="ApellidoMaternoFonasa" value="<?=$parametros["ApellidoMaternoFonasa"]?>">
	<input type="hidden" name="direccionFonasa"       id="direccionFonasa"       value="<?=$parametros["direccionFonasa"]?>">
	<input type="hidden" name="previsionFonasa"       id="previsionFonasa"       value="<?=$parametros["previsionFonasa"]?>">
	<input type="hidden" name="sexoFonasa"       	  id="sexoFonasa"       	 value="<?=$parametros["sexoFonasa"]?>">
	<input type="hidden" name="fechaNac"       	  	  id="fechaNac"       	 	 value="<?=$parametros["fechaNac"]?>">
	<input type="hidden" name="calcularEdad"       	  id="calcularEdad"       	 value="<?=$parametros["calcularEdad"]?>">
	
	

	
	
	
	 

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
					<td colspan="2" align="" valign="middle" class="tit7">
						<label style="margin-left: 79%;">Nro Folio: </label><samp class="folio"><strong><label id="FOLIO">&nbsp;<?=$parametros["datosFonasa"]["beneficiario"]["folio"]?></label></strong></samp>&nbsp;&nbsp;
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
						<input type="hidden" name="frm_beneficiarioNombre" id="frm_beneficiarioNombre" value="<?=$parametros["datosFonasa"]["beneficiario"]["nombres"]?>">
						<?=$parametros["datosFonasa"]["beneficiario"]["nombres"]?>
					</td>
					<td width="77" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; color: #006699;">
						<strong style="color: #006699;">A. Paterno</strong>
					</td>
					<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$ben_apell1?> -->
						<input type="hidden" name="frm_beneficiarioPaterno" id="frm_beneficiarioPaterno" value="<?=$parametros["datosFonasa"]["beneficiario"]["apell1"]?>">
						<?=$parametros["datosFonasa"]["beneficiario"]["apell1"]?>
					</td>
					<td width="78" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; color: #006699;">
						<strong style="color: #006699;">A. Materno</strong>
					</td>
					<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$ben_apell2?> -->
						<input type="hidden" name="frm_beneficiarioMaterno" id="frm_beneficiarioMaterno" value="<?=$parametros["datosFonasa"]["beneficiario"]["apell2"]?>">
						<?=$parametros["datosFonasa"]["beneficiario"]["apell2"]?>
					</td>
				</tr>

				<tr class="tit7">
					<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; color: #006699;">
						<strong style="color: #006699;">Rut</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
						<!-- <?=$ben_rut?> -->
						<input type="hidden" name="frm_beneficiarioRut" id="frm_beneficiarioRut" value="<?=$parametros["datosFonasa"]["beneficiario"]["rut"]?>">
						<?=$parametros["datosFonasa"]["beneficiario"]["rut"]?>
					</td>
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Fecha Nac.</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF; color: #006699; ">
						<input type="hidden" name="frm_beneficiarioFechaNac" id="frm_beneficiarioFechaNac" value="<?=date("d-m-Y",strtotime($parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]));?>">
						<?=date("d-m-Y",strtotime($parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]));?>
						<!-- <?=$parametros["datosFonasa"]["beneficiario"]["fechaNacimiento"]?> -->
					</td>
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Sexo</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;"; >
						<!-- <?=$ben_sexo?> -->
						<?$sexoBen = $parametros["datosFonasa"]["beneficiario"]["sexo"]?>						
						<input type="hidden" name="frm_beneficiarioSexo" id="frm_beneficiarioSexo" value="<? switch ($sexoBen) {
							case 'MASCULINO': echo "M"; break;
							case 'FEMENINO' : echo "F"; break;
							case 'Masculino': echo "M"; break;
							case 'Femenino' : echo "F"; break;
						}?>"/>					
						<?=$parametros["datosFonasa"]["beneficiario"]["sexo"]?>
					</td>
				</tr>

				<tr class="tit7">
					<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
						<strong style="color: #006699;">Direccion</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF; color: #006699;" colspan="5">
						<!-- <?=$ben_direccion?> -->
						<input type="hidden" name="frm_beneficiarioDireccion" id="frm_beneficiarioDireccion" value="<?=$parametros["datosFonasa"]["beneficiario"]["direccion"]?>">
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
						<!-- <?=$afi_grupo?> -->
						<input type="hidden" name="frm_prevision" id="frm_prevision" value="<? switch($parametros["datosFonasa"]["afiliado"]["grupo"]){
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

				<tr class="tit7">
					<td height="19" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
						&nbsp;
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

					</td>					
				</table>
			</td>
		</tr>
	</table>
</table>

</br>
<table width="80%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" >
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" width="100%"  >
				<tr>
					<td width="1%"><img src="/indice_paciente_2017/assets/img/fonasa/borde_L.jpg" width="20" height="25"></td>
					<td width="98%" bgcolor="#0080C0" class="titulo_certificador">&nbsp;</td>
					<td align="right" width="1%"><img src="/indice_paciente_2017/assets/img/fonasa/borde_R.jpg" width="20" height="25"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td style="border-left:1px solid #06C; border-right:1px solid #06C;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E5F7FF">

			</table>
		</td>
	</tr>

	<tr>
		<td height="33" align="center" valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C; color:#006699">
			<center><strong>DATOS DEL PACIENTE HJNC</strong></center>
			<input hidden type="text" name="PacienteFallecido" id="PacienteFallecido" value="<?=$datos[0]['fallecido']?>"> <!-- paciente fallecido -->
		</td>
	</tr>

	
		<tr>
			<td height="33"  valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C; border-bottom:1px solid #06C;">
				<table width="100%" border="0" cellspacing="0">
					
						<tr class="tit7">
							<td width="5%" rowspan="5" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
								<img src="/indice_paciente_2017/assets/img/fonasa/imgbar022.jpg"  />
							</td>
							<td width="" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-top:1px solid #99E0FF;">
								<strong style="color: #006699;">Nombres</strong>
							</td>
							<td width="20%" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
								<input class="form-control" name="nombrePacienteHjnc" type="text" id="nombrePacienteHjnc" size="15" value="<?=$datos[0]['nombres']?>" style="text-transform:uppercase;" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>/>
							</td>
							<td width="" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
								<strong style="color: #006699;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Paterno</strong>
							</td>
							<td width="19%" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
								<input class="form-control" name="paternoPacienteHjnc" type="text" id="paternoPacienteHjnc" size="15" value="<?=$datos[0]['apellidopat']?>" style="text-transform:uppercase;" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>/>
							</td>
							<td width="" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
								<strong style="color: #006699;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Materno</strong>
							</td>
							<td width="20%" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
								<input class="form-control" name="maternoPacienteHjnc" type="text" id="maternoPacienteHjnc" size="15" value="<?=$datos[0]['apellidomat']?>" style="text-transform:uppercase;" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> />
							</td>
						</tr>

						<tr class="tit7">
							<td bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
								<strong style="color: #006699;">Rut</strong>
							</td>

							<td style="border-bottom:1px solid #CCF0FF; color: #006699;">
								<?=$datos[0]['rut']?>						
							</td>

							<td bgcolor="#E5F7FF">
								<strong style="color: #006699;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Nac.</strong>
							</td>

							<td style="border-bottom:1px solid #CCF0FF">           					
								<div class="input-group date" id="datePickerRECFonasa">
									<input type="text" class="form-control" name="nacimientoHjnc" id="nacimientoHjnc" value="<?=date("d-m-Y",strtotime($datos[0]['fechanac']))?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>/>
									<span class="input-group-addon" hidden>
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
								<!-- <label id="labelEdad">
									<?if($datos[0]['fechanac']==0000-00-00){

									}else{?>
									<?=$objUtil->edadActual($datos[0]['fechanac']).' Años' ?>
									<?}?>
									
								</label> -->
							</td> 

							<td bgcolor="#E5F7FF">
								<strong style="color: #006699;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grupo I.</strong>
							</td>

							<td style="border-bottom:1px solid #CCF0FF">
								<select class="form-control" name="prevision" id="prevision" style="width:100%" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?> >
									<?php for($i=0; $i<count($cargarPrevision); $i++){?>
									<option value="<?=$cargarPrevision[$i]['id']?>" <?if($datos[0]["prevision"]==$cargarPrevision[$i]['id']){echo "selected";}?> >
										<?=$cargarPrevision[$i]['prevision']?>
									</option>
									<?php }?>		        
								</select>
							</td>
						</tr>

						<tr class="tit7">
							<td height="23" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;" >
								<strong style="color: #006699;">Sexo</strong>
							</td>
							<td style="border-bottom:1px solid #CCF0FF;">
								<? //if($datosPacienteHJNC[0]['sexo']=='M')echo "MASCULINO";else echo "FEMENINO";?>
								<select name="sexoHjnc" id="sexoHjnc" style="width:100%;" class="form-control" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>>
									<option value="M" <? if($datos[0]['sexo']=='M')echo "selected";?>>MASCULINO</option>
									<option value="F" <? if($datos[0]['sexo']=='F')echo "selected";?>>FEMENINO</option>
								</select>
							</td>
							<td bgcolor="#E5F7FF">
								&nbsp;
							</td>

							<td style="border-bottom:1px solid #CCF0FF">
								&nbsp;
							</td>

							<td bgcolor="#E5F7FF">
								&nbsp;
							</td>

							<td style="border-bottom:1px solid #CCF0FF">

							</td>
						</tr>

						<tr class="tit7">
							<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
								<strong style="color: #006699;">Direccion</strong>
							</td>
							<td style="border-bottom:1px solid #CCF0FF; color: #006699;" colspan="5">
								<?=$datos[0]['direccion']?>
							</td>
						</tr>

						<tr class="tit7">
							<td height="19" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF; border-bottom:1px solid #99E0FF;">
								<strong style="color: #006699;">Acciones</strong>
							</td>
							<td colspan="5" align="right" style="border-bottom:1px solid #99E0FF;">		       
								<button id="datosFonasa" type="button" class="btn btn-primary" alt="" title="">
									<i class="fa fa-refresh" aria-hidden="true"></i> Sincronizar con Fonasa
								</button>

								<?if($datos[0]['fallecido']!="S"){?>
									<button id="datosPaciente" type="button" class="btn btn-primary" alt="" title="">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Actualizar Paciente
									</button>
								 <?}?>
							</td>
						</tr>					
				</td>
			</tr>
		</table>
		</form>



