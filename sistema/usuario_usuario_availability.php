<?php
  include_once("../conexion.php");

  $usuar_usua = urldecode($_POST['usuar_usua']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_usuar WHERE usuar_usua = '$usuar_usua' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>