<?php 
	include ('../conexion.php');
	$ident_preg = $_POST['id'];
			$restaurar_libro = mysqli_query($conexion,"UPDATE tab_pregra SET statu_preg = 1 WHERE ident_preg = '$ident_preg'");
			if ($restaurar_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_pregra WHERE ident_preg = '$ident_preg'");

				header('location: pregrado_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>