<?php
	class Nacionalidad{
		function listarNacionalidad($objCon,$parametros){
			$sql="SELECT NACcodigo,NACdescripcion,NACpais from nacionalidadavis WHERE NACcodigo<>'NOINF' order by NACdescripcion";
				  $datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Nacionalidad<br>");
				  return $datos;
		}
	}
?>