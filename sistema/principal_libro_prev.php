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
            $query_rol = mysqli_query($conexion,"SELECT t.nombr_cate, p.ident_cate, t.ident_cate FROM  tab_libros p  INNER JOIN tab_catego t ON t.ident_cate = p.ident_cate WHERE p.ident_cate = $id");
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
      <div class="col-sm-4 form-group">
        <?php
          
          $query="SELECT u.ident_libr, u.nombr_libr, u.descr_libr,u.image_libr,u.archi_libr, u.autor_libr, u.fecre_libr, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE ident_libr = '$id'";
          $resultado= $conexion->query($query);

          
          while($row=$resultado->fetch_assoc()){

            $libro = '';
            if ($row['image_libr'] != 'user.png') 
            {
              $foto = 'img/uploads/'.$row['image_libr'];
            }else{
              $foto = 'img/'.$row['image_libr'];
            }
        
          
        ?>
        <div class="card">
          <div class="row no-gutters">
            <div class="card-header border-right">
              <article class="gallery-wrap"> 
              <div class="img-wrap">
                <div> <a href="#" data-fancybox=""><img src="<?php echo $foto; ?>" width="500"></a></div>
              </div>
              </article> 
            </div>
            <div class="card-body">
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
                
              </article>
            </div> 
          </div> 
        </div> 
      </div>
      <div class="col-sm-8 form-group">
        <div class="card h-100">
          <div class="card-header">
            <h5><b>Previsualización del Libro</b></h5>
          </div>
          <div class="card-body">

            <?php if (!isset($_SESSION['active'])) { ?>   
              <div style="width: 95.5%; background: #000; height: 45px; position: absolute; position-height: 100px;">
    
              
            
               </div>
             
            <?php   } ?> 



            <?php if (!isset($_SESSION['active'])) { ?>   
            
            <?php   } ?> 
               <embed height="100%" width="100%" name="embed_content" src="img/libros/<?php echo $row['archi_libr']; ?>" type="application/pdf">   
            </div>
              </div>
            <?php 
          }
        ?>
            </div>
          </div>
        </div>
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