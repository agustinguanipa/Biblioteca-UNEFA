<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte De Ventas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>	
<div id="page_pdf">
	<br><br><br>
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="img/logo.png">
				</div>
			</td>
			<td class="info_empresa">
					<?php
					if($result_config > 0)
					{
						$iva = $configuracion['iva'];
					?>
						<div>
							<span class="h2"><?php echo strtoupper($configuracion['nombre']); ?></span>
							<p><?php echo $configuracion['razon_social']; ?></p>
							<p>Registro: v-<?php echo $configuracion['rif']; ?></p>
							<p>Teléfono: <?php echo $configuracion['telefono']; ?></p>
							<p>Email: <?php echo $configuracion['email']; ?></p>
							<p><?php echo $configuracion['direccion']; ?></p>
						</div>
					<?php
					}
				 	?>
			</td>
		</tr>
		<br><br><br>	
	</table>
	<div class="titulo">
		<p>LISTA DE VENTAS</p>
	</div>
	<br><br>
	<div class="venta_detalle">
	<table>
		
			<tr>
				<th>No.</th>
				<th>Fecha/Hora</th>
				<th>Cliente</th>
				<th>Vendedor</th>
				<th>Estado</th>
				<th>Total Factura</th>
			</tr>
			
		<?php 
		while ($row = mysqli_fetch_array($query_ventas)) 
		{
			if ($row['estatus'] == 1) 
			{
				$estado = '<span class="pagada">Pagada</span>';
			}else{
				 $estado = '<span class="anulado">Anulada</span>';
			}
		?>	
			<tr>	
				<td><?php echo $row['nofactura']; ?></td>
				<td><?php echo $row['fecha']; ?></td>
				<td><?php echo $row['cliente']; ?></td>
				<td><?php echo $row['vendedor']; ?></td>
				<td class="estado"><?php echo $estado; ?></td>
				<td class="totalfactura"><?php echo $row['totalfactura']; ?> BsS.</td>
			</tr>
		<?php
		}
		?>
	</table>
</div>
</div>

</body>
</html>