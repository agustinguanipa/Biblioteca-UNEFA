<?php require_once('includes/principal_header.php'); ?>

<?php 

 $perpage = 4;
  if(isset($_GET['page']) & !empty($_GET['page'])){
    $curpage = $_GET['page'];
  }else{
    $curpage = 1;
  }
  $start = ($curpage * $perpage) - $perpage;
  $PageSql = "SELECT * FROM tab_libros WHERE statu_libr = 1";
  $pageres = mysqli_query($conexion, $PageSql);
  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres/$perpage);
  $startpage = 1;
  $nextpage = $curpage + 1;
  $previouspage = $curpage - 1;

  $ReadSql = "SELECT u.ident_libr, u.nombr_libr, u.autor_libr, u.image_libr, u.archi_libr, u.fecre_libr, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE statu_libr = 1 LIMIT $start, $perpage";
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
            <a href="../index.php" class="btn-sm btn-outline-primary float-left my-3"><i class="fa fa-arrow-left"></i> Volver</a>
          </div>
          <div class="col-sm-4">
            <h1 align="center">Libros</h1>
          </div>
          <div class="col-sm-4">
             <a href="principal_categoria.php" class="btn-sm btn-outline-primary float-right my-3">Ir a Categorías <i class="fa fa-arrow-right"></i></a>
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
              <div class="card card-product">
                <div class="img-wrap"><img src="<?php echo $foto; ?>" width="100"></div>
                  <figcaption class="info-wrap" scope="r">
                    <a href="principal_libro_detalle.php?id=<?php echo $row['ident_libr']; ?>" title=""><h5 class="title"><?php echo $row['nombr_libr'] ?></h5></a>
                    <p class="desc"><?php echo $row['autor_libr'] ?></p>
                    <p class="desc"><?php echo $row['nombr_cate'] ?></p>
                  </figcaption>
                  <div class="card-footer">
                    <?php if (isset($_SESSION['active'])) { ?>   
                    <a href="img/libros/<?php echo $row['archi_libr']; ?>" download="<?php echo $row['nombr_libr']; ?>.pdf" class="btn btn-sm btn-primary float-right"><i class="fa fa-cloud-download-alt"></i> Descargar</a>
                    <?php   } ?>
                  
                    <a href="principal_libro_detalle.php?id=<?php echo $row['ident_libr']; ?>" class="btn btn-sm btn-success float-left"><i class="fa fa-eye"></i> Ver</a>
                  </div>
              </div> 
            </div>
            <?php
              }
            ?>
          </div>
          </br>
          <nav aria-label="Page navigation">
            <ul class="pagination float-right">
            <?php if($curpage != $startpage){ ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">First</span>
                </a>
              </li>
              <?php } ?>
              <?php if($curpage >= 2){ ?>
              <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
              <?php } ?>
              <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
              <?php if($curpage != $endpage){ ?>
              <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
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

