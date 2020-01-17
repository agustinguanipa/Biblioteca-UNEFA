<?php 
session_start();
include "../conexion.php";

// ACTUALIZAR LIBRO

	$id = $_POST['id'];
	$titul_post = $_POST['titul_post'];
	$autor_post = $_POST['autor_post'];
	$tipo_post = $_POST['tipo_post'];
	$ident_espe = $_POST['ident_espe'];
	$ident_usua = $_SESSION['idUser'];

	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_postgr 
				WHERE (titul_post = '$titul_post' AND ident_post != $id)");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{
		$query_user = mysqli_query($conexion,"CALL editar_postgrado('$titul_post','$autor_post','$tipo_post','$ident_espe','$id','$ident_usua')");
		//$query_user = mysqli_query($conexion,"UPDATE tab_postgr SET titul_post='".$titul_post."', autor_post='".$autor_post."', tipo_post='".$tipo_post."', ident_espe='".$ident_espe."' WHERE ident_post='".$id."'");

	}	

	header('location: ../sistema/postgrado_actualizar_exito.php');


	
?>