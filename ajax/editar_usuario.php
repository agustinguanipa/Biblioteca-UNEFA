<?php 

include "../conexion.php";

// ACTUALIZAR USUARIO

	$id = $_POST['id'];
	$nombr_usua = $_POST['nombr_usua'];
	$apeli_usua = $_POST['apeli_usua'];
	$email_usua = $_POST['email_usua'];
	$usuar_usua = $_POST['usuar_usua'];
	$ident_usua = $_POST['ident_usua'];
	$imgUsuario = $_POST['foto_actual'];
	$imgRemove = $_POST['foto_remove'];

	$foto = $_FILES['foto'];

	$nombre_foto = $foto['name'];
	$type = $foto['type'];
	$url_temp = $foto['tmp_name'];

	$upd = '';

	if ($nombre_foto != '')
	{
		$destino = '../sistema/img/uploads/';
		$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		$imgUsuario = $img_nombre.'.jpg';
		$src = $destino.$imgUsuario;
	}else{
		if ($_POST['foto_actual'] != $_POST['foto_remove']) 
		{
			$imgUsuario = 'user.png';
		}
	}


	$consulta_user = mysqli_query($conexion,"SELECT * FROM tab_usuar 
				WHERE (usuar_usua = '$usuar_usua' AND ident_usua != $id) 
				OR (email_usua = '$email_usua' AND ident_usua != '$id')");
	$result_consulta = mysqli_fetch_array($consulta_user);

	if ($result_consulta > 0) 
	{
		echo 'Existe algo incorrecto';
		exit;
	}else{

		$query_user = mysqli_query($conexion,"CALL editar_usuario('$nombr_usua','$apeli_usua','$email_usua','$usuar_usua','$ident_usua','$imgUsuario','$id')");
		//$query_user = mysqli_query($conexion,"UPDATE tab_usuar SET nombr_usua='".$nombr_usua."', apeli_usua='".$apeli_usua."', email_usua='".$email_usua."', usuar_usua='".$usuar_usua."', ident_tipu='".$ident_usua."', fotou_usua = '".$imgUsuario."' WHERE ident_usua='".$id."'");

		if ($query_user > 0) 
		{

			// if ([$nombre_foto != '' && ($_POST['foto_actual'] != 'user.png')] || ($_POST['foto_actual'] != $_POST['foto_remove'])) 
			// {
			// 	unlink('../sistema/img/uploads/'.$_POST['foto_actual']);
			// }
			if ($nombre_foto != '' || ($_POST['foto_actual'] == $_POST['foto_remove']) ) 
			{
				move_uploaded_file($url_temp, $src);
			}
		}
	}	

	header('location: ../sistema/usuario_actualizar_exito.php');
?>