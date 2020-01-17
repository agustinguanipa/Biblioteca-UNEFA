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
	header('location: usuario_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_usua,u.nombr_usua, u.apeli_usua, u.email_usua, u.usuar_usua, u.fotou_usua, r.ident_tipu, r.nombr_tipu FROM tab_usuar u INNER JOIN tab_tipusu r ON u.ident_tipu = r.ident_tipu WHERE ident_usua = '$id' AND statu_usua = 1");
	
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: usuario_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	if ($data_user['fotou_usua'] != 'user.png') 
	{
		$foto = 'img/uploads/'.$data_user['fotou_usua'];
	}else{
		$foto = 'img/'.$data_user['fotou_usua'];
	}
	
	$nombr_usua = $data_user['nombr_usua'];
	$apeli_usua = $data_user['apeli_usua'];
	$email_usua = $data_user['email_usua'];
	$usuar_usua = $data_user['usuar_usua'];
	$ident_tipu = $data_user['ident_tipu'];
	$nombr_tipu = $data_user['nombr_tipu'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Ver Usuario</b>
	  </div>
		<div class="card-body" class="justify-content-center mx-3 my-1">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $foto; ?>" alt="Foto Usuario">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="nombr_usua"><b>Nombre: </b></label>
		      <label><?php echo $nombr_usua; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="apeli_usua">Apellido: </label>
		      <label><?php echo $apeli_usua; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="email_usua">E-Mail: </label>
		      <label><?php echo $email_usua; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="usuar_usua">Usuario: </label>
		      <label><?php echo $usuar_usua; ?></label>
		    </div>
		  </div>
			<div class="form-row">
				<div class="col form-group">
		      <label class="form-label" for="ident_tipu"><b>Tipo de Usuario: </b></label>
		      <?php
          	include "../conexion.php";
						$query_rol = mysqli_query($conexion,"SELECT t.nombr_tipu, p.ident_usua, t.ident_tipu FROM  tab_usuar p  INNER JOIN tab_tipusu t ON t.ident_tipu = p.ident_tipu WHERE ident_usua = $id");
						$result_rol = mysqli_num_rows($query_rol);
					?>
					<?php 
						if ($result_rol > 0) {
						while ($rol = mysqli_fetch_array($query_rol)) {?>
		      	<label><?php echo $rol['nombr_tipu'];?></label>
		      	<?php
						}
						}
						?>
		    </div>
			</div>
		</div>
		<div class="card-footer">
           <a href="usuario_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>