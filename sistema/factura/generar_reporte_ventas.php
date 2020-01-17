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

		$query_config   = mysqli_query($conexion,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		
		if($result_config > 0)
		{
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query_ventas = mysqli_query($conexion,"SELECT f.nofactura, f.fecha, f.totalfactura, f.codcliente, f.estatus,
										u.nombre as vendedor,
										cl.nombre as cliente
										FROM factura f
										INNER JOIN usuario u
										ON f.usuario = u.idusuario
										INNER JOIN cliente cl
										ON f.codcliente = cl.idcliente
										WHERE f.estatus != 10");

		

			ob_start();
		    include(dirname('__FILE__').'/factura_ventas.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura.pdf',array('Attachment'=>0));
			exit;	

?>