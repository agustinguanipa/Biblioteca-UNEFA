<?php 
session_start(); 
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) 
{
	header('location: ./');
}
include '../conexion.php';

if (!empty($_POST)) 
{
	
	$id = $_POST['codproveedor'];

	//$query_delete = mysqli_query($conexion,"DELETE FROM usuario WHERE idusuario = $id");
	$query_delete = mysqli_query($conexion,"UPDATE proveedor SET estatus = 0 WHERE codproveedor = $id");
	mysqli_close($conexion);
	if ($query_delete) {
		header('location: lista_proveedor.php');

	}else{
		echo 'Error al eliminar';
	}
}

if (empty($_REQUEST['id'])) {
	header('location: lista_proveedor.php');
	mysqli_close($conexion);
}else{

	$id = $_REQUEST['id'];

	$query = mysqli_query($conexion,"SELECT * FROM proveedor  WHERE codproveedor = $id");
	mysqli_close($conexion);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while($data = mysqli_fetch_array($query)){

			$proveedor = $data['proveedor'];
			$contacto = $data['contacto'];
			$direccion = $data['direccion'];
		}
	}else{

		header('location: lista_proveedor.php');
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include 'includes/scripts.php'; ?>
	<title>Eliminar Proveedor</title>
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<section id="container">
		<div class="data_delete">
			<i class="fas fa-building fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px;"></i>
			<h2>¿Esta seguro de eliminar el siguiente registro?</h2>
			<p>Proveedor: <span><?php echo $proveedor; ?></span></p>
			<p>Contacto: <span><?php echo $contacto; ?></span></p>
			<p>Direccion: <span><?php echo $direccion; ?></span></p>

			<form action="" method="POST">	
				<input type="hidden" name="codproveedor" value="<?php echo $id ?>">
				<a href="lista_proveedor.php" class="btn_cancel"> <i class="fas fa-ban"></i>Cancelar</a>
				<button type="submit" id="aceptar" class="btn_ok"><i class="fas fa-trash-alt"></i> Aceptar</button>
			</form>
		</div>


	</section>

	<?php include 'includes/footer.php'; ?>
</body>
</html>
