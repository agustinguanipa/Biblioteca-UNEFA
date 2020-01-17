<?php
  include_once("../conexion.php");

  $email_usua = urldecode($_POST['email_usua']);
  $result = mysqli_query($conexion, "SELECT * FROM tab_usuar WHERE email_usua = '$email_usua' LIMIT 1;");
  $num = mysqli_num_rows($result);

  if($num == 0){
      echo "true";
  } else {
      echo "false";
  }
  mysqli_close($conexion);
?>