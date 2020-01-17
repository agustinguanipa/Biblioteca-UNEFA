<?php
  include_once("../conexion.php");

  $nombr_carr = urldecode($_POST['nombr_carr']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_carrer WHERE nombr_carr = '$nombr_carr' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>