<?php
session_start();
require_once('../../../class/Connection.class.php'); 			       $objCon            = new Connection;
require_once("../../../class/UtilFallecido.class.php");                $objUtil           = new Utilidades; //replicar otra clase
require_once("../../../class/Base.class.php");       			       $objBase           = new Base;
// highlight_string(print_r($_POST), TRUE);
switch($_POST['accion']){
	case "pacienteFallecido":
	// ECHO "pacienteFallecido"; 
	require_once("../../../class/Paciente.class.php");                 $objPac            = new Paciente;
	require_once("../../../class/Fallecido.class.php");                $objFallecido      = new Fallecido;
	require_once("../../../class/FuncionesAgenda.class.php");          $objFunAgenda      = new FuncionesAgenda;

	//Funciones de LEnet
			require_once("../../../../LEnet/class/Citas.class.php");               $objCita           = new Citas;
			require_once("../../../../LEnet/class/Interconsulta.class.php");       $objInterConsulta  = new Interconsulta;			
	//Fin

	//Funciones de Agenda
		// require_once("../../../../agenda/clases/Cita.inc");                $objCita           = new Cita;
		// require_once("../../../../agenda/clases/Interconsulta.inc");       $objInterConsulta  = new Interconsulta;	
		// require_once("../../../../agenda/clases/Conectar.inc");            $objCon2           = new Conectar; $link2 = $objCon2->db_connect();
	//Fin
	

	$objCon->db_connect();
	$parametros                              = $objUtil->getFormulario($_POST);
	$parametros['frm_id_paciente']           = $_SESSION['modulos']["Paciente"]["detalle_Paciente"]['id'];
	$parametros['frm_notificacion']          = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_notificacion'])));
	$parametros['frm_fechaDefuncion']        = date("Y-m-d", strtotime(str_replace("/", "-", $parametros['frm_fechaDefuncion'])));
	$parametros['frm_fechaIngreso']          = date("Y-m-d G:i:s"); //fecha de ingreso al Sistema
	$parametros['frm_fechaIngreso']          = date("Y-m-d G:i:s", strtotime(str_replace("/", "-", $parametros['frm_fechaIngreso']))); //fecha de ingreso al Sistema
	$parametros['reg_usuario_insercion']     = $_SESSION['MM_Username'];


	

	try{
		$objCon->beginTransaction();
		$respuesta1 = $objPac->actualiza_estado_paciente($objCon, $parametros); //CAMBIANDO DE ESTADO AL PACIENTE A "S" = FALLECIDO funcionando
		$respuesta2 = $objFallecido->grabar_estado($objCon, $parametros);       //REGISTRAR DATOS DEL DIFUNTO funcionando	

		


		//ELIMINAR LAS CITAS LEnet
			$citas                            = $objFunAgenda->contadorCitas($objCon,$parametros);			
			$usuario    					  = $_SESSION['MM_Username'];	
			$parametros['motivo_cancelar']    = 8;
			$parametros['frm_Observacion']    = 'Paciente Registrado como Fallecido desde Indice Pacientes, Usuario:'.$usuario.' Fecha: '.date("d-m-Y H:i:s");
			
			//highlight_string(print_r($citas),true);	
			if(count($citas)>0){	
				for ($i=0; $i<count($citas) ; $i++){
					$parametros['frm_citaCodigo'] = $citas[$i]['CITcodigo'];
					$respuesta3 = $objCita->cancelarCita($objCon,$parametros);				
				}
			}		
		//FIN CISTAS

			//ELIMINAR LAS INTERCONSULTA LEnet
			$interconsulta             = $objFunAgenda->contadorInterconsultas($objCon,$parametros);
			$tipoEgreso    = 2;
			$motivoEgreso  = 2;
			$parametros['descripcion'] = 'Paciente Registrado como Fallecido desde Indice Pacientes, Usuario:'.$usuario.' Fecha: '.date("d-m-Y H:i:s");
			if(count($interconsulta)>0){
				for($i=0; $i<count($interconsulta); $i++){					
					$respuesta4 = $objInterConsulta->egresarInterconsulta($objCon,$interconsulta[$i]['INTcodigo'],$tipoEgreso,$motivoEgreso,'Paciente Registrado como Fallecido desde Indice Pacientes, Usuario:'.$usuario.' Fecha: '.date("d-m-Y H:i:s"));
				}
			}

		
			
			
		//FIN INTERCONSULTA	

		//ELIMINAR LAS CITAS AGENDA
			// $citas      = $objFunAgenda->contadorCitas($objCon,$parametros);			
			// $motivo     = 8;
			// $usuario    = $_SESSION['MM_Username'];	
			// if($citas>0){	
			// 	for ($i=0; $i<count($citas) ; $i++){		
			// 		$respuesta3 = $objCita->cancelarCita($link2,$citas[$i]['CITcodigo'],$motivo,'Paciente Registrado como Fallecido desde Indice Pacientes, Usuario:'.$usuario.' Fecha: '.date("d-m-Y H:i:s"));
			// 	}
			// }		
		//FIN CISTAS

		//ELIMINAR LAS INTERCONSULTA AGENDA
			// $interconsulta = $objFunAgenda->contadorInterconsultas($objCon,$parametros);
			// $tipoEgreso    = 2;
			// $motivoEgreso  = 2;
			// if($interconsulta>0){
			// 	for($i=0; $i<count($interconsulta); $i++){
			// 		$respuesta4 = $objInterConsulta->egresarInterconsulta($link2,$interconsulta[$i]['INTcodigo'],$tipoEgreso,$motivoEgreso,'Paciente Registrado como Fallecido desde Indice Pacientes, Usuario:'.$usuario.' Fecha: '.date("d-m-Y H:i:s"));
			// 	}
			// }			
		//FIN INTERCONSULTA

		echo json_encode($response);
	}catch (PDOException $e){
		$objCon->rollback();
		$response = array("status" => "error", "message" => $e->getMessage());
		echo json_encode($response);
	}

	break;
}
$objCon = null;

?>