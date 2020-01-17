<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }
?>

<?php 

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: especializaciones_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_espe, nombr_espe FROM tab_especi WHERE ident_espe = '$id' AND statu_espe = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: especializaciones_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$ident_espe = $data_user['ident_espe'];
	$nombr_espe = $data_user['nombr_espe'];
	
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Especializacion</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	 <div class="col form-group">
		      <label class="form-label" for="ident_espe">Identificación: </label>
		      <label><?php echo $ident_espe; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="nombr_espe">Nombre: </label>
		      <label><?php echo $nombr_espe; ?></label>
		    </div>
		  </div>
		</div>
		<div class="card-footer">
           <a href="especializaciones_lista.php" class="btn btn-success float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>