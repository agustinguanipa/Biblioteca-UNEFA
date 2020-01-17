<?php
	 
	include ('../conexion.php');
	$ident_libr = $_POST['id'];
			$delete_libro = mysqli_query($conexion,"UPDATE tab_libros SET statu_libr = 0 WHERE ident_libr = '$ident_libr'");
			if ($delete_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_libros WHERE ident_libr = '$ident_libr'");

				header('location: libro_lista.php');
				exit;
			}else{
				echo $ident_libr;
				echo 'error';
			}
		exit;

 ?>