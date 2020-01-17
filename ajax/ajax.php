<?php 

include '../conexion.php';

session_start();
if (!empty($_POST)) {

	// EXTRAER DATOS DEL USUARIO
	if ($_POST['action'] == 'infousuario')  {
			
		$ident_usua = $_POST['ident_usua'];

		$query_usuario = mysqli_query($conexion,"SELECT ident_usua,nombr_usua,apeli_usua,email_usua, usuar_usua
			FROM tab_usuar 
			WHERE ident_usua = '$ident_usua' 
			AND statu_usua = 1");

		$result_usuario = mysqli_num_rows($query_usuario);
		if ($result_usuario > 0) {
			$data_usuario = mysqli_fetch_array($query_usuario);
			echo json_encode($data_usuario,JSON_UNESCAPED_UNICODE);
			exit;
		}else{
			echo 'error';
		}
	}

	// ELIMINAR USUARIO
	if ($_POST['action'] == 'eliminarusuario')  {
		
			$ident_usua = $_POST['id'];
			$alert = $_POST['alert'];
		
			$delete_usuario = mysqli_query($conexion,"UPDATE tab_usuar SET statu_usua = 0 WHERE ident_usua = '$ident_usua'");
			if ($delete_usuario) {
				
					$usuario = mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE ident_usua = '$ident_usua'");
					$data_delete = mysqli_fetch_array($usuario);
					echo json_encode($data_delete,JSON_UNESCAPED_UNICODE);
				//header('location: lista_producto.php');
				exit;
			}else{
				echo 'error';
			}
		exit;
	}

	


	mysqli_close($conexion);
	}

?>