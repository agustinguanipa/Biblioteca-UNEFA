<?php 
	require_once('includes/admin_header.php');
	if ($_SESSION['ident_tipu'] == 3) 
   	{
    	header('location: ../index.php');
   	}


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
	$data = mysqli_fetch_array($query_user);
	if ($data['fotou_usua'] != 'user.png') 
	{
		$classRemove = '';
		$foto = 'img/uploads/'.$data['fotou_usua'];
	}
	else{
		$foto = 'img/'.$data['fotou_usua'];
	}
	$nombr_usua = $data['nombr_usua'];
	$apeli_usua = $data['apeli_usua'];
	$usuar_usua = $data['usuar_usua'];
	$email_usua = $data['email_usua'];


}

?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Eliminar Usuario</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="usuario_editar" class="justify-content-center mx-3 my-1" align="center" enctype="" action="usuario_proceso_eliminar.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<h2><b>¿Esta seguro que desea eliminar el siguiente registro?</b></h2>
		       	<div class="form-row">
					  	<div class="logoUser">
								<img src="<?php echo $foto; ?>" alt="Foto Usuario">
							</div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="nombr_usua">Nombre: </label>
					      <label><?php echo $nombr_usua; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="apeli_usua">Apellido: </label>
					      <label><?php echo $apeli_usua; ?></label>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="col form-group">
					      <label class="form-label" for="usuar_usua">Usuario: </label>
					      <label><?php echo $usuar_usua; ?></label>
					    </div>
					    <div class="col form-group">
					      <label class="form-label" for="email_usua">E-Mail: </label>
					      <label><?php echo $email_usua; ?></label>
					    </div>
					  </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Eliminar Usuario</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="usuario_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>