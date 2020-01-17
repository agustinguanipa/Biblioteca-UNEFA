<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }



	$busqueda = strtolower($_REQUEST['busqueda']);
	
	if (empty($busqueda)) {
		header('location: libro_lista.php');
	}
?>

<div class="container-fluid">
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">
							<h2>Administrar <b>Libros</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="libro_lista.php" class="btn btn-light text-dark"><i class="fa fa-book"></i> Libros Activos</a>
							<a href="libro_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Libros Inactivos</a>
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
					<a href="libro_registro.php" class="btn btn-success float-left"><i class="fa fa-plus"></i> Registrar Libro</a>
				</div>
				<form action="libros_buscar.php" method="GET" class="col-sm-4" style="padding-top: 1px;">
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
							<th class='text-center'>Autor</th>
							<th class='text-center'>Categoría</th>
							<th class='text-center'>Fecha de Registro</th>
							<th class='text-center'>Ver</th>
							<th class='text-center'>Editar</th>
							<th class='text-center'>Borrar</th>
							<th class='text-center'>Descargar</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tab_libros WHERE 
								(ident_libr LIKE '%$busqueda%' OR
								nombr_libr LIKE '%$busqueda%' OR
								autor_libr LIKE '%$busqueda%')
							AND statu_libr = 1");
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

							$query = mysqli_query($conexion,"SELECT u.ident_libr, u.nombr_libr, u.autor_libr, u.archi_libr, u.fecre_libr, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE 
								(u.ident_libr LIKE '%$busqueda%' OR
								u.nombr_libr LIKE '%$busqueda%' OR
								u.autor_libr LIKE '%$busqueda%' OR
								r.nombr_cate LIKE '%$busqueda%')
								AND	statu_libr = 1  ORDER BY ident_libr ASC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		?>

							 		<tr class="row<?php echo $data['ident_libr']; ?>">
										<td class='text-center'><?php echo $data['ident_libr']; ?></td>
										<td class='text-center'><?php echo $data['nombr_libr']; ?></td>
										<td class='text-center'><?php echo $data['autor_libr']; ?></td>
										<td class='text-center'><?php echo $data['nombr_cate']; ?></td>
										<td class='text-center'><?php echo $data['fecre_libr']; ?></td>
										<td class='text-center'>
											<a href="libro_ver.php?id=<?php echo $data['ident_libr']; ?>" class="look"><i class="fa fa-eye"></i></a>
										</td>
										<td class='text-center'>
											<a href="libro_editar.php?id=<?php echo $data['ident_libr']; ?>" class="edit"><i class="fa fa-edit"></i></a>
										</td>
										<td class='text-center'>
											<?php  
												if ($data['ident_libr'] != 1) {
												?>
													<a href="libro_borrar.php?id=<?php echo $data['ident_libr']; ?>" class="delete eliminar"><i class="fa fa-trash-alt"></i></a>
													
												<?php	
												}
											?>
										</td>
										<td class='text-center'>
											<a href="img/libros/<?php echo $data['archi_libr']; ?>" download="<?php echo $data['nombr_libr']; ?>.pdf" class="descargar"><i class="fa fa-cloud-download-alt"></i></a>
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
	
function eliminar(e) {
	 e.preventDefault();
   alert('hola');
}	
</script>
