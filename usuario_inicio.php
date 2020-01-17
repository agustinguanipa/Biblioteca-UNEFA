<?php 

$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: index.php');
}else{

  if (!empty($_POST)) {
    if (empty($_POST['usuar_usua']) || empty($_POST['contr_usua'])) 
    {
      $alert = '(*) Ingrese su usuario y/o clave';
    }else{

      require_once 'conexion.php';
      $usuar_usua = mysqli_real_escape_string($conexion, $_POST['usuar_usua']);
      $contr_usua = md5(mysqli_real_escape_string($conexion, $_POST['contr_usua']));

      $query = mysqli_query($conexion,"SELECT u.ident_usua,u.nombr_usua,u.apeli_usua,u.email_usua,u.usuar_usua,u.contr_usua,u.fotou_usua ,r.ident_tipu, r.nombr_tipu FROM tab_usuar u INNER JOIN tab_tipusu r ON u.ident_tipu = r.ident_tipu WHERE u.usuar_usua = '$usuar_usua' AND u.contr_usua = '$contr_usua'");
      
      $result = mysqli_num_rows($query);

      if ($result > 0)
      {
        
        $query_r =  mysqli_query($conexion,"SELECT * FROM tab_usuar WHERE usuar_usua = '$usuar_usua' AND statu_usua = 0");
        mysqli_close($conexion);
        $result_r  = mysqli_num_rows($query_r);

         if ($result_r > 0) {
            $alert = '(*) El usuario esta inactivo.';
            session_destroy();
          }else{

            $data = mysqli_fetch_array($query);
        if ($data['fotou_usua'] != 'user.png') 
        {
          $foto = 'sistema/img/uploads/'.$data['fotou_usua'];
        }else{
           $foto = 'sistema/img/'.$data['fotou_usua'];
        }
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['ident_usua'];
        $_SESSION['nombr_usua'] = $data['nombr_usua'];
        $_SESSION['apeli_usua'] = $data['apeli_usua'];
        $_SESSION['email_usua'] = $data['email_usua'];
        $_SESSION['usuar_usua'] = $data['usuar_usua'];
        $_SESSION['ident_tipu'] = $data['ident_tipu'];
        $_SESSION['nombr_tipu'] = $data['nombr_tipu'];
        $_SESSION['contr_usua'] = $data['contr_usua'];

        
        $_SESSION['foto'] = $foto;
        
        if ($_SESSION['ident_tipu'] == 1 || $_SESSION['ident_tipu'] == 2) {
          header('location: sistema/admin_panel.php');
        }else{
          header('location: index.php');
        }

          }
      }else{

        $alert = '(*) El usuario y/o contraseña son incorrectos.';
        session_destroy();
      }
    }
  }
}

?>

<?php require_once('sistema/includes/logreg_header.php'); ?>

<head>
  <title>Iniciar Sesión | Biblioteca UNEFA Táchira</title>
</head>

<body>

<!-- Header --->

<header class="section-header">
  <section class="header-main">
    <div class="container" align="center">
      <div class="row align-items-center">
        <div class="col-sm-12">
          <div class="brand-wrap">
            <a href="index.php" style="color: #000000; text-decoration: none;">
              <img class="logo" src="img/logo-unefa.png">
              <h2 class="logo-text">Biblioteca UNEFA Táchira</h2>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</header>

<body>
  <div class="container">
    <div class="form-group text-center">
      <div class="formulario-registro-inicio">
        <form name="form" id="usuario_inicio" class="justify-content-center" align="center" action="" method="post">
          <h3>Iniciar Sesión</h3>
          <hr class="my-4">
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="usuar_usua">Usuario: </label>
              <input type="text" class="form-control" name="usuar_usua" autocomplete="off" id="usuar_usua" placeholder="miusuario" maxlength="20" onkeyup="this.value = this.value.toUpperCase();">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <label class="form-label" for="contr_usua">Contraseña: </label>
              <input type="password" class="form-control" name="contr_usua" autocomplete="off" id="contr_usua" placeholder="********" maxlength="20">
            </div>
          </div>
          <div class="form-row">
            <div class="col form-group">
              <div class="alert" style="color: #FC0107; font-style: italic;"><?php echo isset($alert)? $alert : ''; ?></div>
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Iniciar Sesión</button>
              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
            </div>
          </div>
          <p class="text-center">No Tienes una Cuenta? <a href="estudiante_registro.php">Registrarse</a> </p>
        </form>
      </div> 
    </div>
  </div>
</body>

<?php require_once('sistema/includes/logreg_footer.php'); ?>



