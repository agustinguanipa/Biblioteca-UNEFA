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
	header('location: categoria_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_cate, nombr_cate FROM tab_catego WHERE ident_cate = '$id' AND statu_cate = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: categoria_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$ident_cate = $data_user['ident_cate'];
	$nombr_cate = $data_user['nombr_cate'];
	
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Categoría de Libro</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	 <div class="col form-group">
		      <label class="form-label" for="nombr_cate">Identificación: </label>
		      <label><?php echo $ident_cate; ?></label>
		    </div>
		    <div class="col form-group">
		      <label class="form-label" for="nombr_cate">Nombre: </label>
		      <label><?php echo $nombr_cate; ?></label>
		    </div>
		  </div>
		</div>
		<div class="card-footer">
           <a href="categoria_lista.php" class="btn btn-success float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>