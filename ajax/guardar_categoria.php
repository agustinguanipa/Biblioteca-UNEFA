<?php 

	include "../conexion.php";

	$nombr_cate = $_POST['nombr_cate'];

	$query = mysqli_query($conexion,"SELECT * FROM tab_catego WHERE nombr_cate = '$nombr_cate'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		// $query_insert = mysqli_query($conexion,"INSERT INTO tab_catego(nombr_cate) VALUES('$nombr_cate')");
		$query_insert = mysqli_query($conexion,"CALL guardar_categoria('$nombr_cate')");
		if ($query_insert) {
			header('location: ../sistema/categoria_registro_exito.php');
		 }else{
		 	echo 'no inserto';
		 	echo $nombr_cate;
		 }
	}

	
?>