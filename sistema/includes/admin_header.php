<?php 
  session_start();
  $login = '../'.$_SESSION['foto'];

if (!isset($_SESSION['active'])) {
  header('location: ../index.php');
}

  require_once ("../conexion.php");
  require_once ("includes/funciones.php");   

 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Panel de Control | Biblioteca UNEFA Táchira</title>
  <meta name="description" content="Biblioteca UNEFA Táchira | Sistema de Almacenamiento de la Biblioteca de la UNEFA Núcleo Táchira">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--- Favicon --->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <!--- CSS --->
  <link href="css/foto.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/estilos_admin.css">
  <link rel="stylesheet" type="text/css" href="css/estilos_crud.css">
  <link href="librerias/startbootstrap-simple-sidebar-gh-pages/css/simple-sidebar.css" rel="stylesheet">
  <link href="librerias/startbootstrap-simple-sidebar-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--- jQuery --->
  <script src="librerias/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="librerias/jquery/jquery-ui.js" type="text/javascript"></script>
  <!--- jQuery Validation --->
  <script type="text/javascript" src="librerias/jquery-validation-1.19.0/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="librerias/jquery-validation-1.19.0/dist/jquery.validate.js"></script>
  <!--- jQuery Mask Plugin --->
  <script type="text/javascript" src="librerias/jQuery-Mask-Plugin/dist/jquery.mask.js"></script>
  <!--- JS --->
  <script type="text/javascript" src="js/funciones.js"></script>
  <!--- Bootstrap 4 --->
  <link rel="stylesheet" href="librerias/bootstrap-4.1.3-dist/css/bootstrap.min.css"/>
  <script src="librerias/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  <!--- Bootstrap 4 UI E-Commerce --->
  <script src="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
  <script src="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/plugins/owlcarousel/owl.carousel.min.js"></script>
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/ui.css" rel="stylesheet" type="text/css"/>
  <link href="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)"/>
  <script src="librerias/bootstrap-ecommerce-uikit/ui-ecommerce/js/script.js" type="text/javascript"></script>
  <!--- Bootstrap 4 File Style 2 --->
  <script type="text/javascript" src="librerias/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js"> </script>
  <!--- Alertify -->
  <script src="librerias/alertify/alertify.js"></script>
  <link rel="stylesheet" href="librerias/alertify/css/alertify.css"/>
  <link rel="stylesheet" href="librerias/alertify/css/themes/bootstrap.css"/>
  <script src="includes/funciones.js"></script>
   
</head>

<body>

<!-- Header --->
<?php 
  if($_SESSION['ident_tipu'] == 1 || $_SESSION['ident_tipu'] == 2) {
              
?>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading" align="center">
        <a href="admin_panel.php" style="text-decoration: none;">
          <img src="../img/logo-unefa.png" width="30" height="30" class="d-inline-block align-top" alt="">
          <span class="menu-collapsed" style="color: #000000; font-size: 14px;">Panel de Control</span>
        </a>
      </div>
      <div class="list-group list-group-flush">
        <ul class="list-group">
          <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed justify-content-center">
              <small>Menu Principal</small>
          </li>
          <!-- Menu -->
          
         
          <a href="admin_panel.php" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-home fa-fw mr-3"></span> 
                <span class="menu-collapsed">Inicio</span>
            </div>
          </a>
  
          
           <?php 
           if($_SESSION['ident_tipu'] == 1) {
              
             ?>
          <a href="./usuario_lista.php" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-users fa-fw mr-3"></span> 
                <span class="menu-collapsed">Usuarios</span>
            </div>
          </a>
          <?php
           } ?>
            <?php   
          if ($_SESSION['ident_tipu'] == 1 || $_SESSION['ident_tipu'] == 2) 
          {
            ?>
          <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-book fa-fw mr-3"></span> 
                <span class="menu-collapsed">Libros</span>
                <span class="fa fa-caret-down ml-auto"></span>
              </div>
          </a>
            <!-- Submenu -->
            <div id='submenu1' class="collapse sidebar-submenu">
              <a href="./libro_lista.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Libros</span>
              </a>
              <a href="./categoria_lista.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Categorías</span>
              </a>
            </div>
          <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-graduation-cap fa-fw mr-3"></span> 
                <span class="menu-collapsed">Pre-Grado</span>
                <span class="fa fa-caret-down ml-auto"></span>
              </div>
          </a>
            <!-- Submenu -->
            <div id='submenu2' class="collapse sidebar-submenu">
              <a href="pregrado_lista.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Trabajos</span>
              </a>
              <a href="./carreras_lista.php?identidad=<?php echo $_SESSION['ident_tipu']; ?>" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Carreras</span>
              </a>
            </div>
          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-university fa-fw mr-3"></span> 
                <span class="menu-collapsed">Post-Grado</span>
                <span class="fa fa-caret-down ml-auto"></span>
              </div>
          </a>
            <!-- Submenu -->
            <div id='submenu3' class="collapse sidebar-submenu">
              <a href="postgrado_lista.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Trabajos</span>
              </a>
              <a href="especializaciones_lista.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Especializaciones</span>
              </a>
            </div>
          <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-light text-dark list-group-item list-group-item-action flex-column align-items-start tamano-elemento-sidebar">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-cogs fa-fw mr-3"></span> 
                <span class="menu-collapsed">Administración</span>
                <span class="fa fa-caret-down ml-auto"></span>
              </div>
          </a>
            <!-- Submenu -->
            <div id='submenu4' class="collapse sidebar-submenu">
              <a href="./admin_configuracion.php" class="list-group-item list-group-item-action bg-light text-dark">
                <span class="menu-collapsed">Configuración</span>
              </a>
            </div>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
<?php
           } ?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-primary border-bottom">
        <button class="btn btn-light" id="menu-toggle"><i class="fa fa-bars"></i></button>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php 
        if($_SESSION['ident_tipu'] == 3) {
          ?>
            <li class="nav-item active">
                <a class="nav-link" href="../index.php" style="color: #FFFFFF;"><i class="fa fa-arrow-left"></i> Volver</a>
              </li>
          <?php
        }
        ?>
            <?php  if (isset($_SESSION['active'])) : ?>
              <li class="nav-item active">
                <a class="nav-link" style="color: #FFFFFF;">San Cristóbal, <?php echo fechaC(); ?></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="index.php" style="color: #FFFFFF;"><i class="fa fa-home"></i> Bienvenido <?php echo $_SESSION['nombr_usua']; ?> <?php echo $_SESSION['apeli_usua']; ?></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link"><img class="photouser" src="<?php echo $login; ?>" alt="Usuario"></a> 
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="usuario_salir.php" style="color: #FFFFFF;"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </nav>

      <div class="container-fluid panel">

