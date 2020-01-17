<?php 

require_once('includes/principal_header.php'); ?>

<?php

$id = $_GET['id'];

 $perpage = 4;
  if(isset($_GET['page']) & !empty($_GET['page'])){
    $curpage = $_GET['page'];
  }else{
    $curpage = 1;
  }
  $start = ($curpage * $perpage) - $perpage;
  $PageSql = "SELECT * FROM tab_libros WHERE ident_cate = '$id' AND statu_libr = 1";
  $pageres = mysqli_query($conexion, $PageSql);
  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres/$perpage);
  $startpage = 1;
  $nextpage = $curpage + 1;
  $previouspage = $curpage - 1;

  $ReadSql = "SELECT * FROM tab_libros WHERE ident_cate = '$id' AND statu_libr = 1 LIMIT $start, $perpage";
  $res = mysqli_query($conexion, $ReadSql);

?>

<head>
  <title>Libros | Biblioteca UNEFA Táchira</title>
</head>

<body>
    <div class="container my-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <a href="principal_categoria.php" class="btn-sm btn-outline-primary float-left my-3"><i class="fa fa-arrow-left"></i> Volver</a>
          </div>
          <div class="col-sm-4">
            <?php
              include "../conexion.php";
              $query_rol = mysqli_query($conexion,"SELECT t.nombr_cate, p.image_libr, p.ident_cate, p.ident_libr,t.ident_cate FROM  tab_libros p  INNER JOIN tab_catego t ON t.ident_cate = p.ident_cate WHERE p.ident_cate = $id");
              $result_rol = mysqli_num_rows($query_rol);
            ?>
            <?php 
              if ($result_rol > 0) {
              $rol = mysqli_fetch_array($query_rol)?>
              <h1 align="center">Libros | <?php echo $rol['nombr_cate'] ?></h1>
              <?php
              
            }
            ?>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="card-deck">
        <div class="col-sm-12 form-group">
          <div class="row" align="center">
            <?php
              while($row = mysqli_fetch_assoc($res)){
                if ($row['image_libr'] != 'user.png') 
                {
                  $foto = 'img/uploads/'.$row['image_libr'];
                }else{
                  $foto = 'img/'.$row['image_libr'];
                }
            ?>
          <br>
            <div class="col-lg-3">
              <br>
              <figure class="card card-product">
                <div class="img-wrap"><img src="<?php echo $foto; ?>" width="100"></div>
                  <figcaption class="info-wrap" scope="r">
                    <a href="principal_libro_detalle.php?id=<?php echo $row['ident_libr']; ?>" title=""><h5 class="title"><?php echo $row['nombr_libr'] ?></h5></a>
                    <p class="desc"><?php echo $row['autor_libr'] ?></p>
                  </figcaption>
                  
                  <div class="card-footer">
                    <?php if (isset($_SESSION['active'])) { ?>   
                    <a href="img/libros/<?php echo $row['archi_libr']; ?>" download="<?php echo $row['nombr_libr']; ?>.pdf" class="btn btn-sm btn-primary float-right"><i class="fa fa-cloud-download-alt"></i> Descargar</a>
                    <?php   } ?> 
                   
                    <a href="principal_libro_detalle.php?id=<?php echo $row['ident_libr']; ?>" class="btn btn-sm btn-success float-left"><i class="fa fa-eye"></i> Ver</a>
                  </div> <!-- bottom-wrap.// -->
              </figure> 
            </div> <!-- col // -->
            <?php
              }
            ?>
          </div> <!-- r.// -->
          </br>
          <nav aria-label="Page navigation">
            <ul class="pagination float-right">
            <?php if($curpage != $startpage){ ?>
              <li class="page-item">
                <a class="page-link" href="principal_categoria_detalle.php?id=<?php echo $id?>&page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">First</span>
                </a>
              </li>
              <?php } ?>
              <?php if($curpage >= 2){ ?>
              <li class="page-item"><a class="page-link" href="principal_categoria_detalle.php?id=<?php echo $id?>&page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
              <?php } ?>
              <li class="page-item active"><a class="page-link" href="principal_categoria_detalle.php?id=<?php echo $id?>&page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
              <?php if($curpage != $endpage){ ?>
                
              <li class="page-item"><a class="page-link" href="principal_categoria_detalle.php?id=<?php echo $id?>&page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
              <li class="page-item">
                <a class="page-link" href="principal_categoria_detalle.php?id=<?php echo $id?>&page=<?php echo $endpage ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Last</span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require_once('includes/principal_footer.php'); ?>

