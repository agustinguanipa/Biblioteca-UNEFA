<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }



include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: postgrado_lista.php');
}

$id = $_GET['id'];

  $query_user = mysqli_query($conexion,"SELECT u.ident_post,u.titul_post, u.autor_post, u.tipo_post, u.fecre_post, r.ident_espe, r.nombr_espe FROM tab_postgr u INNER JOIN tab_especi r ON u.ident_espe = r.ident_espe WHERE ident_post = '$id' AND statu_post = 1");
  
$result_user = mysqli_num_rows($query_user);

$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
  header('location: postgrado_lista.php');
}else{
  $data_user = mysqli_fetch_array($query_user);
  
  $foto = 'img/logo-unefa.png';

  
  $titul_post = $data_user['titul_post'];
  $autor_post = $data_user['autor_post'];
  $tipo_post = $data_user['tipo_post'];
  $fecre_post = $data_user['fecre_post'];
  $nombr_espe = $data_user['nombr_espe'];
  $ident_espe = $data_user['ident_espe'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Trabajo de Post-Grado</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="postgrado_registro" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_postgrado.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="titul_post">Titulo del trabajo: </label>
                <input type="textarea" class="form-control" name="titul_post" autocomplete="off" id="titul_post" value="<?php echo $titul_post; ?>" placeholder="Titulo" maxlength="80" onkeyup="this.value = this.value.toUpperCase();" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="autor_post">Autor del trabajo: </label>
                <input type="text" class="form-control" name="autor_post" autocomplete="off" id="autor_post" value="<?php echo $autor_post; ?>" placeholder="Anthony Quintana" maxlength="45" onkeyup="this.value = this.value.toUpperCase();" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="tipo_post"><b>Tipo de trabajo: </b></label>
                <select class="form-control" name="tipo_post" id="tipo_post" required>
                   <option value="<?php echo $tipo_post; ?>"><?php echo $tipo_post; ?></option>
                  <option value=" Maestria">Maestria</option>
                  <option value="Doctorado">Doctorado</option>
                 </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="ident_carr"><b>Carrera: </b></label>
                <?php
                 include '../conexion.php'; 
                  $query_rol = mysqli_query($conexion,"SELECT * FROM tab_especi");
                  $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select class="form-control" name="ident_espe" id="ident_espe" required>
                  <option value="<?php echo $ident_espe;?>"><?php echo $nombr_espe;?></option>
                  <?php 
                    if ($result_rol > 0) {
                    while ($rol = mysqli_fetch_array($query_rol)) {?>
                    <option value="<?php echo $rol['ident_espe'];?>"><?php echo $rol['nombr_espe'];?></option>
                  <?php
                  }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-university"></i> Actualizar Trabajo</button>
                <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
              </div>
            </div>
          </form>
				</div>
				<div class="card-footer">
           <a href="postgrado_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#postgrado_registro" ).validate( {
    rules: {
      titul_post: {
        required: true,
        minlength: 10
      },
      autor_post: {
        required: true,
        minlength: 10
      }
    },

    messages: {
      titul_post: {
        required: "Ingrese el Titulo",
        minlength: "El Titulo debe contener al menos 10 caracteres"
      },
      autor_post: {
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