<?php

	//print_r($_REQUEST);
	//exit;
	//echo base64_encode('2');
	//exit;
	session_start();
	if (empty($_SESSION['active'])) 
	{
		header('location: ../');
	}
	

	include "../../conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;

	if(empty($_REQUEST['fecha_de']) || empty($_REQUEST['fecha_a']))
	{
		echo "No es posible generar la factura.";
	}else{
		$fecha_de = $_REQUEST['fecha_de'];
		$fecha_a = $_REQUEST['fecha_a'];

		$query_config   = mysqli_query($conexion,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		
		if($result_config > 0)
		{
			$configuracion = mysqli_fetch_assoc($query_config);
		}

		if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) 
	{
		$fecha_de = $_REQUEST['fecha_de'];
		$fecha_a = $_REQUEST['fecha_a'];

		$buscar = '';

		if ($fecha_de > $fecha_a) 
		{
			header('location: ../reporte_ventas.php');
		}else if ($fecha_de == $fecha_a) 
		{
			$where = "fecha LIKE '$fecha_de%'";
			$buscar = "fecha_de = $fecha_de%fecha_a = $fecha_a";
		}else{
			$f_de = $fecha_de.' 00:00:00';
			$f_a = $fecha_a.' 23:59:59';
			$where = "fecha BETWEEN '$f_de' AND '$f_a'";
			$buscar = "fecha_de = $fecha_de&fecha_a = $fecha_a";
		}
	}

		$query = mysqli_query($conexion,"SELECT f.nofactura, f.fecha, f.totalfactura, f.codcliente, f.estatus,
										u.nombre as vendedor,
										cl.nombre as cliente
										FROM factura f
										INNER JOIN usuario u
										ON f.usuario = u.idusuario
										INNER JOIN cliente cl
										ON f.codcliente = cl.idcliente
										WHERE $where AND f.estatus != 10");

		$result = mysqli_num_rows($query);
		
		if($result > 0)
		{

			ob_start();
		    include(dirname('__FILE__').'/factura_fechas.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$fecha_de.'_a_'.$fecha_a.'.pdf',array('Attachment'=>0));
			exit;
		}
	}

?>