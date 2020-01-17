<?php 
	include ('../conexion.php');
	$ident_post = $_POST['id'];
			$restaurar_libro = mysqli_query($conexion,"UPDATE tab_postgr SET statu_post = 1 WHERE ident_post = '$ident_post'");
			if ($restaurar_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_postgr WHERE ident_post = '$ident_post'");

				header('location: postgrado_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>