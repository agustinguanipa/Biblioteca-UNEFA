<?php 

$host = 'localhost';
$user = 'master';
$pw = '12345';
$bd = 'btunefatachira';

$conexion = @mysqli_connect($host,$user,$pw,$bd);



if (!$conexion) {
	echo 'Error en la conexion!';
}
?>