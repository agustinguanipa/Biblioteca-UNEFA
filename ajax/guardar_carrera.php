<?php 

	include "../conexion.php";

	$nombr_carr = $_POST['nombr_carr'];

	$query = mysqli_query($conexion,"SELECT * FROM tab_carrer WHERE nombr_carr = '$nombr_carr'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_carrera('$nombr_carr')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_carrer(nombr_carr) VALUES('$nombr_carr')");
		if ($query_insert) {
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 }
	}

	header('location: ../sistema/carreras_registro_exito.php');
?>