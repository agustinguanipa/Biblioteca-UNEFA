<?php 
	session_start();
	include "../conexion.php";

	$titul_post = $_POST['titul_post'];
	$autor_post = $_POST['autor_post'];
	$tipo_post = $_POST['tipo_post'];
	$ident_espe = $_POST['ident_espe'];
	$ident_usua = $_SESSION['ident_tipu'];
	$postgrado = $_FILES['postgrado'];

	
	$nombre_postgrado = $postgrado['name'];
	$type = $postgrado['type'];
	$url_temp = $postgrado['tmp_name'];

	$destino = '../sistema/img/postgrado/';
	$archivo_nombre = 'postgrado_'.md5(date('d-m-Y H:m:s'));
	$archivopostgrado = $archivo_nombre.'.pdf';
	$src = $destino.$archivopostgrado;
	

	$query = mysqli_query($conexion,"SELECT * FROM tab_postgr WHERE titul_post = '$titul_post'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_postgrado('$titul_post','$autor_post','$tipo_post','$archivopostgrado','$ident_espe','$ident_usua')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_postgr(titul_post,autor_post,tipo_post, archi_post, ident_espe, ident_usua) VALUES('$titul_post','$autor_post','$tipo_post','$archivopostgrado','$ident_espe','$ident_usua')");
		if ($query_insert) {
			if ($archivopostgrado != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 	echo 'se inserto';
		 	header('location: ../sistema/postgrado_registro_exito.php');
		 }else{
		 	echo 'no se inserto';
		 }
	}
?>