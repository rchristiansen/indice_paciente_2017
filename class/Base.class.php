<?php class Base{
	function funcionGenerica($objConectar, $parametros){
		$objConectar->db_select("vlsebbww_biblio_core_db",$link);
		$usuarioADM = $parametros['usuarioADM'];
		$passADM = $parametros['passADM'];
		$sql = "SELECT *
				FROM administrador
				WHERE administrador.USUemail = '$usuarioADM'
				AND AES_DECRYPT(administrador.USUpassword,'biblio_arica16') = '$passADM'";
		$query = $objConectar->consultaSQL($sql,"<br>ERROR GENERICO<br>");
	}	
}?>