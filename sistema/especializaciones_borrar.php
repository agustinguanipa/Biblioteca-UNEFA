<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: especializaciones_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_espe, nombr_espe FROM tab_especi WHERE ident_espe = '$id' AND statu_espe = 1");
	
$result_user = mysqli_num_rows($query_user);

if ($result_user == 0) 
{
	header('location: especializaciones_lista.php');
}else{
	$data = mysqli_fetch_array($query_user);
	
	$ident_espe = $data['ident_espe'];
	$nombr_espe = $data['nombr_espe'];
}

?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Eliminar Especializacion</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="especializacion_editar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="especializaciones_proceso_eliminar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
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
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar Especializacion</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="especializaciones_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>