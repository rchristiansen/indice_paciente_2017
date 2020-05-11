<?php
	class Prevision{
		// function listarPrevision($objCon,$parametros){
		// 	$sql="SELECT prevision,id 
		// 		  from prevision 
		// 		  WHERE prevision.id NOT IN (0, 1, 2, 3)";
		// 	$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Prevision<br>");
		// 	return $datos;
		// }

		function listarPrevision($objCon,$parametros){
			$sql="SELECT prevision,id
				  from prevision
				  ORDER BY prevision ASC";
			$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Prevision<br>");
			return $datos;
		}

		function listarPrevisionSinFonasa($objCon){			
			$sql="SELECT prevision,id from paciente.prevision WHERE prevision.id NOT IN (0, 1, 2, 3)";
			$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Prevision<br>");
			return $datos;
		}

	}
?>