<?php 
	require_once('includes/admin_header.php');
	if ($_SESSION['ident_tipu'] == 3) 
   	{
    	header('location: ../index.php');
   	}
?>

<div class="container-fluid">
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">
							<h2>Administrar <b>Pre-Grado</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="pregrado_lista.php" class="btn btn-light text-dark"><i class="fa fa-graduation-cap"></i> Trabajos Activos</a>
							<a href="pregrado_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Trabajos Inactivos</a>
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
					<a href="pregrado_registro.php" class="btn btn-success float-left"><i class="fa fa-plus"></i> Registrar Trabajo</a>
				</div>
				<form action="pregrado_buscar.php" method="GET" class="col-sm-4" style="padding-top: 1px;">
					<div class="input-group">			
						<input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar">
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
							<th class='text-center'>Titulo</th>
							<th class='text-center'>Autor</th>
							<th class='text-center'>Fecha de registro</th>
							<th class='text-center'>Tipo</th>
							<th class='text-center'>Carrera</th>
							<th class='text-center'>Ver</th>
							<th class='text-center'>Editar</th>
							<th class='text-center'>Borrar</th>
							<th class='text-center'>Descargar</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tab_pregra WHERE statu_preg = 1");
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

							$query = mysqli_query($conexion,"SELECT u.ident_preg, u.titul_preg, u.autor_preg, u.fecre_preg, u.archi_preg, u.tipo_preg, r.nombr_carr FROM tab_pregra u INNER JOIN tab_carrer r ON u.ident_carr = r.ident_carr WHERE statu_preg = 1  ORDER BY ident_preg ASC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		?>

							 		<tr class="row<?php echo $data['ident_preg']; ?>">
										<td class='text-center'><?php echo $data['ident_preg']; ?></td>
										<td class='text-center'><?php echo $data['titul_preg']; ?></td>
										<td class='text-center'><?php echo $data['autor_preg']; ?></td>
										<td class='text-center'><?php echo $data['fecre_preg']; ?></td>
										<td class='text-center'><?php echo $data['tipo_preg']; ?></td>
										<td class='text-center'><?php echo $data['nombr_carr']; ?></td>
										<td class='text-center'>
											<a href="pregrado_ver.php?id=<?php echo $data['ident_preg']; ?>" class="look"><i class="fa fa-eye"></i></a>
										</td>
										<td class='text-center'>
											<a href="pregrado_editar.php?id=<?php echo $data['ident_preg']; ?>" class="edit"><i class="fa fa-edit"></i></a>
										</td>
										<td class='text-center'>
											<a href="pregrado_borrar.php?id=<?php echo $data['ident_preg']; ?>" class="delete eliminar"><i class="fa fa-trash-alt"></i></a>
										</td>
										<td class='text-center'>
											<a href="img/pregrado/<?php echo $data['archi_preg']; ?>" download="<?php echo $data['titul_preg']; ?>.pdf" class="descargar"><i class="fa fa-cloud-download-alt"></i></a>
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
