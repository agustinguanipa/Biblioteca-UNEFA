<?php 
	include ('../conexion.php');
	$ident_preg = $_POST['id'];
			$delete_libro = mysqli_query($conexion,"UPDATE tab_pregra SET statu_preg = 0 WHERE ident_preg = '$ident_preg'");
			if ($delete_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_pregra WHERE ident_preg = '$ident_preg'");

				header('location: pregrado_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>