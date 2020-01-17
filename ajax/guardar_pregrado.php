<?php 
	session_start();
	include "../conexion.php";

	$titul_preg = $_POST['titul_preg'];
	$autor_preg = $_POST['autor_preg'];
	$tipo_preg = $_POST['tipo_preg'];
	$ident_carr = $_POST['ident_carr'];
	$ident_usua = $_SESSION['ident_tipu'];
	$pregrado = $_FILES['pregrado'];

	
	$nombre_pregrado = $pregrado['name'];
	$type = $pregrado['type'];
	$url_temp = $pregrado['tmp_name'];

	$destino = '../sistema/img/pregrado/';
	$archivo_nombre = 'pregrado_'.md5(date('d-m-Y H:m:s'));
	$archivopregrado = $archivo_nombre.'.pdf';
	$src = $destino.$archivopregrado;
	

	$query = mysqli_query($conexion,"SELECT * FROM tab_pregra WHERE titul_preg = '$titul_preg'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_pregrado('$titul_preg','$autor_preg','$tipo_preg','$archivopregrado','$ident_carr','$ident_usua')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_pregra(titul_preg,autor_preg,tipo_preg, archi_preg, ident_carr, ident_usua) VALUES('$titul_preg','$autor_preg','$tipo_preg','$archivopregrado','$ident_carr','$ident_usua')");
		if ($query_insert) {
			if ($archivopregrado != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 	echo 'se inserto';
		 	header('location: ../sistema/pregrado_registro_exito.php');
		 }else{
		 	echo 'no se inserto';
		 }
	}
?>