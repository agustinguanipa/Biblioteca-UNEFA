<?php 
session_start(); 
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) 
{
	header('location: ./');
}
include '../conexion.php';

if (!empty($_POST)) 
{
	
	$id = $_POST['idcliente'];

	//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario = $id");
	$query_delete = mysqli_query($conexion,"UPDATE cliente SET estatus = 0 WHERE idcliente = $id");
	mysqli_close($conexion);
	if ($query_delete) {
		header('location: lista_cliente.php');

	}else{
		echo 'Error al eliminar';
	}
}

if (empty($_REQUEST['id'])) {
	header('location: lista_cliente.php');
	mysqli_close($conexion);
}else{

	$id = $_REQUEST['id'];

	$query = mysqli_query($conexion,"SELECT * FROM cliente  WHERE idcliente = $id");
	mysqli_close($conexion);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while($data = mysqli_fetch_array($query)){

			$cedula = $data['cedula'];
			$nombre = $data['nombre'];
		}
	}else{

		header('location: lista_cliente.php');
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar Cliente</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px;"></i>
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Cedula: <span><?php echo $cedula; ?></span></p>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>

			<form action="" method="POST">	
				<input type="hidden" name="idcliente" value="<?php echo $id ?>">
				<a href="lista_cliente.php" class="btn_cancel"> <i class="fas fa-ban"></i>Cancelar</a>
				<button type="submit" id="aceptar" class="btn_ok"><i class="fas fa-trash-alt"></i> Aceptar</button>
			</form>
		</div>


	</section>

	<?php include 'includes/footer.php'; ?>
</body>
</html>
