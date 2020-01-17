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
			    <b>Registrar Usuario</b>
			  </div>
		   	<div class="card-body">
  				<h2><b>¡El Usuario ha sido Registrado Exitosamente!</b></h2>
				</div>
				<div class="card-footer">
           <a href="usuario_registro.php" class="btn btn-success float-left"><i class="fa fa-plus"></i> Registrar otro Usuario</a> 
           <a href="usuario_lista.php" class="btn btn-primary float-right"><i class="fa fa-arrow-right"></i> Ir al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

