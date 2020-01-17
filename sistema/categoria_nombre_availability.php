<?php
  include_once("../conexion.php");

  $nombr_cate = urldecode($_POST['nombr_cate']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_catego WHERE nombr_cate = '$nombr_cate' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>