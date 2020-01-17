<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }


include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: postgrado_lista.php');
}

$id = $_GET['id'];


	$query_user = mysqli_query($conexion,"SELECT u.ident_post,u.titul_post, u.autor_post, u.tipo_post, r.ident_espe, r.nombr_espe FROM tab_postgr u INNER JOIN tab_especi r ON u.ident_espe = r.ident_espe WHERE ident_post = '$id' AND statu_post = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: postgrado_lista.php');
}else{
	$data = mysqli_fetch_array($query_user);
	
	$foto = 'img/logo-unefa.png';
	$titul_post = $data['titul_post'];
  	$autor_post = $data['autor_post'];
 	$tipo_post = $data['tipo_post'];
  	$ident_espe = $data['ident_espe'];
	$nombr_espe = $data['nombr_espe'];

}

?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Eliminar Trabajo de Post-Grado</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="postgrado_eliminar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="postgrado_proceso_eliminar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
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
							<div class="col form-group">
					      <label class="form-label" for="ident_espe"><b>Carrera: </b></label>
					      	<label><?php echo $nombr_espe;?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar Trabajo</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="postgrado_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>