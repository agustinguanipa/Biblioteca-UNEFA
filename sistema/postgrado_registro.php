<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Registrar Trabajo de Post-Grado</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="postgrado_registro" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_postgrado.php" method="post">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="titul_post">Titulo del trabajo: </label>
		            <textarea type="textarea" class="form-control" name="titul_post" autocomplete="off" id="titul_post" placeholder="Titulo" maxlength="80" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="autor_post">Autor del trabajo: </label>
		            <input type="text" class="form-control" name="autor_post" autocomplete="off" id="autor_post" placeholder="Anthony Quintana" maxlength="45" onkeyup="this.value = this.value.toUpperCase();" required>
		          </div>
		        </div>
		        <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="tipo_post"><b>Tipo de trabajo: </b></label>
                <select class="form-control" name="tipo_post" id="tipo_post" required>
                  <option value="Maestria">Maestria</option>
                  <option value="Doctorado">Doctorado</option>
                 </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="ident_espe"><b>Carrera: </b></label>
                <?php 
                  $query_rol = mysqli_query($conexion,"SELECT * FROM  tab_especi");
                  $result_rol = mysqli_num_rows($query_rol);
                ?>
                <select class="form-control" name="ident_espe" id="ident_espe" required>
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
                <label class="form-label" for="postgrado"><b>Archivo: </b></label>  
                <input type="file" class="filestyle" id="postgrado" name="postgrado" alt="Archivo" data-btnClass="btn-primary" accept="image/*">
              </div>
            </div>
            <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-university"></i> Registrar Trabajo</button>
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

<?php require_once('includes/admin_footer.php');  ?>

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