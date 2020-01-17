<?php 
	require_once('includes/admin_header.php');
	if ($_SESSION['ident_tipu'] == 3) 
   	{
    	header('location: ../index.php');
   	}


	$busqueda = strtolower($_REQUEST['busqueda']);
	
	if (empty($busqueda)) {
		header('location: usuario_lista.php');
	}
		

?>

<div class="container-fluid">
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">

	

							<h2>Administrar <b>Usuarios</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="usuario_lista.php" class="btn btn-light text-dark"><i class="fa fa-users"></i> Usuarios Activos</a>
							<a href="usuario_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Usuarios Inactivos</a>
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
					<a href="usuario_registro.php" class="btn btn-success float-left"><i class="fa fa-plus"></i> Registrar Usuario</a>
				</div>
				<form action="usuario_buscar.php" method="GET" class="col-sm-4" style="padding-top: 1px;">
					<div class="input-group">			
						<input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
	    </div>
	    <hr>
	    <div>
	    	<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th class='text-center'>#</th>
							<th class='text-center'>Nombre</th>
							<th class='text-center'>Apellido</th>
							<th class='text-center'>Email</th>
							<th class='text-center'>Usuario</th>
							<th class='text-center'>Tipo</th>
							<th class='text-center'>Ver</th>
							<th class='text-center'>Editar</th>
							<th class='text-center'>Borrar</th>
						</tr>
						<?php 
							
						//Paginador 

							$rol = '';
							if ($busqueda == 'Administrador') 
							{
								$rol = " OR rol LIKE '%1%' ";

							}else if ($busqueda == 'Bibliotecario') 
								{
									$rol = " OR rol LIKE '%2%' ";

								}else if ($busqueda == 'Estudiante') 
									{
										$rol = " OR rol LIKE '%3%' ";
									} 
							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tab_usuar WHERE 
								(ident_usua LIKE '%busqueda%' OR
								nombr_usua LIKE '%busqueda%' OR
								apeli_usua LIKE '%busqueda%' OR
								email_usua LIKE '%busqueda%' OR
								usuar_usua LIKE '%busqueda%' 
								$rol)
								AND statu_usua = 1");
							$result_registe = mysqli_fetch_array($sql_registe);
							$total_registro = $result_registe['total_registro'];

							$por_pagina = 5;

							if (empty($_GET['pagina'])) 
							{
								$pagina = 1;
							}else{

								$pagina = $_GET['pagina'];
							}

							$desde = ($pagina-1) * $por_pagina;
							$total_paginas = ceil($total_registro / $por_pagina);

							$query = mysqli_query($conexion,"SELECT u.ident_usua, u.nombr_usua, u.apeli_usua, u.email_usua, u.usuar_usua, u.fotou_usua, r.nombr_tipu FROM tab_usuar u INNER JOIN tab_tipusu r ON u.ident_tipu = r.ident_tipu WHERE 
								( u.ident_usua LIKE '%$busqueda%' OR 
								u.nombr_usua LIKE '%$busqueda%' OR 
								u.apeli_usua LIKE '%$busqueda%' OR 
								u.email_usua LIKE '%$busqueda%' OR
								u.usuar_usua LIKE '%$busqueda%' OR 
								r.ident_tipu LIKE '%$busqueda%' )
								AND statu_usua = 1  ORDER BY ident_usua ASC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		if ($data['fotou_usua'] != 'user.png') 
							 		{
							 			$foto = '../sistema/img/uploads/'.$data['fotou_usua'];
							 		}else{
							 			$foto = '../sistema/img/'.$data['fotou_usua'];
							 		}
							 		?>

							 		<tr class="row<?php echo $data['ident_usua']; ?>">
										<td class='text-center'><?php echo $data['ident_usua']; ?></td>
										<td class='text-center'><?php echo $data['nombr_usua']; ?></td>
										<td class='text-center'><?php echo $data['apeli_usua']; ?></td>
										<td class='text-center'><?php echo $data['email_usua']; ?></td>
										<td class='text-center'><?php echo $data['usuar_usua']; ?></td>
										<td class='text-center'><?php echo $data['nombr_tipu']; ?></td>
										<td class='text-center'>
											<a href="usuario_ver.php?id=<?php echo $data['ident_usua']; ?>" class="look"><i class="fa fa-eye"></i></a>
										</td>
										<?php if ($_SESSION['ident_tipu'] == 1) { ?>
										<td class='text-center'>
											<a href="usuario_editar.php?id=<?php echo $data['ident_usua']; ?>" class="edit"><i class="fa fa-edit"></i></a>
										</td>
										<?php   } ?>
										<td class='text-center'>
											<?php  
												if ($data['ident_usua'] != 1) {
												?>
													<a href="" product="<?php echo $data['ident_usua']; ?>" class="delete eliminar"><i class="fa fa-trash-alt"></i></a>
													
												<?php	
												}
											?>
										</td>
									</tr>

							 	<?php	
							 	}
							 } 
						?>
					</table>
				</div>
				<div class="paginador">
					<ul>
						<?php 
							if ($pagina != 1) 
							{
								?>
								<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
								<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></li>
								<?php	
							}
						?>
						
						<?php 
							for ($i=1; $i <= $total_paginas; $i++) 
							{ 
								if ($i == $pagina) 
								{
									echo '<li class="pageSelected">'.$i.'</li>';
								}else{

									echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
								}
							}
						
							if ($pagina != $total_paginas) 
							{
								?>
								<li><a href="?pagina=<?php echo $pagina+1; ?>"><i class="fas fa-forward"></i></a></li>
								<li><a href="?pagina=<?php echo $total_paginas; ?>"><i class="fas fa-step-forward"></i></a></li>
								<?php
							}
						?>
			
					</ul>
				</div>
	    </div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	
function eliminar() {
   alert('hola');
}	
</script>
