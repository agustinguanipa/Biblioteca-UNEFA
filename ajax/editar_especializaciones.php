<?php 

include "../conexion.php";

// ACTUALIZAR USUARIO

	$id = $_POST['id'];
	$nombr_espe = $_POST['nombr_espe'];

	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_especi 
				WHERE (nombr_espe = '$nombr_espe')");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{
		$query_user = mysqli_query($conexion,"CALL editar_especializacion('$nombr_espe','$id')");
		//$query_user = mysqli_query($conexion,"UPDATE tab_especi SET nombr_espe='".$nombr_espe."' WHERE ident_espe='".$id."'");
	}	

	header('location: ../sistema/Especializaciones_actualizar_exito.php');
?>