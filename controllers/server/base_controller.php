<?php
session_start();
require_once('../../class/Connection.class.php'); $objCon = new Connection; 
require_once("../../class/Util.class.php"); $objUtil = new Util;
require_once("../../class/Base.class.php"); $objBase = new Base;

switch($_POST['accion']){
	case "unsetSesion":
			session_start();
			unset($_SESSION['modulos']);
			break;
}
?>