<?php
	class Extranjero{
		function listarDocumentoExtranjero($objCon,$parametros){
			$sql="SELECT id_doc_extranjero,nombre_doc_extranjero 
				  from doc_extranjero";
			$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla Comunas<br>");
			return $datos;
		}
	}
?>