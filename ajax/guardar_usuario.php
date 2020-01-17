<?php 

	include "../conexion.php";

	$nombr_usua = $_POST['nombr_usua'];
	$apeli_usua = $_POST['apeli_usua'];
	$email_usua = $_POST['email_usua'];
	$usuar_usua = $_POST['usuar_usua'];
	$contr_usua = md5($_POST['contr_usua']);
	$ident_tipu = $_POST['ident_tipu'];
	$statu_usua = 1;

	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$imgUsuario = 'user.png';

	if ($nombre_foto != '')
	{
		$destino = '../sistema/img/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgUsuario = $img_nombre.'.jpg';
		$src = $destino.$imgUsuario;
	}

	$query = mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE usuar_usua = '$usuar_usua' OR email_usua = '$email_usua'");

	$result = mysqli_fetch_array($query);

	if ($result > 0) {
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_insert = mysqli_query($conexion,"CALL guardar_usuario('$nombr_usua','$apeli_usua','$email_usua','$usuar_usua','$contr_usua','$imgUsuario','$ident_tipu')");
		//$query_insert = mysqli_query($conexion,"INSERT INTO tab_usuar(nombr_usua,apeli_usua,email_usua,usuar_usua, contr_usua, statu_usua, fotou_usua, ident_tipu) VALUES('$nombr_usua','$apeli_usua','$email_usua','$usuar_usua','$contr_usua','$statu_usua', '$imgUsuario','$ident_tipu')");
		if ($query_insert) {
			if ($nombre_foto != '') 
			{
				move_uploaded_file($url_temp, $src);
			}
		 }
	}

	header('location: ../sistema/usuario_registro_exito.php');
?>