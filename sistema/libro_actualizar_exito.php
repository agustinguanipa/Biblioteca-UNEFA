<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Actualizar Libro</b>
			  </div>
		   	<div class="card-body">
  				<h2><b>¡El Libro ha sido Actualizado Exitosamente!</b></h2>
				</div>
				<div class="card-footer">
           <a href="libro_lista.php" class="btn btn-primary float-right">Ir al Listado <i class="fa fa-arrow-right"></i></a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

