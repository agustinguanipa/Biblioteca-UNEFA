<?php

include "../conexion.php";

if (!empty($_POST)) {
	$alert= '';
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
		$alert= '<p class= "msg_error">Todos los campos son obligatorios.</p>';
	}else{
		
		$nombre= $_POST['nombre'];
		$email= $_POST['correo'];
		$user= $_POST['usuario'];
		$clave= md5($_POST['clave']);
		$rol= $_POST['rol'];

		$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
		$result = mysqli_fetch_array($query);
		if ($result > 0)  {
			$alert= '<p class= "msg_error">El correo y/o Usuario ya existe.</p>';
		}else{
			
			if (empty($_POST['clave'])) {
				# code...
			}
			$query_insert = mysqli_query($conexion,"UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario = '$usuario', rol = 'rol' WHERE idusuario");
			if ($query_insert) {
				$alert= '<p class= "msg_save">Usuario creado correctamente.</p>';
			}else{
				$alert= '<p class= "msg_error">Error al crear el usuario.</p>';
			}
		}
	}
}

 ?>