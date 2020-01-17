<?php 
	include ('../conexion.php');
	$ident_cate = $_POST['id'];
			$delete_categoria = mysqli_query($conexion,"UPDATE tab_catego SET statu_cate = 0 WHERE ident_cate = '$ident_cate'");
			if ($delete_categoria) {
				
					$categoria = mysqli_query($conexion,"SELECT * FROM tab_catego WHERE ident_cate = '$ident_cate'");

				header('location: categoria_lista.php');
				exit;
			}else{
				echo 'error';
			}
		exit;

 ?>