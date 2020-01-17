<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }
?>
<?php 

if ($_SESSION['ident_tipu'] != 1) 
{
	header('location: ./');
}
include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: libro_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_libr,u.nombr_libr, u.descr_libr, u.autor_libr, u.fecre_libr, u.image_libr, r.ident_cate, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE ident_libr = '$id' AND statu_libr = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: libro_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	if ($data_user['image_libr'] != 'user.png') 
	{
		$foto = 'img/uploads/'.$data_user['image_libr'];
	}else{
		$foto = 'img/'.$data_user['image_libr'];
	}
	
	$nombr_libr = $data_user['nombr_libr'];
	$descr_libr = $data_user['descr_libr'];
	$autor_libr = $data_user['autor_libr'];
	$fecre_libr = $data_user['fecre_libr'];
	$ident_cate = $data_user['ident_cate'];
	$nombr_cate = $data_user['nombr_cate'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Libro</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $foto; ?>" alt="Foto Libro">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="nombr_libr">Nombre: </label>
		      <label><?php echo $nombr_libr; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="descr_libr">Descripción: </label>
		      <label><?php echo $descr_libr; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="autor_libr">Autor: </label>
		      <label><?php echo $autor_libr; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="fecre_libr">Fecha de Registro: </label>
		      <label><?php echo $fecre_libr; ?></label>
		    </div>
		  </div>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="ident_cate"><b>Categoría del Libro: </b></label>
		      <?php
          	include "../conexion.php";
						$query_rol = mysqli_query($conexion,"SELECT t.nombr_cate, p.ident_libr, t.ident_cate FROM  tab_libros p  INNER JOIN tab_catego t ON t.ident_cate = p.ident_cate WHERE ident_libr = $id");
						$result_rol = mysqli_num_rows($query_rol);
					?>
					<?php 
						if ($result_rol > 0) {
						while ($rol = mysqli_fetch_array($query_rol)) {?>
		      	<label><?php echo $rol['nombr_cate'];?></label>
		      	<?php
						}
						}
						?>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="libro_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>