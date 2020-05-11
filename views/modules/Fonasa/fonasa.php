<?php
session_start();
require_once('../../../class/Connection.class.php');       $objCon            = new Connection; $objCon->db_connect();
require_once('../../../class/Util.class.php');             $objUtil           = new Util;
$parametros                              = $objUtil->getFormulario($_POST);
// require_once('../../../class/Paciente.class.php');         $objPac            = new Paciente;
// require_once('../../../class/Prevision.class.php');        $objPrevision      = new Prevision;
// $parametros                              = $objUtil->getFormulario($_POST);
// $parametros['frm_id_paciente']           = $parametros['id'];
// $datos                                   = $objPac->listarPaciente($objCon,$parametros);
// $cargarPrevision                         = $objPrevision->listarPrevision($objCon,$parametros);
// $_SESSION['modules']["Fonasa"]["Fonasa"] = $parametros;
highlight_string(print_r($parametros,true));
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
		<!-- <div class="btn_volver">
			<button id="btnVolver" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button>
		</div> -->
		<h3 class="titulos"><span>Certificado de Fonasa</span></h3>
	</div>
</div>

<script type="text/javascript" src="/indice_paciente_2017/controllers/client/Fonasa/fonasa.js?v=0.0.2"></script>

<br>
<form id="frm_indicePaciente" class="formularios" name="frm_indicePaciente" role="form" method="POST">

<table width="67%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" >
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
					<td width="17%" height="72" align="center" valign="middle"><img src="/indice_paciente_2017/assets/img/fonasa/giflogo01.gif" height="60" /></td>
					<td width="61%" align="center" class="sub_titulo_certificador"><strong>CERTIFICACION PARA ATENCION DE SALUD</strong></td>
					<td width="22%" align="center" valign="middle"><img src="/indice_paciente_2017/assets/img/fonasa/logo.jpg" width="139" height="80"  /></td>
				</tr>
				<tr>
					<td height="25">&nbsp;</td>
					<td colspan="2" align="right" valign="middle" class="tit7">
						Nro Folio: <samp class="folio"><strong><label id="FOLIO"><?=$parametros['frm_id_paciente']?></label></strong></samp>&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height="33" align="center" valign="middle" style="border-left:1px solid #06C; border-right:1px solid #06C; color:#006699">
			<strong><!-- <?=$certificado?> --></strong>
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
					<td width="140" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<!-- <?=$ben_nombres?> -->
					</td>
					<td width="77" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF;">
						<strong style="color: #006699;">A. Paterno</strong>
					</td>
					<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF">
						<!-- <?=$ben_apell1?> -->
					</td>
					<td width="78" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF;">
						<strong style="color: #006699;">A. Materno</strong>
					</td>
					<td width="124" style="border-top:1px solid #99E0FF;border-bottom:1px solid #CCF0FF">
						<!-- <?=$ben_apell2?> -->
					</td>
				</tr>

				<tr class="tit7">
					<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
						<strong style="color: #006699;">Rut</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=$ben_rut?> -->
					</td>
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Fecha Nac.</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=date("d-m-Y",strtotime($ben_fec_nacimiento));?> -->
					</td>
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Sexo</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF" >
						<!-- <?=$ben_sexo?> -->
					</td>
				</tr>

				<tr class="tit7">
					<td height="28" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
						<strong style="color: #006699;">Direccion</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF" colspan="5">
						<!-- <?=$ben_direccion?> -->
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
					<td width="140" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_nombre?> -->
						<!-- <input type="hidden" name="nombreFonasa" id="nombreFonasa" value="<?=$ben_nombres?>" /> -->
					</td>
					<td width="77" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<strong style="color: #006699;">A. Paterno</strong>
					</td>
					
					<td width="124" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_apell1?> -->
						<!-- <input type="hidden" name="paternoFonasa" id="paternoFonasa" value="<?=$ben_apell1?>"/> -->
					</td>
					
					<td width="78" bgcolor="#E5F7FF" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<strong style="color: #006699;">A. Materno</strong>
					</td>

					<td width="124" style="border-top:1px solid #99E0FF; border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_apell2?> -->
						<!-- <input type="hidden" name="maternoFonasa" id="maternoFonasa" value="<?=$ben_apell2?>" /> -->
					</td>
				</tr>

				<tr class="tit7">
					<td bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;">
						<strong style="color: #006699;">Rut</strong>
					</td>
					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_rut?>
						<input type="hidden" name="rutFonasa" id="rutFonasa" value="" />
						<input type="hidden" name="rut_sdv" id="rut_sdv" value="<?=$rut_sdv?>" /> -->
					</td>

					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Fecha Nac.</strong>
					</td>
					
					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=date("d-m-Y",strtotime($afi_fec_nacimiento));?>
						<input type="hidden" name="nacimientoFonasa" id="nacimientoFonasa" value="<?=date("d-m-Y",strtotime($ben_fec_nacimiento));?>" /> -->
					</td>
					
					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Grupo I.</strong>						
					</td>
					
					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_grupo?>
						<input type="hidden" name="previsionFonasa" id="previsionFonasa" value="<? switch($afi_grupo){
						case 'A': echo "0"; break;
						case 'B': echo "1"; break;
						case 'C': echo "2"; break;
						case 'D': echo "3"; break;}
						?>"/> -->
					</td>
				</tr>

				<tr class="tit7">
					<td height="23" bgcolor="#E5F7FF" style="border-right:1px solid #99E0FF;" >
						<strong style="color: #006699;">Sexo</strong>
					</td>

					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_sexo?>
						<input type="hidden" name="sexoFonasa" id="sexoFonasa" value="<?
						switch($ben_sexo){
							case 'MASCULINO': echo "M"; break;
							case 'FEMENINO': echo "F"; break;
							case 'Masculino': echo "M"; break;
							case 'Femenino': echo "F"; break;
						}?>" /> -->
					</td>

					<td bgcolor="#E5F7FF">
						<strong style="color: #006699;">Estado</strong>
					</td>

					<td style="border-bottom:1px solid #CCF0FF">
						<!-- <?=$afi_estado?> -->
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
<table width="67%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" >
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
								<div class="input-group date" id="datePickerREC">
									<input type="text" class="form-control" name="nacimientoHjnc" id="nacimientoHjnc" value="<?=date("d-m-Y",strtotime($datos[0]['fechanac']))?>" <?if($datos[0]['fallecido']=="S"){?> disabled <?}?>/>
									<span class="input-group-addon">
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
								<button id="volver1" type="button" class="btn btn-primary" alt="" title="">
									Volver
								</button>

							</td>
						</tr>					
				</td>
			</tr>
		</table>
		</form>



