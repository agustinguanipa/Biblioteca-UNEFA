<?php 
	include ('../conexion.php');
	$ident_carr = $_POST['id'];
			$delete_categoria = mysqli_query($conexion,"UPDATE tab_carrer SET statu_carr = 0 WHERE ident_carr = '$ident_carr'");
			if ($delete_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_carrer WHERE ident_carr = '$ident_carr'");

				header('location: carreras_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>