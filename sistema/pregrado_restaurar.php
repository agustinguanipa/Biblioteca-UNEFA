<?php 
	require_once('includes/admin_header.php');
	if ($_SESSION['ident_tipu'] == 3) 
   	{
    	header('location: ../index.php');
   	}

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: pregrado_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_preg, u.titul_preg, u.autor_preg, u.tipo_preg, r.ident_carr, r.nombr_carr FROM tab_pregra u INNER JOIN tab_carrer r ON u.ident_carr = r.ident_carr WHERE ident_preg = '$id' AND statu_preg = 0");
	
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: pregrado_lista.php');
}else{
	$data = mysqli_fetch_array($query_user);
	
	$foto = 'img/logo-unefa.png';
	
	$titul_preg = $data['titul_preg'];
  	$autor_preg = $data['autor_preg'];
  	$tipo_preg = $data['tipo_preg'];
  	$nombr_carr = $data['nombr_carr'];
 
}

?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Restaurar Trabajo</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="" class="justify-content-center mx-3 my-1" align="center" enctype="" action="pregrado_proceso_restaurar.php" method="post">
						<h2><b>¿Esta seguro que desea restaurar el siguiente registro?</b></h2>
						<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
					  <div class="form-row">
					  	<div class="logoUser">
								<img src="<?php echo $foto; ?>" alt="Foto Libro">
							</div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="titul_preg">Titulo del Trabajo: </label>
					      <label><?php echo $titul_preg; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="autor_preg">Autor: </label>
					      <label><?php echo $autor_preg; ?></label>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="tipo_preg">Tipo de Trabajo: </label>
					      <label><?php echo $tipo_preg; ?></label>
					    </div>
							<div class="col form-group">
					      <label class="form-label" for="nombr_carr"><b>Carrera: </b></label>
					     <label><?php echo $nombr_carr;?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Restaurar Trabajo</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="pregrado_lista_inactivo.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

