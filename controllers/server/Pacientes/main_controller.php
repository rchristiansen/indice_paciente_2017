<?php
session_start();
require_once('../../../class/Connection.class.php'); $objCon      = new Connection;
require_once("../../../class/Util.class.php");       $objUtil     = new Util;
require_once("../../../class/Base.class.php");       $objBase     = new Base;

switch($_POST['accion']){
	case "verificaDocumento":
		require_once("../../../class/Paciente.class.php"); $objPac = new Paciente;
		$objCon->db_connect();
		$parametros                              = $objUtil->getFormulario($_POST);
		//print_r($parametros);

		if($parametros["tipo"]=="rut"){
			$parametros['frm_rut']               = $parametros['numeroDocumento'];
			$parametros['frm_documento']         = $parametros['tipoDocumento'];
		}else{
			//echo "EXTRANJERO";
			$parametros['frm_documento']         = $parametros['tipoDocumento'];
			$parametros['frm_nroDocumento']      = $parametros['numeroDocumento'];
		}

		try{
			$objCon->beginTransaction();
			if($parametros['frm_rut']!=0 || $parametros['frm_nroDocumento']!=0 ){
				$respuesta = $objPac->listarPaciente($objCon, $parametros);
			}
			$objCon->commit();
			echo count($respuesta); //tamaño del arreglo
		}catch (PDOException $e){
			$objCon->rollback();
		}
	break;

	case "grabarPaciente":
		require_once("../../../class/Paciente.class.php");           $objPac = new Paciente;
		require_once("../../../class/Log_Paciente.class.php");       $objLog = new Log_Paciente;
		$objCon->db_connect();
		$parametros                              = $objUtil->getFormulario($_POST);
		// highlight_string($parametros);
		if($parametros["tipo"]=="rut"){
			// echo "if";
			$parametros['frm_rut_pac']           = $parametros['numeroDocumento'];
			$parametros['frm_extranjero']        = "N";
		}else{
			// echo "else";
			if($parametros['numeroDocumento']=="" || $parametros['numeroDocumento']==0 ){
				 $parametros['numeroDocumento']=0;
			}else{
				$parametros['frm_nroDocumento']      = $parametros['numeroDocumento'];
			}
		}

		if($parametros['sistemaExterno']){
			if($parametros['frm_Naciemito_ext'] == ""){
				$parametros['frm_Naciemito'] == 0000-00-00;
			}else{
				$parametros['frm_Naciemito']         = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_Naciemito_ext'])));			
			}
		}else{
			if($parametros['frm_Naciemito']==""){
				$parametros['frm_Naciemito']         = 0000-00-00;
			}else{
				$parametros['frm_Naciemito']         = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_Naciemito'])));
			}
		}

		if($parametros['frm_sexo'] == null || $parametros['frm_sexo'] == ''){
			$parametros['frm_sexo'] = "D";
		}

		if($parametros['frm_estadoCivil'] == null || $parametros['frm_estadoCivil'] == ''){
			$parametros['frm_estadoCivil'] = "7";
		}

		if($parametros['frm_etnia'] == null || $parametros['frm_etnia'] == ''){
			$parametros['frm_etnia'] = "1";
		}

		if($parametros['frm_nacionalidad'] == null || $parametros['frm_nacionalidad'] == ''){
			$parametros['frm_nacionalidad'] = "NOINF";
		}

		if($parametros['frm_paisNacimiento'] == null || $parametros['frm_paisNacimiento'] == ''){
			$parametros['frm_paisNacimiento'] = "NOINF";
		}

		if($parametros['frm_regionIndicePaciente'] == null || $parametros['frm_regionIndicePaciente'] == ''){
			$parametros['frm_regionIndicePaciente'] = "99";
		}

		if($parametros['frm_ciudadIndicePaciente'] == null || $parametros['frm_ciudadIndicePaciente'] == '' || $parametros['frm_ciudadIndicePaciente'] == undefined){
			$parametros['frm_ciudadIndicePaciente'] = "999";
		}

		if($parametros['frm_comunaIndicePaciente'] == null || $parametros['frm_comunaIndicePaciente'] == '' || $parametros['frm_comunaIndicePaciente'] == undefined){
			$parametros['frm_comunaIndicePaciente'] = 349;
		}

		if($parametros['frm_prais'] == null || $parametros['frm_prais'] == ''){
			$parametros['frm_prais'] = "0";
		}

		if($parametros['frm_sectorDomicilioIndicePaciente'] == null || $parametros['frm_sectorDomicilioIndicePaciente'] == ''){
			$parametros['frm_sectorDomicilioIndicePaciente'] = "4";
		}

		if($parametros['frm_centroAtencion'] == null || $parametros['frm_centroAtencion'] == ''){
			$parametros['frm_centroAtencion'] = "18";
		}

		//highlight_string(print_r($ultimoID), true);

		try{
			$objCon->beginTransaction();
			$parametros['frm_nombres']           = strtoupper($parametros['frm_nombres']);
			$parametros['frm_AP']                = strtoupper($parametros['frm_AP']);
			$parametros['frm_AM']                = strtoupper($parametros['frm_AM']);
			$parametros['dv']                    = $objUtil->generaDigito($parametros['frm_rut_pac']);
			//highlight_string(print_r($parametros),true);
			$respuesta                           = $objPac->grabar_paciente($objCon, $parametros);
			$parametros['frm_fechaLog']          = date('Y-m-d');
			$parametros['frm_fechaLog']          = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaLog']))); // fecha del Log
			$parametros['frm_horaLog']           = date("G:i:s");
			$parametros['reg_usuario_insercion'] = $_SESSION['MM_Username'];
			$parametros['frm_tipoLog']           = "I";
			$ultimoID                            = $objCon->lastInsertId(); //ultimo ID del paciente ingresado como nuevo
			$parametros['frm_id_paciente']       = $ultimoID;
			$parametros['frm_sistemas']          = "Indice Paciente";
			$datos                               = $objPac->listarPaciente($objCon, $parametros);
			// highlight_string(print_r($datos),true);
			$respuesta2 = $objLog->registrar_log($objCon, $parametros);     // registro del log del Paciente
			$rut        = $objUtil->formatearNumero($datos[0]['rut']).'-'.$objUtil->generaDigito($datos[0]['rut']);
			$fechaNac   = date("d-m-Y", strtotime(str_replace("/", "-", $datos[0]['fechanac'])));
			$edadActual = $objUtil->edadActualCompleto($datos[0]['fechanac']);
			$response   = array("status"   		        	=> "success", 
								"sistemaExterno"            => $parametros['sistemaExterno'],
								"id"       		        	=> $parametros["frm_nombres"].' '.$parametros["frm_AP"].' '.$parametros["frm_AM"],
								"ultimoID"		        	=> $ultimoID,
								"nombre"   		        	=> $datos[0]['nombres'],
								"nombreInput"           	=> $parametros["nombres"],
								"run"                   	=> $rut,
								"runInput"              	=> $parametros["run"],
								"AP"   		            	=> $datos[0]['apellidopat'],
								"AP_Input"   	        	=> $parametros["AP"],
								"AM"   		            	=> $datos[0]['apellidomat'],
								"AM_Input"   	        	=> $parametros["AM"],
								"fechaNac"   	        	=> $fechaNac,
								"fechaNac2"   	        	=> $datos[0]['fechanac'],
								"fechaNac_Input"        	=> $parametros["fechaNac"],
								"edadActual"   	        	=> $edadActual,
								"calcularEdad"   	        => $parametros["calcularEdad"],
								"sexo"   		        	=> $datos[0]['sexo'],
								"sexoSelect"   	        	=> $parametros["sexo"],
								"etnia"   		        	=> $datos[0]['etnia'],
								"etniaSelect"           	=> $parametros["etnia"],
								"cap"   		        	=> $datos[0]['centroatencionprimaria'],
								"capSelect"             	=> $parametros["cap"],
								"nac"   		        	=> $datos[0]['nacionalidad'],
								"nacSelect"		        	=> $parametros["nac"],
								"direccion"		        	=> $datos[0]['direccion'],
								"direccion_Input"       	=> $parametros["direccion"],
								"correo"		        	=> $datos[0]['email'],
								"correo_Input"          	=> $parametros["correo"],
								"telefonoCelular"       	=> $datos[0]['fono1'],
								"telefonoCelular_Input" 	=> $parametros["telefonoCelular"],
								"telefonoCelularFijo"       => $datos[0]['PACfono'],
								"telefonoCelularFijo_Input" => $parametros["telefonoCelularFijo"],
								"prevision"             	=> $datos[0]['prevision'],
								"prevision_Select"      	=> $parametros["prevision"],
								"formaPago"             	=> $datos[0]['conveniopago'],
								"formaPago_Select"      	=> $parametros["formaPago"],
								"idPaciente"                => $datos[0]['id'],
								"idPaciente_input"          => $parametros['idPaciente'],

								"tipoDocumentoLabel"   		=> $parametros['tipoDocumentoLabel'],

								"extranjero"                => $datos[0]['extranjero'],
								"rut_extranjero"            => $datos[0]['rut_extranjero'],

								"id_doc_extranjero"         => $datos[0]['id_doc_extranjero'],
								"id_doc_extranjero_input"   => $parametros['doc_documento'],

								"afrodescendiente"         => $datos[0]['PACafro'],
								"afrodescendiente_select"  => $parametros['afrodescendiente'],
								"prais" 			       => $datos[0]['prais'],
								"prais_select"             => $parametros['prais'],
								"paisNacimiento" 		   => $datos[0]['paisNacimiento'],
								"paisNacimiento_select"    => $parametros['paisNacimiento'],
								"region" 		  		   => $datos[0]['region'],
								"region_select"            => $parametros['region'],
								"ciudad" 		  		   => $datos[0]['ciudad'],
								"ciudad_select"            => $parametros['ciudad'],
								"comuna" 		  		   => $datos[0]['idcomuna'],
								"comuna_select"            => $parametros['comuna'],
								"calle" 		  		   => $datos[0]['calle'],
								"calle_input"              => $parametros['calle'],
								"numero" 		  		   => $datos[0]['numero'],
								"numero_input"             => $parametros['numeroDireccion'],
								"sector"    		  	   => $datos[0]['sector_domicilio'],
								"sector_select"            => $parametros['sector'],
								"otrosTelefonos"     	   => $datos[0]['PACfonoOtros'],
								"otrosTelefonos_input"     => $parametros['otrosTelefonos']
								
								
								);
			echo json_encode($response);
			//highlight_string(print_r($parametros),true);
			$objCon->commit();
		}catch (PDOException $e){
			$objCon->rollback();
			$response = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($response);
		}
	break;

	case "actualizarPaciente":
	require_once("../../../class/Paciente.class.php");           $objPac = new Paciente;
	require_once("../../../class/Log_Paciente.class.php");       $objLog = new Log_Paciente;
	$objCon->db_connect();
	$parametros                                  = $objUtil->getFormulario($_POST); //capturar información del formulario
	$parametros['frm_id_paciente']               = $_SESSION['modulos']["Paciente"]["detalle_Paciente"]['id'];
	$parametros['frm_Naciemito']                 = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_Naciemito'])));
	$subparametros                               = array();
	$subparametros['frm_id_paciente']            = $parametros['frm_id_paciente'];

	if($parametros['frm_sexo'] == null || $parametros['frm_sexo'] == ''){
		$parametros['frm_sexo'] = "D";
	}

	if($parametros['frm_estadoCivil'] == null || $parametros['frm_estadoCivil'] == ''){
		$parametros['frm_estadoCivil'] = "7";
	}

	if($parametros['frm_etnia'] == null || $parametros['frm_etnia'] == ''){
		$parametros['frm_etnia'] = "14";
	}

	if($parametros['frm_nacionalidad'] == null || $parametros['frm_nacionalidad'] == ''){
		$parametros['frm_nacionalidad'] = "NOINF";
	}

	if($parametros['frm_paisNacimiento'] == null || $parametros['frm_paisNacimiento'] == ''){
		$parametros['frm_paisNacimiento'] = "NOINF";
	}

	if($parametros['frm_regionIndicePaciente'] == null || $parametros['frm_regionIndicePaciente'] == ''){
		$parametros['frm_regionIndicePaciente'] = "99";
	}

	if($parametros['frm_ciudadIndicePaciente'] == null || $parametros['frm_ciudadIndicePaciente'] == '' || $parametros['frm_ciudadIndicePaciente'] == undefined){
		$parametros['frm_ciudadIndicePaciente'] = "999";
	}

	if($parametros['frm_comunaIndicePaciente'] == null || $parametros['frm_comunaIndicePaciente'] == '' || $parametros['frm_comunaIndicePaciente'] == undefined){
		$parametros['frm_comunaIndicePaciente'] = 349;
	}

	if($parametros['frm_prais'] == null || $parametros['frm_prais'] == ''){
		$parametros['frm_prais'] = "0";
	}

	if($parametros['frm_sectorDomicilioIndicePaciente'] == null || $parametros['frm_sectorDomicilioIndicePaciente'] == ''){
		$parametros['frm_sectorDomicilioIndicePaciente'] = "4";
	}

	if($parametros['frm_centroAtencion'] == null || $parametros['frm_centroAtencion'] == ''){
		$parametros['frm_centroAtencion'] = "18";
	}

		//highlight_string(print_r($parametros), true);

	try{
		$objCon->beginTransaction();
			/*******************************************LOG ANTES DE ACTUALIZAR*****************************************************/
			$parametros2['frm_fechaLog']             = date('Y-m-d');
			$parametros2['frm_fechaLog']             = date("Y-m-d", strtotime(str_replace("/", "-", $parametros2['frm_fechaLog']))); // fecha del Log
			$parametros2['frm_horaLog']              = date("G:i:s");
			$parametros2['reg_usuario_insercion']    = $_SESSION['MM_Username'];
			$parametros2['frm_tipoLog']              = "S";
			$datos                                   = $objPac->listarPaciente($objCon, $subparametros);
			$parametros2['frm_AP']                   = $datos[0]['apellidopat'];
			$parametros2['frm_AM']                   = $datos[0]['apellidomat'];
			$parametros2['frm_nombres']              = $datos[0]['nombres'];
			$parametros2['frm_rut_pac']              = $datos[0]['rut'];
			$parametros2['frm_id_paciente']          = $datos[0]['id'];
			$parametros2['frm_prevision']            = $datos[0]['prevision'];
			$parametros2['frm_convenio']             = $datos[0]['conveniopago'];
			$parametros2['frm_nroFicha']             = $datos[0]['nroficha'];
			$parametros2['frm_Naciemito']            = $datos[0]['fechanac'];
			$parametros2['frm_telefonoFijo']         = $datos[0]['fono1'];
			$parametros2['frm_telefonoCelularAvis']  = $datos[0]['fono2'];
			$parametros2['frm_telefono_laboral']     = $datos[0]['fono3'];
			$parametros2['frm_sexo']                 = $datos[0]["sexo"];
			$parametros2['frm_id_trakcare']          = $datos[0]["id_trakcare"];
			$parametros2['frm_sistemas']             = "Indice Paciente";   	//saber de que sistema viene
			$parametros2['frm_pais_nacimiento']      = $datos[0]["paisNacimiento"];
			$parametros2['frm_region']     			 = $datos[0]["region"];  	
			$parametros2['frm_ciudad']     			 = $datos[0]["ciudad"];
			$parametros2['frm_comuna']     			 = $datos[0]["idcomuna"];
			$parametros2['frm_prais']     			 = $datos[0]["prais"];       
			$parametros2['frm_nombreCalle']     	 = $datos[0]["calle"];
			$parametros2['frm_numeroDireccion']      = $datos[0]["numero"];
			$parametros2['frm_direccion']            = $datos[0]["restodedireccion"];
			$parametros2['frm_sectorDomicilio']      = $datos[0]["sector_domicilio"];
			$parametros2['frm_tipoDomicilio']        = $datos[0]["conruralidad"];
			$parametros2['frm_otrosTelefonos']       = $datos[0]["PACfonoOtros"];
			$parametros2['frm_etnia'] 			     = $datos[0]["etnia"];
			$parametros2['frm_correo'] 			     = $datos[0]["email"];
			

			$respuesta2                              = $objLog->registrar_log($objCon, $parametros2); //aqui por base de datos

			/*******************************************LOG DESPUES DE ACTUALIZAR*****************************************************/
			$parametros['frm_fechaLog']          	 = date('Y-m-d');
			$parametros['frm_fechaLog']          	 = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaLog']))); // fecha del Log
			$parametros['frm_horaLog']           	 = date("G:i:s");
			$parametros['reg_usuario_insercion'] 	 = $_SESSION['MM_Username'];
			$parametros['frm_tipoLog']           	 = "U";
			$parametros['frm_rut_pac']               = $_POST['rut'];
			$parametros['frm_Naciemito']             = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_Naciemito'])));
			$parametros['frm_nroFicha']			     = $_SESSION['modulos']["Paciente"]["datos"][0]["nroficha"];
			$parametros['frm_sistemas']              = "Indice Paciente";   	//saber de que sistema viene
			$parametros['frm_afrodescendiente']      = $parametros['frm_afro'];  
			$parametros['frm_pais_nacimiento']       = $parametros['frm_paisNacimiento'];  
			$parametros['frm_region']      			 = $parametros['frm_regionIndicePaciente']; 
			$parametros['frm_ciudad']      			 = $parametros['frm_ciudadIndicePaciente']; 
			$parametros['frm_comuna']      			 = $parametros['frm_comunaIndicePaciente'];
			$parametros['frm_prais']     			 = $parametros['frm_prais'] ;       
			$parametros['frm_nombreCalle']     	 	 = $parametros['frm_nombreCalleIndicePaciente'];
			$parametros['frm_numeroDireccion']       = $parametros['frm_numeroDireccionIndicePaciente'];
			$parametros['frm_direccion']             = $parametros['frm_direccion'] ;
			$parametros['frm_sectorDomicilio']       = $parametros['frm_sectorDomicilioIndicePaciente'];
			$parametros['frm_tipoDomicilio']         = $parametros['frm_tipoDomicilioIndicePaciente'] ;
			$parametros['frm_otrosTelefonos']        = $parametros['frm_frm_otrosTelefonosIndicePaciente'] ;
			$parametros['frm_etnia']        		 = $parametros['frm_etnia'] ;
			$parametros['frm_correo']        		 = $parametros['frm_email'] ;
			//$parametros['frm_rut_pac']               =

			$respuesta3                          	 = $objLog->registrar_log($objCon, $parametros); // por formulario

			$parametros['frm_nombres']               = strtoupper($parametros['frm_nombres']);
			$parametros['frm_AP']                    = strtoupper($parametros['frm_AP']);
			$parametros['frm_AM']                    = strtoupper($parametros['frm_AM']);
			$parametros['frm_nroDocumento']          = $parametros['documento'];
			$parametros['dv'] 		                 = $objUtil->generaDigito($parametros['frm_rut_pac']); 
			$objPac->actualiza_paciente($objCon, $parametros);
			//highlight_string(print_r($parametros),true);

			$response  = array("status" => "success", "id" => $parametros["frm_nombres"].' '.$parametros["frm_AP"].' '.$parametros["frm_AM"]);
			$objCon->commit();
			echo json_encode($response);
		}catch (PDOException $e){
			$objCon->rollback();
			$response  = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($response);
		}
	break;

	case "actualizarPacienteFonasa": //desde la interfaz de fonasa
	require_once("../../../class/Paciente.class.php");           $objPac = new Paciente;
	require_once("../../../class/Log_Paciente.class.php");       $objLog = new Log_Paciente;
	$objCon->db_connect();
	$parametros                              = $objUtil->getFormulario($_POST);
	$parametros['frm_id_paciente']           = $_SESSION['modules']["Fonasa"]["Fonasa"]['id'];
	$parametros['nacimientoHjnc']            = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['nacimientoHjnc'])));
	$subparametros                           = array();
	$subparametros['frm_id_paciente']        = $parametros['frm_id_paciente'];
	// highlight_string(print_r($parametros), true);

	try{
		$objCon->beginTransaction();
		/*******************************************LOG ANTES DE ACTUALIZAR*****************************************************/
		$parametros2['frm_fechaLog']             = date('Y-m-d');
		$parametros2['frm_fechaLog']             = date("Y-m-d", strtotime(str_replace("/", "-", $parametros2['frm_fechaLog']))); // fecha del Log
		$parametros2['frm_horaLog']              = date("G:i:s");
		$parametros2['reg_usuario_insercion']    = $_SESSION['MM_Username'];
		$parametros2['frm_tipoLog']              = "S";

		$datos                                   = $objPac->listarPaciente($objCon, $subparametros);

		$parametros2['frm_AP']                   = $datos[0]['apellidopat'];
		$parametros2['frm_AM']                   = $datos[0]['apellidomat'];
		$parametros2['frm_nombres']              = $datos[0]['nombres'];
		$parametros2['frm_rut_pac']              = $datos[0]['rut'];
		$parametros2['frm_id_paciente']          = $datos[0]['id'];
		$parametros2['frm_prevision']            = $datos[0]['prevision'];
		$parametros2['frm_convenio']             = $datos[0]['conveniopago'];
		$parametros2['frm_nroFicha']             = $datos[0]['nroficha'];
		$parametros2['frm_Naciemito']            = $datos[0]['fechanac'];
		$parametros2['frm_telefonoFijo']         = $datos[0]['fono1'];
		$parametros2['frm_telefonoCelularAvis']  = $datos[0]['fono2'];
		$parametros2['frm_telefono_laboral']     = $datos[0]['fono3'];
		$parametros2['frm_sexo']                 = $datos[0]["sexo"];
		$parametros2['frm_id_trakcare']          = $datos[0]["id_trakcare"];
		$parametros2['frm_sistemas']             = "Indice Paciente";   	//saber de que sistema viene

		$respuesta2                              = $objLog->registrar_log($objCon, $parametros2); //aqui por base de datos

		/*******************************************LOG DESPUES DE ACTUALIZAR*****************************************************/
		$parametros['frm_fechaLog']          	 = date('Y-m-d');
		$parametros['frm_fechaLog']          	 = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaLog']))); // fecha del Log
		$parametros['frm_horaLog']           	 = date("G:i:s");
		$parametros['reg_usuario_insercion'] 	 = $_SESSION['MM_Username'];
		$parametros['frm_tipoLog']           	 = "U";
		$parametros['frm_AP']                    = $parametros['paternoPacienteHjnc'];
		$parametros['frm_AM']                    = $parametros['maternoPacienteHjnc'];
		$parametros['frm_nombres']               = $parametros['nombrePacienteHjnc'];
		$parametros['frm_rut_pac']               = $datos[0]['rut'];
		$parametros['frm_id_paciente']           = $datos[0]['id'];
		$parametros['frm_prevision']             = $parametros['prevision'];
		$parametros['frm_convenio']              = $datos[0]['conveniopago'];
		$parametros['frm_nroFicha']			     = $datos[0]['nroficha'];
		$parametros['frm_Naciemito']             = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['nacimientoHjnc'])));
		$parametros['frm_telefonoFijo']          = $datos[0]['fono1'];
		$parametros['frm_telefonoCelularAvis']   = $datos[0]['fono2'];
		$parametros['frm_telefono_laboral']      = $datos[0]['fono3'];
		$parametros['frm_sexo']	                 = $parametros['sexoHjnc'];
		$parametros['frm_id_trakcare']           = $datos[0]["id_trakcare"];
		$parametros['frm_sistemas']              = "Indice Paciente";   	//saber de que sistema viene

		$respuesta3                          	 = $objLog->registrar_log($objCon, $parametros); // por formulario

		$objPac->actualiza_pacienteFonasa($objCon, $parametros);
		$response  = array("status" => "success", "id" => $parametros["nombrePacienteHjnc"].' '.$parametros["paternoPacienteHjnc"].' '.$parametros["maternoPacienteHjnc"]);
		$objCon->commit();
		echo json_encode($response);
	}catch (PDOException $e){
		$objCon->rollback();
		$response  = array("status" => "error", "message" => $e->getMessage());
		echo json_encode($response);
	}

	break;

	case "calcularFechaPaciente";
		$objCon->db_connect();
		$fechaNac1        = $_POST['fechaNac'];
		$fechaNac2        = date("Y-m-d", strtotime(str_replace("/", "-", $fechaNac1)));
		$fechaNac3        = $objUtil->fechaNormal($fechaNac2);
		$fechaNac4        = $objUtil->fechaInvertida($fechaNac3);
		try{
			$objCon->beginTransaction();
			$response  = $objUtil->edadActualCompleto($fechaNac4);
			$response  = array("status" => "success", "id" => $response);
			$objCon->commit();
			echo json_encode($response);
		}catch (PDOException $e){
			$objCon->rollback();
			$response  = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($response);
		}

	break;

	case "grabarPacienteFonasa";
		require_once("../../../class/Paciente.class.php");           $objPac = new Paciente;
		$objCon->db_connect();
		$parametros                                    = $objUtil->getFormulario($_POST);
		$parametros["frm_rutBeneficiario"]             = $_POST['rut'];
		$parametros["frm_fechaNacimientoBeneficiario"] = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaNacimientoBeneficiario'])));
		try{
			$objCon->beginTransaction();
			$parametros['frm_rut_pac']                     = $parametros["frm_rutBeneficiario"];
			$parametros['frm_nombres']                     = $parametros["frm_nombreBeneficiario"];
			$parametros['frm_AP']                          = $parametros["frm_apell1Beneficiario"];
			$parametros['frm_AM']                          = $parametros["frm_apell2Beneficiario"];
			$parametros['frm_direccion']                   = $parametros["frm_direccionBeneficiario"];
			$parametros['frm_Naciemito']                   = $parametros["frm_fechaNacimientoBeneficiario"];
			$parametros['frm_sexo']                        = $parametros["frm_sexoBeneficiario"];
			$parametros['frm_prevision']				   = $parametros['previsionFonasa'];
			$parametros['frm_act_fonasa_fecha']            = date("Y-m-d");
			$parametros['frm_act_fonasa_hrs'] 			   = date("G:i:s");
			$parametros['frm_act_fonasa_folio']            = $parametros['frm_idFolio'];
			$respuesta                                     = $objPac->grabar_paciente($objCon, $parametros);
			$ultimoID                                      = $objCon->lastInsertId(); //ultimo ID del paciente ingresado como nuevo

			$parametros['frm_id_paciente'] 				   = $ultimoID;
			$datos                                         = $objPac->listarPaciente($objCon, $parametros);

			$rut                                           = $objUtil->formatearNumero($parametros['frm_rut_pac']).'-'.$objUtil->generaDigito($parametros['frm_rut_pac']);
			$fechaNacimiento                               = date("d-m-Y", strtotime(str_replace("/", "-", $parametros['frm_fechaNacimientoBeneficiario'])));
			$edadActualCompleto                            = $objUtil->edadActualCompleto(date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaNacimientoBeneficiario']))));
			$response   = array("status"           		  => "success", 
									"id"           		  => $parametros["frm_nombres"].' '.$parametros["frm_AP"].' '.$parametros["frm_AM"], 
									"ultimoID"     		  => $ultimoID,
									"nombres"      		  => $parametros['frm_nombres'],
									"apellidoPat"  		  => $parametros['frm_AP'],
									"apellidoMat"  		  => $parametros['frm_AM'],
									"rut"          		  => $rut,
									"fechaNac"     		  => $fechaNacimiento,
									"edadActual"   		  => $edadActualCompleto,
									"sexo"         		  => $parametros['frm_sexo'],
									"prevision"    		  => $parametros['frm_prevision'],
									"id_doc_documentoDau" => $datos[0]['id_doc_extranjero']
									
								);
			//highlight_string(print_r($parametros), true);
			$objCon->commit();
			echo json_encode($response);
		}catch (PDOException $e){
			$objCon->rollback();
			$response = array("status" => "noContetar", "message" => $e->getMessage());
			echo json_encode($response);
		}
		//highlight_string(print_r($parametros), true);
	break;

	case "calcularHoraDif";
		require_once("../../../class/Paciente.class.php");           $objPac = new Paciente;
		$objCon->db_connect();
		$parametros['frm_id_paciente'] = $_POST["id"];
		$datos       = $objPac->listarPaciente($objCon, $parametros);

		if($datos[0]["act_fonasa_fecha"]==""){
			$response  = array("fonasa" => "successPrevisionNoRegistra");
			echo json_encode($response);
		}

		if($datos[0]["act_fonasa_fecha"]){
			$dias_transcurridos=$objUtil->diasTranscurridos($datos[0]["act_fonasa_fecha"],date("Y-m-d"));
			if($dias_transcurridos>=1){
				$response  = array("fonasa" => "successPrevisionRegistrada");
				echo json_encode($response);
			}else{
				$response  = array("fonasa" => "successPrevisionRestringida");
				echo json_encode($response);
			}
		}



		// if($datos[0]["act_fonasa_fecha"]){
		// 	$hora = $objUtil->DiferenciaHoras($datos[0]["act_fonasa_fecha"].' '.$datos[0]["act_fonasa_hrs"],date("Y-m-d H:i:s"));
		// 	if($hora>=24){
		// 		$response  = array("fonasa" => "successPrevisionRegistrada");
		// 		echo json_encode($response);
		// 	}else{
		// 		$response  = array("fonasa" => "successPrevisionRestringida");
		// 		echo json_encode($response);
		// 	}
		// }

	break;

	case "sistemaExterno";
		require_once("../../../class/Paciente.class.php");   $objPac = new Paciente;
		$objCon->db_connect();
		$parametros['frm_id_paciente'] = $_POST["id"];
		try{
			$objCon->beginTransaction();
			$datosPacientes                                    = array();
			$datos                                             = $objPac->listarPaciente($objCon, $parametros);
			$datosPacientes["datos"]	                       = $datos;
			$datosPacientes["datos"][0]['fechanac']            = date("d-m-Y", strtotime(str_replace("/", "-", $datosPacientes["datos"][0]['fechanac'])));
			$datosPacientes["datos"][0]['fechanacEdadActual']  = $objUtil->edadActualCompleto(date("Y-m-d", strtotime(str_replace("/", "-", $datosPacientes["datos"][0]['fechanac']))));
			$datosPacientes["datos"][0]['rutFormateado']       = $objUtil->formatearNumero($datosPacientes["datos"][0]['rut']).'-'.$objUtil->generaDigito($datosPacientes["datos"][0]['rut']); 
			$datosPacientes["datos"][0]['fechaSincronizacion'] = date("d-m-Y", strtotime(str_replace("/", "-", $datosPacientes["datos"][0]['act_fonasa_fecha'])));	
			$response                                          = array("status" => "success","datosPacientes" => $datosPacientes);
			echo json_encode($response);
			$objCon->commit();
			//highlight_string(print_r($response));
		}catch (PDOException $e){
			$objCon->rollback();
			$response  = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($response);
		}
	break;

	case "cargarPrevisionesSinFonasa";
		$objCon->db_connect();
		require_once("../../../class/Prevision.class.php");   $objPrevision = new Prevision;
		$response = $objPrevision->listarPrevisionSinFonasa($objCon);
		echo json_encode($response);
	break;

	case "permisoAdmision";
		$objCon->db_connect();
			require_once("../../../class/Paciente.class.php");   $objPac = new Paciente;			
			$permisos                = $objPac->verPermiso($objCon,$_SESSION['MM_Username']);		
			$response = array("status" => "success","permisos" => $permisos[0]['rol_idrol']);
			echo json_encode($response);
			// highlight_string(print_r($permisos),true);
	break;

	case "cargarPrevisiones";
		$objCon->db_connect();
		require_once("../../../class/Prevision.class.php");   $objPrevision = new Prevision;
		$response = $objPrevision->listarPrevision($objCon,'');
		echo json_encode($response);
	break;

	case "cargarCiudades":
		$objCon->db_connect();
		require_once("../../../class/Localidad.class.php");		$objLocalidad = new Localidad;
		$response = $objLocalidad->listarCiudadesPorRegion($objCon, $_POST["regId"]);
		echo json_encode($response);
		break;

	case "cargarComunas":
		$objCon->db_connect();
		require_once("../../../class/Localidad.class.php");		$objLocalidad = new Localidad;
		$response = $objLocalidad->listarComunasPorRegion($objCon, $_POST["ciuId"]);
		echo json_encode($response);
		break;
}
$objCon = null;
?>
