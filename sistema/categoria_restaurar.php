<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: categoria_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_cate, nombr_cate FROM tab_catego WHERE ident_cate = '$id' AND statu_cate = 0");
	
$result_user = mysqli_num_rows($query_user);

if ($result_user == 0) 
{
	header('location: categoria_lista.php');
}else{
	$data = mysqli_fetch_array($query_user);
	
	$ident_cate = $data['ident_cate'];
	$nombr_cate = $data['nombr_cate'];
}

?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Restaurar Categoria</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="categoria_editar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="categoria_proceso_restaurar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea restaurar el siguiente registro?</b></h2>
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
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-success btn-block"><i class="fa fa-check"></i> Restaurar Categoria</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="categoria_lista_inactivo.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>