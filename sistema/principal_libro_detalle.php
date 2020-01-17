<?php 

require_once('includes/principal_header.php'); 

$id = $_GET['id'];

?>

<head>
  <title>Libros | Biblioteca UNEFA Táchira</title>
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
            $query_rol = mysqli_query($conexion,"SELECT t.nombr_cate,p.ident_libr, p.ident_cate, t.ident_cate FROM  tab_libros p  INNER JOIN tab_catego t ON t.ident_cate = p.ident_cate WHERE p.ident_libr = $id");
            $result_rol = mysqli_num_rows($query_rol);
          ?>
          <?php 
              if ($result_rol > 0) {
              $rol = mysqli_fetch_array($query_rol)?>
              <h1 align="center">Libro | <?php echo $rol['nombr_cate'] ?></h1>
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
          
          $query="SELECT u.ident_libr, u.nombr_libr, u.descr_libr,u.image_libr,u.archi_libr, u.autor_libr, u.fecre_libr, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE u.ident_libr = '$id'";
          $resultado= $conexion->query($query);
          while($row=$resultado->fetch_assoc()){
            if ($row['image_libr'] != 'user.png') 
            {
              $foto = 'img/uploads/'.$row['image_libr'];
            }else{
              $foto = 'img/'.$row['image_libr'];
            }

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
                <h3 class="title mb-3"><?php echo $row['nombr_libr'] ?></h3>
                <hr>
                <dl>
                  <dt>Categoría:</dt>
                  <dd><p><?php echo $row['nombr_cate'] ?></p></dd>
                </dl>
                <dl>
                  <dt>Autor:</dt>
                  <dd><p><?php echo $row['autor_libr'] ?></p></dd>
                </dl>
                <dl>
                  <dt>Descripción:</dt>
                  <dd><p><?php echo $row['descr_libr'] ?></p></dd>
                </dl>
                <hr>
                <?php if (isset($_SESSION['active'])) { ?>
                <a href="img/libros/<?php echo $row['archi_libr']; ?>" download="<?php echo $row['nombr_libr']; ?>.pdf" class="btn btn-primary float-right"><i class="fa fa-cloud-download-alt"></i> Descargar</a>
                <?php   } ?> 
                
                <a href="principal_libro_prev.php?id=<?php echo $row['ident_libr']; ?>" class="btn btn-info float-left"><i class="fa fa-file-pdf"></i> Previsualizar</a>
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