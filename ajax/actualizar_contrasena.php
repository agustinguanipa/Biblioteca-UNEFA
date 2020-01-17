<?php 
session_start();
 include "../conexion.php";

 $actual = md5($_POST['txtPassUser']);
 $nueva = md5($_POST['txtNewPassUser']);
 $confirmacion = $_POST['txtPassConfirm'];
 $ident_usua = $_SESSION['idUser'];

	 
	$query_user = mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE contr_usua = '$actual' AND ident_usua = '$ident_usua'");
	$result_user = mysqli_num_rows($query_user);

	if ($result_user > 0)
	{
		$query_update = mysqli_query($conexion,"UPDATE tab_usuar SET contr_usua = '$nueva' WHERE ident_usua = '$ident_usua'");

		if ($query_update) 
		{
			echo 'actualizo';
		}

		}else{
			echo 'La clave actual es incorrecta';
		}
		header('location: ../index.php');
 ?>

