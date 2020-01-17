<?php 
	session_start();
	include "../conexion.php";

	$nombr_libr = $_POST['nombr_libr'];
	$descr_libr = $_POST['descr_libr'];
	$autor_libr = $_POST['autor_libr'];
	$ident_cate = $_POST['ident_cate'];
	$ident_usua = $_SESSION['ident_tipu'];
	$foto = $_FILES['foto'];
	$libro = $_FILES['libro'];

	
	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$imgLibro = 'libros.png';

	if ($nombre_foto != '')
	{
		$destino = '../sistema/img/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgLibro = $img_nombre.'.jpg';
		$src = $destino.$imgLibro;
	}


	$nombre_libro = $libro['name'];
	$typee = $libro['type'];
	$url_tempo = $libro['tmp_name'];

	$destinoo = '../sistema/img/libros/';
	$archivo_nombre = 'libro_'.md5(date('d-m-Y H:m:s'));
	$archivolibro = $archivo_nombre.'.pdf';
	$srce = $destinoo.$archivolibro;
	

	$query = mysqli_query($conexion,"SELECT * FROM tab_libros WHERE nombr_libr = '$nombr_libr'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_libro('$nombr_libr','$descr_libr','$autor_libr','$imgLibro','$archivolibro','$ident_cate','$ident_usua')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_libros(nombr_libr,descr_libr,autor_libr,image_libr, archi_libr, ident_cate, ident_usua) VALUES('$nombr_libr','$descr_libr','$autor_libr','$imgLibro','$archivolibro','$ident_cate','$ident_usua')");
		if ($query_insert) {
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
				move_uploaded_file($url_tempo, $srce);
			}
		 	echo 'se inserto';
		 	header('location: ../sistema/libro_registro_exito.php');
		 }else{
		 	echo 'no se inserto';
		 }
	}
?>