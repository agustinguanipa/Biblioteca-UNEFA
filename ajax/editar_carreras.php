<?php 

include "../conexion.php";

// ACTUALIZAR USUARIO

	$id = $_POST['id'];
	$nombr_carr = $_POST['nombr_carr'];

	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_carrer 
				WHERE (nombr_carr = '$nombr_carr')");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_user = mysqli_query($conexion,"CALL editar_carrera('$nombr_carr',$id)");
		//$query_user = mysqli_query($conexion,"UPDATE tab_carrer SET nombr_carr='".$nombr_carr."' WHERE ident_carr='".$id."'");
	}	

	header('location: ../sistema/carreras_actualizar_exito.php');
?>