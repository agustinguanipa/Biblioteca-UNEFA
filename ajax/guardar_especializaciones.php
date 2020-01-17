<?php 

	include "../conexion.php";

	$nombr_espe = $_POST['nombr_espe'];

	$query = mysqli_query($conexion,"SELECT * FROM tab_especi WHERE nombr_espe = '$nombr_espe'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_especializacion('$nombr_espe')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_especi(nombr_espe) VALUES('$nombr_espe')");
	
	}

	header('location: ../sistema/especializaciones_registro_exito.php');
?>