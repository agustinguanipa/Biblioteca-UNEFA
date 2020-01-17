<?php 
  session_start();

  require_once ("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio | Biblioteca UNEFA Táchira</title>
  <meta name="description" content="Biblioteca UNEFA Táchira | Sistema de Almacenamiento de la Biblioteca de la UNEFA Núcleo Táchira">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--- Favicon --->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <!--- CSS --->
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
  <!--- jQuery --->
  <script src="sistema/librerias/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <!--- jQuery Validation --->
  <script type="text/javascript" src="sistema/librerias/jquery-validation-1.19.0/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="sistema/librerias/jquery-validation-1.19.0/dist/jquery.validate.js"></script>
  <!--- jQuery Mask Plugin --->
  <script type="text/javascript" src="sistema/librerias/jQuery-Mask-Plugin/dist/jquery.mask.js"></script>
  <!--- JS --->
  <script src="js/validacion.js" type="text/javascript"></script>
  <script src="js/admin_sidebar.js" type="text/javascript"></script>
  <!--- Bootstrap 4 --->
  <link rel="stylesheet" href="sistema/librerias/bootstrap-4.1.3-dist/css/bootstrap.min.css"/>
  <script src="sistema/librerias/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <!--- Bootstrap 4 UI E-Commerce --->
  <script src="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/js/jquery-2.0.0.min.js" type="text/javascript"></script>
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
  <script src="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/owl.carousel.min.js"></script>
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/ui.css" rel="stylesheet" type="text/css"/>
  <link href="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)"/>
  <script src="sistema/librerias/bootstrap-ecommerce-uikit/ui-ecommerce/js/script.js" type="text/javascript"></script>
</head>

<body>

<!-- Header --->
<header class="section-header">
  <!-- Barra 1 --->
  <nav class="navbar navbar-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTop">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php" style="font-style: italic; font-weight: bold;"> "Excelencia Educativa Abierta al Pueblo" </a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Inicio </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sistema/principal_nosotros.php"><i class="fa fa-info"></i> Nosotros </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sistema/principal_contacto.php"><i class="fa fa-phone"></i> Contacto </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Barra 2 --->

  <section class="header-main" style="background-color: #EEEEEE;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5-24 col-sm-5 col-4">
          <div class="brand-wrap">
            <a href="index.php" style="color: #000000; text-decoration: none;">
              <img class="logo" src="img/logo-unefa.png">
              <h2 class="logo-text" style="color: #000000; text-decoration: none; font-size: 15px; font-weight: bold;">Biblioteca UNEFA Táchira</h2>
            </a>
          </div>
        </div>
        <div class="col-lg-18-24 col-sm-7 col-8  order-2  order-lg-3">
          <div class="d-flex justify-content-end">
            <?php  if (isset($_SESSION['active'])) :  ?>
              <div class="widget-header">
                <small class="title text-muted">Bienvenido <?php echo $_SESSION['nombr_usua']; ?> <?php echo $_SESSION['apeli_usua']; ?></small>
                <div>
                 
                </div> <?php
                    // Session is Set
                     
                        
                        if ($_SESSION['ident_tipu'] == 3) 
                      {
                        echo "<a href='sistema/admin_configuracion.php' class='text-dark'>Mi Cuenta</a> <span class='dark-transp'>   | </span>";
                      }else{
                        echo "<a href='sistema/admin_panel.php' class='text-dark'>Mi Cuenta</a> <span class='dark-transp'>   | </span>";
                        }
                      
                      echo "<a href='sistema/usuario_salir.php' class='text-dark  float-right'>Cerrar Sesión</a>";
                  ?>
              </div>
            <?php endif ?>
            <?php  if (!isset($_SESSION['active'])) : ?>
              <div class="widget-header">
                <small class="title text-muted">Bienvenido Visitante</small>
                <div>
                  <?php
                    // Session is Not Set
                    echo "<a href='usuario_inicio.php' class='text-dark'>Iniciar Sesión</a> <span class='dark-transp'> | </span>";
                    echo "<a href='estudiante_registro.php' class='text-dark'>Registrarse</a>"; 
                  ?>
                </div>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Main --->

<!-- Contenido -->

<div class="jumbotron text-center" id="fondo_sobre_mi" style="margin-bottom:0; background-color: #FFFFFF;">
    <div class="container-fluid">
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="img/libros-1.jpg" alt="Card Libros">
          <div class="card-body">
            <h5 class="card-title text-center"><b>Libros</b></h5>
            <p class="card-text text-center">Material Bibligráfico Digitalizado</p>
          </div>
          <div class="card-footer" align="center">
            <a href="sistema/principal_libro.php" class="btn btn-sm btn-primary">Ver Todos</a>
            <a href="sistema/principal_categoria.php" class="btn btn-sm btn-primary">Ver Categorías</a>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="img/libros-2.jpg" alt="Card Pre-Grado">
          <div class="card-body">
            <h5 class="card-title text-center"><b>Pre-Grado</b></h5>
            <p class="card-text text-center">Informes de Pasantías y Trabajos Especiales de Grado</p>
          </div>
          <div class="card-footer" align="center">
            <a href="sistema/principal_pregrado.php" class="btn btn-sm btn-primary">Ver Todo</a>
            <a href="sistema/principal_carreras.php" class="btn btn-sm btn-primary">Ver Carreras</a>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="img/libros-3.jpg" alt="Card Post-Grado">
          <div class="card-body">
            <h5 class="card-title text-center"><b>Post-Grado</b></h5>
            <p class="card-text text-center">Trabajos de Maestria y Doctorado</p>
          </div>
          <div class="card-footer" align="center">
            <a href="sistema/principal_postgrado.php" class="btn btn-sm btn-primary">Ver Todo</a>
            <a href="sistema/principal_especializaciones.php" class="btn btn-sm btn-primary">Ver Especialidades</a>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Footer --->
<footer class="section-footer bg2">
  <div class="container">
    <section class="footer-bottom row">
      <div class="col-sm-6" align="left"> 
        <p>Diseñado y Desarrollado por: <br><a href="#" title="Anthony Ismael Quintana Fernández">Anthony Ismael Quintana Fernández</a> y <a href="https://agustinguanipa.000webhostapp.com/" title="Carlos Agustin Guanipa Alvarez">Carlos Agustin Guanipa Alvarez</a></p>
      </div>
      <div class="col-sm-6" align="right">
        <p class="text-sm-right">Sistema de Gestion de la Biblioteca de la UNEFA Núcleo Táchira</p>
        <p class="text-sm-right">Copyright &copy 2019<br>
        </p>
      </div>
    </section>
  </div>
</footer>

</body>
</html>



