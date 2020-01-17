<?php 
	include ('../conexion.php');
	$ident_usua = $_POST['id'];
			$delete_usuario = mysqli_query($conexion,"UPDATE tab_usuar SET statu_usua = 0 WHERE ident_usua = '$ident_usua'");
			if ($delete_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE ident_usua = '$ident_usua'");

				header('location: usuario_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>