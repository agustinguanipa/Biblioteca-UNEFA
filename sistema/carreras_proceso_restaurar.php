<?php 
	include ('../conexion.php');
	$ident_carr = $_POST['id'];
			$restaurar_categoria = mysqli_query($conexion,"UPDATE tab_carrer SET statu_carr = 1 WHERE ident_carr = '$ident_carr'");
			if ($restaurar_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_carrer WHERE ident_carr = '$ident_carr'");

				header('location: carreras_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>