<?php 
session_start();
include "../conexion.php";

// ACTUALIZAR LIBRO

	$id = $_POST['id'];
	$titul_preg = $_POST['titul_preg'];
	$autor_preg = $_POST['autor_preg'];
	$tipo_preg = $_POST['tipo_preg'];
	$ident_carr = $_POST['ident_carr'];
	$ident_usua = $_SESSION['idUser'];

	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_pregra 
				WHERE (titul_preg = '$titul_preg' AND ident_preg != $id)");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{
		$query_user = mysqli_query($conexion,"CALL editar_pregrado('$titul_preg','$autor_preg','$tipo_preg','$ident_carr','$id','$ident_usua')");

		//$query_user = mysqli_query($conexion,"UPDATE tab_pregra SET titul_preg='".$titul_preg."', autor_preg='".$autor_preg."', tipo_preg='".$tipo_preg."', ident_carr='".$ident_carr."' WHERE ident_preg='".$id."'");

	}	

	header('location: ../sistema/pregrado_actualizar_exito.php');


	
?>