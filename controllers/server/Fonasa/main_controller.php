<?php
session_start();
require_once('../../../class/Connection.class.php'); $objCon      = new Connection;
require_once("../../../class/Util.class.php");       $objUtil     = new Util;
require_once("../../../class/Base.class.php");       $objBase     = new Base;

switch($_POST['accion']){
	case "confirmarPacienteFonasa":	//Para Agregar con Datos de Fonasa, a Partir del "Nuevo Paciente"
		//$parametros['frm_rut']            	= Rut Sin Digito Verificador
			$parametros['frm_rut']              = $_POST["rut"];
		//Fin $parametros['frm_rut']

		//$parametros['frm_DigitoRut']      	= Solo el Digito Verificador
			$parametros['frm_DigitoRut']        = $objUtil->generaDigito($parametros['frm_rut']);
		//Fin $parametros['frm_DigitoRut']

		//Fecha Del Validador
			$parametros['frm_fechaValidador']   = date("Y-m-d");
		//FIN Fecha Del Validador

		//Hora del Validador
			$parametros['frm_horaValidador']    = date("G:i:s");
		//Fin Hora del Validador

		//accion del controlador
			$parametros["accion"]               = "integracionFonasa";	
		//FIN accion del controlador

		
		//$url = "http://10.6.21.16/IntegracionFonasa/integracion_Fonasa/integracion_fonasa.php";
			$url = "http://10.6.21.14/Fonasa/controllers/server/main_controller.php";
		//Fin url

		//curl Inicio
			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);

			//curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);

			//execute post
			$result = curl_exec($ch);
			//var_dump($result);
			//close connection
			curl_close($ch);
		//Fin Curl	
		 // var_dump($result); 
		 highlight_string(print_r($result), true);        
		 //echo json_encode($response);
	break;

	case "confirmarPacienteFonasaDetalle":
		require_once("../../../class/Paciente.class.php");       $objPac = new Paciente;
		$objCon->db_connect();
		$parametros['frm_id_paciente']   = $_POST["id"];
		$datos = $objPac->listarPaciente($objCon, $parametros);

		//$subparametros['frm_rut']        	       = Rut Sin Digito Verificador
			$subparametros["frm_rut"]              = $datos[0]["rut"];
		//FIN $subparametros['frm_rut']        	

		//$subparametros['frm_DigitoRut']          = Solo el Digito Verificador
			$subparametros['frm_DigitoRut']        = $objUtil->generaDigito($datos[0]["rut"]);
		//FIN $subparametros['frm_DigitoRut']

		//Fecha Del Validador
			$subparametros['frm_fechaValidador']   = date("Y-m-d");
		//FIN Fecha Del Validador

		//Hora del Validador
			$subparametros['frm_horaValidador']    = date("G:i:s");
		//Fin Hora del Validador

		//accion del controlador
			$subparametros["accion"]               = "integracionFonasa";	
		//FIN accion del controlador

		//$url
			$url = "http://10.6.21.14/Fonasa/controllers/server/main_controller.php";
			// $url = "http://ws.fonasa.cl:8080/Certificados/Previsional";
		//Fin url

		// if (curl_init($url)) {
		// 	echo "Conectado!";
			//curl Inicio
				$ch = curl_init();
				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);

				//curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $subparametros);

				//execute post
				$result = curl_exec($ch);
				//var_dump($result);
				//close connection
				curl_close($ch);
			//Fin Curl	
		// }
		// else{
		// 	echo "Destanectado!";
		// }
		 // var_dump($result); 
		 highlight_string(print_r($result), true);        
		 //echo json_encode($response);    
	break;

	case 'actualizarPacienteFonasaHJNC':
	require_once("../../../class/Paciente.class.php");       $objPac = new Paciente;	
	//DATOS DE HJNC
		$objCon->db_connect();
		try{
			$objCon->beginTransaction();
			$parametros                     	      = $objUtil->getFormulario($_POST);
			$parametros['frm_id_paciente']            = $_POST['frm_id_Paciente'];
			$parametros['frm_nombres']                = strtoupper($_POST['nombre']);
			$parametros['frm_apellidopat']            = strtoupper($_POST['AP']);
			$parametros['frm_apellidomat']            = strtoupper($_POST['AM']);
			$parametros['frm_fechanac']               = date("Y-m-d", strtotime(str_replace("/", "-", $_POST['fechaNac'])));
			
			$parametros['fechaNacimientoJS']          = $_POST['fechaNac']; //$parametros['fechaNacimientoJS'] se creo para recibir invertida la fecha en su JS
			$parametros['frm_prevision']              = $_POST["prevision"]; 
			$parametros['frm_sexo']                   = $_POST["sexo"]; //cambios 08-11-2017
			$parametros['frm_act_fonasa_motivo']      = $parametros["frm_motivo"];
			$parametros['frm_act_fonasa_fecha']       = $parametros["frm_fechaUpdate"]; 
			// $parametros['frm_act_fonasa_fecha']       = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_act_fonasa_fecha'])));
			// $parametros['frm_act_fonasa_hrs']         = $parametros["frm_horaFonasa"];
			$parametros['frm_act_fonasa_folio']       = $_POST["frm_idFolio"];
			$parametros['frm_registro_actualizacion'] = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_act_fonasa_fecha']))).' '.$parametros["frm_horaFonasa"];
			$objPac->actualizaPacienteHjnc($objCon,$parametros);
			if($parametros['frm_llamada'] == 'letnet'){ //cuando tiene input
			switch($parametros['frm_prevision']){
				case "22";
					$parametros['frm_prevision'] = "Aetna Salud S.A.";
				break;

				case "5";
					$parametros['frm_prevision'] = "Alemana Salud S.A.";
				break;

				case "6";
					$parametros['frm_prevision'] = "Banmedica S.A.";
				break;

				case "7";
					$parametros['frm_prevision'] = "Chuquicamata Ltda";
				break;

				case "25";
					$parametros['frm_prevision'] = "Cigna Salud Prevision S.A";
				break;

				case "8";
					$parametros['frm_prevision'] = "Colmena Golden Cross S.A.";
				break;

				case "26";
					$parametros['frm_prevision'] = "Compensacion S.A.";
				break;

				case "9";
					$parametros['frm_prevision'] = "Consalud S.A.";
				break;

				case "27";
					$parametros['frm_prevision'] = "Crisol S.A.";
				break;

				case "28";
					$parametros['frm_prevision'] = "Crisol S.A.";
				break;

				case "10";
					$parametros['frm_prevision'] = "Cruz del Norte Ltda.";
				break;

				case "30";
					$parametros['frm_prevision'] = "F.a.s.t Bco Del Estado";
				break;

				case "31";
					$parametros['frm_prevision'] = "Fdacion.salud Shell Chile";
				break;

				case "11";
					$parametros['frm_prevision'] = "Ferrosalud S.A.";
				break;

				case "0";
					$parametros['frm_prevision'] = "FONASA A";
				break;

				case "1";
					$parametros['frm_prevision'] = "FONASA B";
				break;

				case "2";
					$parametros['frm_prevision'] = "FONASA C";
				break;

				case "3";
					$parametros['frm_prevision'] = "FONASA D";
				break;

				case "32";
					$parametros['frm_prevision'] = "Fund.salud El Teniente";
				break;

				case "12";
					$parametros['frm_prevision'] = "Fundación Ltda.";
				break;

				case "13";
					$parametros['frm_prevision'] = "Fusat Ltda.";
				break;

				case "34";
					$parametros['frm_prevision'] = "Genesis S.A.";
				break;

				case "14";
					$parametros['frm_prevision'] = "ING Salud S.A.";
				break;

				case "35";
					$parametros['frm_prevision'] = "Instsalud S.A.";
				break;

				case "36";
					$parametros['frm_prevision'] = "Isagas S.A.";
				break;

				case "37";
					$parametros['frm_prevision'] = "Isamedica S.A.";
				break;

				case "38";
					$parametros['frm_prevision'] = "Iscar S.A.";
				break;

				case "39";
					$parametros['frm_prevision'] = "Ismed S.A.";
				break;

				case "40";
					$parametros['frm_prevision'] = "Ispen Ltda.";
				break;

				case "41";
					$parametros['frm_prevision'] = "Istel S.A.";
				break;

				case "15";
					$parametros['frm_prevision'] = "Mas Vida S.A.";
				break;

				case "42";
					$parametros['frm_prevision'] = "Master Salud S.A.";
				break;

				case "43";
					$parametros['frm_prevision'] = "Naturmed S.A.";
				break;

				case "16";
					$parametros['frm_prevision'] = "Normedica S.A.";
				break;

				case "44";
					$parametros['frm_prevision'] = "Optima Salud S.A.";
				break;

				case "4";
					$parametros['frm_prevision'] = "PARTICULAR";
				break;

				case "45";
					$parametros['frm_prevision'] = "Promepart";
				break;

				case "17";
					$parametros['frm_prevision'] = "Río Blanco Ltda.";
				break;

				case "50";
					$parametros['frm_prevision'] = "San Lorenzo.";
				break;

				case "18";
					$parametros['frm_prevision'] = "San Lorenzo Ltda.";
				break;

				case "46";
					$parametros['frm_prevision'] = "Sfera S.A.";
				break;

				case "47";
					$parametros['frm_prevision'] = "Umbral S.A.";
				break;

				case "48";
					$parametros['frm_prevision'] = "Unimed S.A.";
				break;

				case "49";
					$parametros['frm_prevision'] = "Vida Plena S.A.";
				break;

				case "19";
					$parametros['frm_prevision'] = "Vida Tres S.A.";
				break;
				
				default:
					$parametros['frm_prevision'] = "PARTICULAR";
				break;
			}	

			switch($parametros['frm_sexo']){

				case "F";
					$parametros['frm_sexo'] = "FEMENINO";
				break;
				
				case "M";
					$parametros['frm_sexo'] = "MASCULINO";
				break;
			}		
		}
			

			$edadActual = $objUtil->edadActualCompleto(date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechanac'])))); 
			$parametros['frm_fechanacUpdate']      = date("d-m-Y", strtotime(str_replace("/", "-", $_POST['fechaNac'])));
			$response   = array("status"  		   => "success", 
								"nombres" 		   => $parametros["frm_nombres"], 
								"APaterno"		   => $parametros['frm_apellidopat'], 
								"AMaterno" 		   => $parametros['frm_apellidomat'], 
								"fechaNacimiento"  => $parametros['fechaNacimientoJS'], 
								"prevision" 	   => $parametros['frm_prevision'], 
								"sexo" 			   => $parametros['frm_sexo'],
								"llamada"		   => $_POST['frm_llamada'],
								"edadInvertida"    => $parametros['frm_fechanacUpdate'],
								"edadActual"       => $edadActual,
								"id_paciente"	   => $parametros['frm_id_paciente']);
			//$response = '1';
			echo json_encode($response);
			// echo $response;
			//highlight_string(print_r($parametros), true);
			$objCon->commit();
		}catch (PDOException $e){
			$objCon->rollback();
			$response = array("status" => "error", "message" => $e->getMessage());
			echo json_encode($response);
		}			
	break;

	case "SincronizarFonasa":
	require_once("../../../class/Paciente.class.php");       $objPac = new Paciente;
	$objCon->db_connect();
	try{
		$objCon->beginTransaction();
		$parametros                     	    = $objUtil->getFormulario($_POST);
		$parametros['frm_nombresFonasa']        = $parametros['frm_beneficiarioNombre'];
		$parametros['frm_apellidopatFonasa']    = $parametros['frm_beneficiarioPaterno'];
		$parametros['frm_apellidomatFonasa']    = $parametros['frm_beneficiarioMaterno'];
		$parametros['fechaNacimientoJS']        = $parametros['frm_beneficiarioFechaNac'];
		$parametros['frm_fechanacFonasa']       = $parametros['frm_beneficiarioFechaNac'];
		$parametros['frm_fechanacFonasa']       = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechanacFonasa'])));
		$edadActual                             = $objUtil->edadActualCompleto(date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechanacFonasa'])))); 
		// $parametros['frm_direccionFonasa']      = $parametros['frm_beneficiarioDireccion'];
		$datos                                             = $objPac->listarPaciente($objCon, $parametros);
		if($parametros['frm_beneficiarioDireccion']==""){
			$parametros['frm_direccionFonasa'] = $datos[0]['direccion'];
		}else{
			//echo "tiene";
			$parametros['frm_direccionFonasa']      = $parametros['frm_beneficiarioDireccion'];
		}
		$parametros['frm_act_fonasa_fecha']     = date("Y-m-d");
		$parametros['frm_act_fonasa_fechaJS']   = date("d-m-Y");
		$parametros['frm_act_fonasa_hrs']	    = date("G:i:s");
		$parametros['frm_act_fonasa_folio']     = $parametros['frm_idFolio'];
		$parametros['frm_sexo']                 = $parametros["frm_beneficiarioSexo"];
		$parametros['frm_PACfechaUpdateHjnc']   = date("Y-m-d");

		if($parametros['frm_prevision'] >= 4 || $parametros['frm_prevision']=="" ){
			$parametros['frm_prevision'] = 4;
		}

		$objPac->actualizadatos_pacientes_fonasa($objCon,$parametros);
		if($parametros['frm_llamada'] == 'letnet'){ //cuando tiene input
			switch($parametros['frm_prevision']){
				case "0";
					$parametros['frm_prevision'] = "FONASA A";
				break;

				case "1";
					$parametros['frm_prevision'] = "FONASA B";
				break;

				case "2";
					$parametros['frm_prevision'] = "FONASA C";
				break;

				case "3";
					$parametros['frm_prevision'] = "FONASA D";
				break;

				default:
					$parametros['frm_prevision'] = "PARTICULAR";
				break;
			}

			switch($parametros['frm_beneficiarioSexo']){
				case "F";
					$parametros['frm_sexo'] = "FEMENINO";
				break;


				// case "Femenino";
				// 	$parametros['frm_sexo'] = "FEMENINO";
				// break;

				// case "Masculino";
				// 	$parametros['frm_sexo'] = "MASCULINO";
				// break;

				case "M";
					$parametros['frm_sexo'] = "MASCULINO";
				break;
			}
		}



		// if($parametros['frm_llamada'] == 'DAU'){
		// 	$parametros['frm_prevision'] = $parametros['frm_prevision'] ;
		// }

		$response   = array("status"           => "success",
							"nombres"          => $parametros["frm_nombresFonasa"],
							"APaterno"         => $parametros['frm_apellidopatFonasa'], 
							"AMaterno"         => $parametros['frm_apellidomatFonasa'], 
							"fechaNacimiento"  => $parametros['fechaNacimientoJS'], 
							"sexo"             => $parametros['frm_sexo'], 
							"direccion"        => $parametros['frm_direccionFonasa'], 
							"fechaFonasa"      => $parametros['frm_act_fonasa_fecha'] , 
							"horaFonasa"       => $parametros['frm_act_fonasa_hrs'], 
							"previsionFonasa"  => $parametros['frm_prevision'], 
							"folioFonasa"      => $parametros['frm_act_fonasa_folio'],
							"llamada"		   => $parametros['frm_llamada'],
							"edadActual"       => $edadActual,							
							"id_paciente"	   => $parametros['frm_id_paciente']
							);
		echo json_encode($response);
		$objCon->commit();
		//highlight_string(print_r($parametros), true);	
	}catch (PDOException $e){
		$objCon->rollback();
		$response = array("status" => "error", "message" => $e->getMessage());
		echo json_encode($response);
	}	

			
	break;
}
$objCon = null;
?>