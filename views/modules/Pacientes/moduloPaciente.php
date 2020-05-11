<script type="text/javascript" src="/indice_paciente_2017/assets/js/mainExterno.js?v=0.0.22"></script>
<script type="text/javascript">	
	ajaxContent('/indice_paciente_2017/views/modules/Pacientes/busquedaPacienteExterno.php?sistemaExterno=<?=$_POST['sistemaExterno'];?>&fonasa=<?=$_POST['fonasa'];?>&nombre=<?=$_POST['nombre'];?>&run=<?=$_POST['run'];?>&ficha=<?=$_POST['ficha'];?>&ApellidoPaterno=<?=$_POST['ApellidoPaterno'];?>&ApellidoMaterno=<?=$_POST['ApellidoMaterno'];?>&fechaNac=<?=$_POST['fechaNac'];?>&calcularEdad=<?=$_POST['calcularEdad'];?>&sexo=<?=$_POST['sexo'];?>&etnia=<?=$_POST['etnia'];?>&ctp=<?=$_POST['ctp'];?>&nac=<?=$_POST['nac'];?>&domicilio=<?=$_POST['domicilio'];?>&correo=<?=$_POST['correo'];?>&telefonoCelular=<?=$_POST['telefonoCelular'];?>&telefonoFijo=<?=$_POST['telefonoFijo'];?>&prevision=<?=$_POST['prevision'];?>&formaPago=<?=$_POST['formaPago'];?>&idPaciente=<?=$_POST['idPaciente'];?>&direccionOculta=<?=$_POST['direccionOculta'];?>&pacienteFall=<?=$_POST['pacienteFall'];?>&tipoDocumentoLabel=<?=$_POST['tipoDocumentoLabel'];?>&doc_documento=<?=$_POST['doc_documento'];?>&paisNacimiento=<?=$_POST['paisNacimiento'];?>&PACafro=<?=$_POST['PACafro'];?>&comuna=<?=$_POST['comuna'];?>&region=<?=$_POST['region'];?>&ciudad=<?=$_POST['ciudad'];?>&calle=<?=$_POST['calle'];?>&numero=<?=$_POST['numero'];?>&sector=<?=$_POST['sector'];?>&prais=<?=$_POST['prais'];?>','','#contenidoPaciente','', true);  
</script>
<?php

?>
<div id="row" onDrop="return false">
	<div id="contenidoPaciente" class="container-fluid"></div>
</div>
