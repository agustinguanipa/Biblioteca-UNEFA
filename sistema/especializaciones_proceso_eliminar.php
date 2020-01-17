<?php 
	include ('../conexion.php');
	$ident_espe = $_POST['id'];
			$delete_categoria = mysqli_query($conexion,"UPDATE tab_especi SET statu_espe = 0 WHERE ident_espe = '$ident_espe'");
			if ($delete_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_especi WHERE ident_espe = '$ident_espe'");

				header('location: especializaciones_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>