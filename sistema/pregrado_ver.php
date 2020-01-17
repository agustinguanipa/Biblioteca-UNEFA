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
	header('location: pregrado_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_preg,u.titul_preg, u.autor_preg, u.tipo_preg, u.fecre_preg, r.ident_carr, r.nombr_carr FROM tab_pregra u INNER JOIN tab_carrer r ON u.ident_carr = r.ident_carr WHERE ident_preg = '$id' AND statu_preg = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: pregrado_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$foto = 'img/logo-unefa.png';

	
	$titul_preg = $data_user['titul_preg'];
	$autor_preg = $data_user['autor_preg'];
	$tipo_preg = $data_user['tipo_preg'];
	$fecre_preg = $data_user['fecre_preg'];
	$nombr_carr = $data_user['nombr_carr'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Trabajo de Pre-Grado</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
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
		  </div>
		  <div class="form-row">
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
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="fecre_preg">Fecha de Registro: </label>
		      <label><?php echo $fecre_preg; ?></label>
		    </div>
		  </div>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="ident_cate"><b>Carrera: </b></label>
		      	<label><?php echo $data_user['nombr_carr'];?></label>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="pregrado_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>