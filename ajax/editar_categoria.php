<?php 

include "../conexion.php";

// ACTUALIZAR USUARIO

	$id = $_POST['id'];
	$nombr_cate = $_POST['nombr_cate'];

	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_catego 
				WHERE (nombr_cate = '$nombr_cate')");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{
		$query_user = mysqli_query($conexion,"CALL editar_categoria('$nombr_cate','$id')");
		//$query_user = mysqli_query($conexion,"UPDATE tab_catego SET nombr_cate='".$nombr_cate."' WHERE ident_cate='".$id."'");
	}	

	header('location: ../sistema/categoria_actualizar_exito.php');
?>