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
			    <b>Registrar Libro</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="libro_registro" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_libro.php" method="post">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombr_libr">Nombre: </label>
		            <input type="text" class="form-control" name="nombr_libr" autocomplete="off" id="nombr_libr" placeholder="801 Integrales Indefinidas" maxlength="50" onkeyup="this.value = this.value.toUpperCase();" required>
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="descr_libr">Descripcion: </label>
		            <textarea type="textarea" class="form-control" name="descr_libr" autocomplete="off" id="descr_libr" placeholder="801 Integrales Indefinidas resueltas paso a paso" maxlength="250" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="autor_libr">Autor: </label>
		            <input type="text" class="form-control" name="autor_libr" autocomplete="off" id="autor_libr" placeholder="Italo Cortes" maxlength="50" onkeyup="this.value = this.value.toUpperCase();" required>
		          </div>
		        </div>
		         <div class="form-row">
		          <div class="col form-group">
                <div class="photo">
                      <label class="form-label" for="fotou_usua"><b>Imagen: </b></label>  
                        <div class="prevPhoto">
                        <span class="delPhoto notBlock">X</span>
                        <label for="foto"></label>
                        </div>
                        <div class="upimg">
                        <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                </div>
		            <!-- <label class="form-label" for="fotou_usua"><b>Imagen de Perfil: </b></label>  
		            <input type="file" class="filestyle" id="foto" name="foto" alt="Imagen de Perfil" data-btnClass="btn-primary" accept="image/*"> -->
		          </div>
		        </div>
             <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="fotou_usua"><b>Archivo: </b></label>  
                <input type="file" class="filestyle" id="libro" name="libro" alt="Imagen de Perfil" data-btnClass="btn-primary" accept="image/*">
              </div>
            </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="ident_cate"><b>Categoría: </b></label>
		            <?php 
									$query_rol = mysqli_query($conexion,"SELECT * FROM  tab_catego");
									$result_rol = mysqli_num_rows($query_rol);
								?>
								<select class="form-control" name="ident_cate" id="ident_cate" required>
									<?php 
										if ($result_rol > 0) {
										while ($rol = mysqli_fetch_array($query_rol)) {?>
										<option value="<?php echo $rol['ident_cate'];?>"><?php echo $rol['nombr_cate'];?></option>
									<?php
									}
									}
									?>
								</select>
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-book"></i> Registrar Libro</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="libro_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

 <script type="text/javascript">
	$( document ).ready( function () {
  $( "#libro_registro" ).validate( {
    rules: {
      nombr_libr: {
        required: true,
        minlength: 2
      },
      descr_libr: {
        required: true,
        minlength: 10
      },
      autor_libr: {
        required: true,
        lettersonly: true,
        minlength: 2
      }
    },

    messages: {
      nombr_libr: {
        required: "Ingrese el Nombre",
        minlength: "El Nombre debe contener al menos 2 caracteres"
      },
      descr_libr: {
        required: "Ingrese la Descripción",
        minlength: "La Descripción debe contener al menos 10 caracteres"
      },
      autor_libr: {
        required: "Ingrese el Autor",
        lettersonly: "El Autor solo debe contener letras sin espacios",
        minlength: "El Autor debe contener al menos 2 caracteres"
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