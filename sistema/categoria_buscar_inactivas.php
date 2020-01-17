<?php 
	require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }

	$busqueda = strtolower($_REQUEST['busqueda']);
	
	if (empty($busqueda)) {
		header('location: categoria_lista.php');
	}
?>

<div class="container-fluid">
	<div class="table-wrapper">
	    <div class="table-title">
	        <div class="row">
            <div class="col-sm-6">
							<h2>Administrar <b>Categorías de Libros (Inactivas)</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="categoria_lista.php" class="btn btn-light text-dark"><i class="fa fa-book"></i> Categorías Activas</a>
							<a href="categoria_lista_inactivo.php" class="btn btn-light text-dark"><i class="fa fa-trash"></i> Categorías Inactivas</a>
						</div>
	        </div>
	    </div>
	    <div class="row" style="padding-top: 2px;">
	    	<div class="col-sm-8">
					
				</div>
				<form action="categoria_buscar_inactivas.php" method="GET" class="col-sm-4" style="padding-top: 1px;">
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
							<th class='text-center'>Restaurar</th>
						</tr>
						<?php 
							
						//Paginador 

							$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tab_catego WHERE 
								(ident_cate LIKE '%$busqueda%' OR
								nombr_cate LIKE '%$busqueda%')
							AND statu_cate = 0");
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

							$query = mysqli_query($conexion,"SELECT ident_cate, nombr_cate FROM tab_catego  WHERE 
								(ident_cate LIKE '%$busqueda%' OR
								nombr_cate LIKE '%$busqueda%')
								AND statu_cate = 0  ORDER BY ident_cate ASC LIMIT $desde,$por_pagina");
							mysqli_close($conexion);
							$result = mysqli_num_rows($query);

							if ($result > 0) {
							 	while ($data = mysqli_fetch_array($query)) {

							 		
							 		?>

							 		<tr class="row<?php echo $data['ident_cate']; ?>">
										<td class='text-center'><?php echo $data['ident_cate']; ?></td>
										<td class='text-center'><?php echo $data['nombr_cate']; ?></td>
										<td class='text-center'>
											<a href="categoria_restaurar.php?id=<?php echo $data['ident_cate']; ?>" class="look"><i class="fa fa-check"></i></a>
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
