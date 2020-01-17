<?php 
session_start();
include "../conexion.php";

// ACTUALIZAR LIBRO

	$id = $_POST['id'];
	$nombr_libr = $_POST['nombr_libr'];
	$descr_libr = $_POST['descr_libr'];
	$autor_libr = $_POST['autor_libr'];
	$ident_libr = $_POST['ident_libr'];
	$imgLibro = $_POST['foto_actual'];
	$imgRemove = $_POST['foto_remove'];
	$ident_usua = $_SESSION['idUser'];
	
	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$upd = '';

	if ($nombre_foto != '')
	{
		$destino = '../sistema/img/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgLibro = $img_nombre.'.jpg';
		$src = $destino.$imgLibro;
	}else{
		if ($_POST['foto_actual'] != $_POST['foto_remove']) 
		{
			$imgLibro = 'libros.jpg';
		}
	}


	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_libros 
				WHERE (nombr_libr = '$nombr_libr' AND ident_libr != $id)");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{
		$query_user = mysqli_query($conexion,"CALL editar_libro('$nombr_libr','$descr_libr','$autor_libr','$ident_libr','$imgLibro','$id','$ident_usua')");
		//$query_user = mysqli_query($conexion,"UPDATE tab_libros SET nombr_libr='".$nombr_libr."', descr_libr='".$descr_libr."', autor_libr='".$autor_libr."', ident_cate='".$ident_libr."', image_libr = '".$imgLibro."' WHERE ident_libr='".$id."'");

		if ($query_user > 0) 
		{


		
		}
	}	

	header('location: ../sistema/libro_actualizar_exito.php');
?>