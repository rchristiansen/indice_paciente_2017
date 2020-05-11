<?php
	class funcionesAgenda{
		function contadorCitas($objCon,$parametros){
			$objCon->setDB("agenda");
			$sql="SELECT cita.CITcodigo 
				  FROM   cita
				  WHERE  cita.PACidentificador = '{$parametros['frm_id_paciente']}' AND cita.CITestado_cita IN (15,11)"; //echo $sql;
	    	$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Paciente<br>");
			return $datos;
		}

		function contadorInterconsultas($objCon,$parametros){
			$objCon->setDB("agenda");
			$sql ="SELECT interconsulta.INTcodigo
    			   FROM   interconsulta
    			   WHERE  interconsulta.PACidentificador = '{$parametros['frm_id_paciente']}' AND interconsulta.INTestado IN (1,2,5,6)"; //echo $sql;
    		$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Paciente<br>");
			return $datos;
		}
			
	}		
?>