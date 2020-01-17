<?php 
	include ('../conexion.php');
	$ident_post = $_POST['id'];
			$delete_libro = mysqli_query($conexion,"UPDATE tab_postgr SET statu_post = 0 WHERE ident_post = '$ident_post'");
			if ($delete_libro) {
				
					$libro = mysqli_query($conexion,"SELECT * FROM tab_postgr WHERE ident_post = '$ident_post'");

				header('location: postgrado_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>