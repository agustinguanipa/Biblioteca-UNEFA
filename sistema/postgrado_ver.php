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
	header('location: postgrado_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_post,u.titul_post, u.autor_post, u.tipo_post, u.fecre_post, r.ident_espe, r.nombr_espe FROM tab_postgr u INNER JOIN tab_especi r ON u.ident_espe = r.ident_espe WHERE ident_post = '$id' AND statu_post = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: postgrado_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$foto = 'img/logo-unefa.png';

	
	$titul_post = $data_user['titul_post'];
	$autor_post = $data_user['autor_post'];
	$tipo_post = $data_user['tipo_post'];
	$fecre_post = $data_user['fecre_post'];
	$nombr_espe = $data_user['nombr_espe'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Trabajo de Post-Grado</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $foto; ?>" alt="Foto Libro">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="titul_post">Titulo del Trabajo: </label>
		      <label><?php echo $titul_post; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="autor_post">Autor: </label>
		      <label><?php echo $autor_post; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="tipo_post">Tipo de Trabajo: </label>
		      <label><?php echo $tipo_post; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="fecre_post">Fecha de Registro: </label>
		      <label><?php echo $fecre_post; ?></label>
		    </div>
		  </div>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="ident_espe"><b>Carrera: </b></label>
		      	<label><?php echo $data_user['nombr_espe'];?></label>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="postgrado_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>