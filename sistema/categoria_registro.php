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
			    <b>Registrar Categoría de Libro</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="categoria_registro" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/guardar_categoria.php" method="post">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombr_cate">Nombre: </label>
		            <input type="text" class="form-control" name="nombr_cate" autocomplete="off" id="nombr_cate" placeholder="Ciencias" maxlength="45" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" id="nuevo_categoria" class="btn btn-primary btn-block"><i class="fa fa-book"></i> Registrar Categoria</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="categoria_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#categoria_registro" ).validate( {
    rules: {
      nombr_cate: {
        required: true,
        lettersonly: true,
        minlength: 2,
        remote: {
          url: "categoria_nombre_availability.php",
          type: "post",
          data:
            {
              usuar_usua: function()
              {
                return $('#categoria_registro :input[name="nombr_cate"]').val();
              }
            }
        }     
      }
    },

    messages: {
      nombr_cate: {
        required: "Ingrese un Nombre",
        lettersonly: "El Nombre solo debe contener letras sin espacios",
        minlength: "El Nombre debe contener al menos 2 caracteres",
        remote: jQuery.validator.format("{0} no esta disponible")
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