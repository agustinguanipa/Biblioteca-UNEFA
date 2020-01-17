<?php 
	include ('../conexion.php');
	$ident_libr = $_POST['id'];
			$restaurar_libro = mysqli_query($conexion,"UPDATE tab_libros SET statu_libr = 1 WHERE ident_libr = '$ident_libr'");
			if ($restaurar_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_libros WHERE ident_libr = '$ident_libr'");

				header('location: libro_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>