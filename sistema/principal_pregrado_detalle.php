<?php 

require_once('includes/principal_header.php'); 

$id = $_GET['id'];

?>

<head>
  <title>Trabajos de Pre-Grado | Biblioteca UNEFA Táchira</title>
</head>

<body>
  <div class="container my-3 text-center">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <button class="btn-sm btn-outline-primary float-left my-3" onclick="goListado()"><i class="fa fa-arrow-left"></i> Volver</button>
        </div>
        <div class="col-sm-4">
          <?php
            include "../conexion.php";
            $query_rol = mysqli_query($conexion,"SELECT t.nombr_carr, p.ident_carr, t.ident_carr, p.ident_preg FROM  tab_pregra p  INNER JOIN tab_carrer t ON t.ident_carr = p.ident_carr WHERE p.ident_preg = $id");
            $result_rol = mysqli_num_rows($query_rol);
          ?>
          <?php 
              if ($result_rol > 0) {
              $rol = mysqli_fetch_array($query_rol)?>
              <h1 align="center">Trabajo | <?php echo $rol['nombr_carr'] ?></h1>
              <?php
              
            }
            ?>
        </div>
      </div>
    </div>
    <hr class="my-4">
    <div class="row">
      <div class="col-sm-12 form-group">
        <?php
          
          $query="SELECT u.ident_preg, u.titul_preg, u.autor_preg,u.archi_preg, u.tipo_preg, u.fecre_preg, r.nombr_carr, r.ident_carr FROM tab_pregra u INNER JOIN tab_carrer r ON u.ident_carr = r.ident_carr WHERE u.ident_preg = '$id'";
          $resultado= $conexion->query($query);
          while($row=$resultado->fetch_assoc()){
           
              $foto = 'img/logo-unefa.png';
            

        ?>
        <div class="card">
          <div class="row no-gutters">
            <aside class="col-sm-5 border-right">
              <article class="gallery-wrap"> 
              <div class="img-wrap">
                <div> <a href="#" data-fancybox=""><img src="<?php echo $foto; ?>" width="500"></a></div>
              </div>
              </article> 
            </aside>
            <aside class="col-sm-7">
              <article class="p-5">
                <h3 class="title mb-3"><?php echo $row['titul_preg'] ?></h3>
                <hr>
                <dl>
                  <dt>Autor del Trabajo:</dt>
                  <dd><p><?php echo $row['autor_preg'] ?></p></dd>
                </dl>
                <dl>
                  <dt>Tipo de Trabajo:</dt>
                  <dd><p><?php echo $row['tipo_preg'] ?></p></dd>
                </dl>
                <dl>
                  <dt>Carrera del Trabajo:</dt>
                  <dd><p><?php echo $row['nombr_carr'] ?></p></dd>
                </dl>
                <hr>
                <?php if (isset($_SESSION['active'])) { ?>
                <a href="img/pregrado/<?php echo $row['archi_preg']; ?>" download="<?php echo $row['autor_preg']; ?>.pdf" class="btn btn-primary float-right"><i class="fa fa-cloud-download-alt"></i> Descargar</a>
                <?php   } ?> 
                
                <a href="principal_pregrado_prev.php?id=<?php echo $row['ident_preg']; ?>" class="btn btn-info float-left"><i class="fa fa-file-pdf"></i> Previsualizar</a>
              </article>
            </aside> 
          </div> 
        </div> 
        <?php 
          }
        ?>
      </div>
    </div>
  </div>
  
</body>

<?php require_once('includes/principal_footer.php'); ?>

<script>
function goListado() {
  window.history.back();
}
</script>