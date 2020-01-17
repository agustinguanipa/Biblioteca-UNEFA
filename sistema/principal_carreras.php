<?php 

require_once('includes/principal_header.php'); ?>

<?php 

 $perpage = 12;
  if(isset($_GET['page']) & !empty($_GET['page'])){
    $curpage = $_GET['page'];
  }else{
    $curpage = 1;
  }
  $start = ($curpage * $perpage) - $perpage;
  $PageSql = "SELECT * FROM tab_carrer WHERE statu_carr = 1";
  $pageres = mysqli_query($conexion, $PageSql);
  $totalres = mysqli_num_rows($pageres);

  $endpage = ceil($totalres/$perpage);
  $startpage = 1;
  $nextpage = $curpage + 1;
  $previouspage = $curpage - 1;

  $ReadSql = "SELECT * FROM tab_carrer WHERE statu_carr = 1 LIMIT $start, $perpage";
  $res = mysqli_query($conexion, $ReadSql);

?>

<head>
  <title>Carreras de Pre-Grado | Biblioteca UNEFA Táchira</title>
</head>

<body>
    <div class="container my-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <a href="../index.php" class="btn-sm btn-outline-primary float-left my-3"><i class="fa fa-arrow-left"></i> Volver</a>
          </div>
          <div class="col-sm-4">
            <h1 align="center">Carreras de Pre-Grado</h1>
          </div>
          <div class="col-sm-4">
             <a href="principal_pregrado.php" class="btn-sm btn-outline-primary float-right my-3">Ver Todos <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="card-deck">
        <div class="col-sm-12 form-group">
          <div class="row" align="center">
            <?php
              while($row = mysqli_fetch_assoc($res)){
            ?>
          <br>
            <div class="col-md-3">
              <br>
              <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
              <a href="principal_carreras_detalle.php?id=<?php echo $row['ident_carr']; ?>" title=""><h5 class="text-white"><?php echo $row['nombr_carr'] ?></h5></a>
            </div>
          </div>
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

