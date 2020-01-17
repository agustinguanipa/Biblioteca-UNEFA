<?php 
	include ('../conexion.php');
	$ident_cate = $_POST['id'];
			$restaurar_categoria = mysqli_query($conexion,"UPDATE tab_catego SET statu_cate = 1 WHERE ident_cate = '$ident_cate'");
			if ($restaurar_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_catego WHERE ident_cate = '$ident_cate'");

				header('location: categoria_lista_inactivo.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>