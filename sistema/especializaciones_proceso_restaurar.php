<?php 
	include ('../conexion.php');
	$ident_espe = $_POST['id'];
			$restaurar_categoria = mysqli_query($conexion,"UPDATE tab_especi SET statu_espe = 1 WHERE ident_espe = '$ident_espe'");
			if ($restaurar_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_especi WHERE ident_espe = '$ident_espe'");

				header('location: especializaciones_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>