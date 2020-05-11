<?php
	class Fallecido{
		function listarInfoFallecido($objCon, $parametros){
			$sql="SELECT
					fallecido.fal_id,
					fallecido.fal_id_paciente,
					fallecido.fal_reporta,
					fallecido.fal_fecha_notificacion,
					fallecido.fal_fecha_difuncion,
					fallecido.fal_hora_difuncion,
					fallecido.fal_fecha_ingreso,
					fallecido.fal_observacion,
					fallecido.fal_usuario
				FROM
					fallecido
				WHERE fal_id_paciente={$parametros['frm_id_paciente']}";
				$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Paciente<br>");
				return $datos;
		}

		function calcularEdadFallecido($objCon, $parametros){
			$sql="SELECT 
					YEAR(fallecido.fal_fecha_difuncion)-YEAR(paciente.fechanac) + IF(DATE_FORMAT(fallecido.fal_fecha_difuncion,'%m-%d') > 
					DATE_FORMAT(paciente.fechanac,'%m-%d'), 0, -1) AS 'Edad'
				  FROM
					paciente
				  INNER JOIN fallecido ON paciente.id = fallecido.fal_id_paciente
				  WHERE paciente.id={$parametros['frm_id_paciente']}";
				  $datos = $objCon->consultaSQL($sql,"<br>Error al calcular edad fallecido<br>");
				  return $datos;
		}

		function grabar_estado($objCon, $parametros){
			$sql="INSERT INTO  fallecido (fal_id_paciente,
										  fal_reporta,
										  fal_fecha_notificacion,
										  fal_fecha_difuncion,
										  fal_hora_difuncion,
										  fal_fecha_ingreso,
										  fal_observacion,
										  fal_usuario)
				  VALUES ('{$parametros['frm_id_paciente']}',
				  		  '{$parametros['frm_reporta']}',
				  		  '{$parametros['frm_notificacion']}',
				  		  '{$parametros['frm_fechaDefuncion']}',
				  		  '{$parametros['frm_hora']}',
				  		  '{$parametros['frm_fechaIngreso']}',
				  		  '{$parametros['frm_observacion']}',
				  		  '{$parametros['reg_usuario_insercion']}')";
				  $response = $objCon->ejecutarSQL($sql, "Error al Insertar Paciente Fallecido");
		} 
	}
?>