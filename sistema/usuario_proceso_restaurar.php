<?php 
	include ('../conexion.php');
	$ident_usua = $_POST['id'];
			$restaurar_usuario = mysqli_query($conexion,"UPDATE tab_usuar SET statu_usua = 1 WHERE ident_usua = '$ident_usua'");
			if ($restaurar_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE ident_usua = '$ident_usua'");

				header('location: usuario_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>