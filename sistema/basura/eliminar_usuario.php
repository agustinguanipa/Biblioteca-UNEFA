<?php 
session_start(); 
if ($_SESSION['rol'] != 1) 
{
	header('location: ./');
}
include '../conexion.php';

if (!empty($_POST)) 
{
	if ($_POST['idusuario'] == 1) {
		header('location: lista_usuario.php');
		mysqli_close($conexion);
		exit;
	}
	$id = $_POST['idusuario'];

	//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario = $id");
	$query_delete = mysqli_query($conexion,"UPDATE usuario SET estatus = 0 WHERE idusuario = $id");
	mysqli_close($conexion);
	if ($query_delete) {
		header('location: lista_usuario.php');

	}else{
		echo 'Error al eliminar';
	}
}

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	header('location: lista_usuario.php');
	mysqli_close($conexion);
}else{

	$id = $_REQUEST['id'];

	$query = mysqli_query($conexion,"SELECT u.nombre, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario = $id");
	mysqli_close($conexion);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while($data = mysqli_fetch_array($query)){

			$nombre = $data['nombre'];
			$usuario = $data['usuario'];
			$rol = $data['rol'];
		}
	}else{

		header('location: lista_usuario.php');
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px;"></i>
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Usuario: <span><?php echo $usuario; ?></span></p>
			<p>Tipo Usuario: <span><?php echo $rol; ?></span></p>

			<form action="" method="POST">	
				<input type="hidden" name="idusuario" value="<?php echo $id ?>">
				<a href="lista_usuario.php" class="btn_cancel"><i class="fas fa-ban"></i> Cancelar</a>
				<button type="submit" id="aceptar" class="btn_ok"><i class="fas fa-trash-alt"></i> Aceptar</button>
			</form>
		</div>


	</section>

	<?php include 'includes/footer.php'; ?>
</body>
</html>
