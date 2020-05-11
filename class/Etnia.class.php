<?php
	class Etnia{

        //Listar sectores de domicilio
		function listarEtnia($objCon){
			$objCon->db_select("paciente");
			$sql="  SELECT 
					    paciente.etnia.*
					FROM 
					    paciente.etnia
					ORDER BY 
                        paciente.etnia.etnia_id";

			$datos = $objCon->consultaSQL($sql,"<br>Error al listar Tabla de Etnia (Base Datos Paciente)<br>");
			return $datos;
        }
	}
?>