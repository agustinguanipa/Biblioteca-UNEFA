<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: pregrado_lista.php');
}

$id = $_GET['id'];

  $query_user = mysqli_query($conexion,"SELECT u.ident_preg,u.titul_preg, u.autor_preg, u.tipo_preg, u.fecre_preg, r.ident_carr, r.nombr_carr FROM tab_pregra u INNER JOIN tab_carrer r ON u.ident_carr = r.ident_carr WHERE ident_preg = '$id' AND statu_preg = 1");
  
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
  header('location: pregrado_lista.php');
}else{
  $data_user = mysqli_fetch_array($query_user);
  
  $foto = 'img/logo-unefa.png';

  
  $titul_preg = $data_user['titul_preg'];
  $autor_preg = $data_user['autor_preg'];
  $tipo_preg = $data_user['tipo_preg'];
  $fecre_preg = $data_user['fecre_preg'];
  $nombr_carr = $data_user['nombr_carr'];
  $ident_carr = $data_user['ident_carr'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Trabajo de Pre-Grado</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="pregrado_registro" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_pregrado.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="titul_preg">Titulo del trabajo: </label>
                <input type="textarea" class="form-control" name="titul_preg" autocomplete="off" id="titul_preg" value="<?php echo $titul_preg; ?>" placeholder="Titulo" maxlength="80" onkeyup="this.value = this.value.toUpperCase();" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="autor_preg">Autor del trabajo: </label>
                <input type="text" class="form-control" name="autor_preg" autocomplete="off" id="autor_preg" value="<?php echo $autor_preg; ?>" placeholder="Anthony Quintana" maxlength="45" onkeyup="this.value = this.value.toUpperCase();" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="tipo_preg"><b>Tipo de trabajo: </b></label>
                <select class="form-control" name="tipo_preg" id="tipo_preg" required>
                   <option value="<?php echo $tipo_preg; ?>"><?php echo $tipo_preg; ?></option>
                  <option value="Pasantias">Pasantias</option>
                  <option value="Trabajo especial de grado">Trabajo especial de grado</option>
                 </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="ident_carr"><b>Carrera: </b></label>
                <?php
                 include '../conexion.php'; 
                  $query_rol = mysqli_query($conexion,"SELECT * FROM tab_carrer");
                  $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select class="form-control" name="ident_carr" id="ident_carr" required>
                  <option value="<?php echo $ident_carr;?>"><?php echo $nombr_carr;?></option>
                  <?php 
                    if ($result_rol > 0) {
                    while ($rol = mysqli_fetch_array($query_rol)) {?>
                    <option value="<?php echo $rol['ident_carr'];?>"><?php echo $rol['nombr_carr'];?></option>
                  <?php
                  }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-graduation-cap"></i> Actualizar Trabajo</button>
                <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
              </div>
            </div>
          </form>
				</div>
				<div class="card-footer">
           <a href="pregrado_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#pregrado_registro" ).validate( {
    rules: {
      titul_preg: {
        required: true,
        minlength: 10
      },
      autor_preg: {
        required: true,
        minlength: 10
      }
    },

    messages: {
      titul_preg: {
        required: "Ingrese el Titulo",
        minlength: "El Titulo debe contener al menos 10 caracteres"
      },
      autor_preg: {
        required: "Ingrese el Autor",
        minlength: "El Autor debe contener al menos 10 caracteres"
      }
    },

    errorElement: "em",
    errorPlacement: function ( error, element ) {
      // Add the `invalid-feedback` class to the error element
      error.addClass( "invalid-feedback" );

      if ( element.prop( "type" ) === "checkbox" ) {
        error.insertAfter( element.next( "label" ) );
      } else {
        error.insertAfter( element );
      }
    },
    highlight: function ( element, errorClass, validClass ) {
      $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
    }
  } );

} );

  jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[A-Z^\s]+$/i.test(value);
}, "Letters only please"); 

</script>

<?php require_once('includes/admin_footer.php');  ?>