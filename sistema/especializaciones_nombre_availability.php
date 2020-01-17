<?php
  include_once("../conexion.php");

  $nombr_espe = urldecode($_POST['nombr_espe']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_especi WHERE nombr_espe = '$nombr_espe' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>