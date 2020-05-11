<?php
	class Comuna{
		function listarComuna($objCon,$parametros){
			$sql="SELECT
			comuna.id,
			comuna.comuna,
			comuna.id_comuna_trakcare
			FROM
			comuna
			ORDER BY comuna ASC";
			$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Comunas<br>");
			return $datos;
		}
	}
?>