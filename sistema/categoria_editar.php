<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }


include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: categoria_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_cate, nombr_cate FROM tab_catego WHERE ident_cate = '$id' AND statu_cate = 1");
	
	
$result_user = mysqli_num_rows($query_user);


$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: categoria_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$nombr_cate = $data_user['nombr_cate'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Categoría de Libro</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="categoria_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_categoria.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombr_cate">Nombre: </label>
		            <input type="text" class="form-control" name="nombr_cate" autocomplete="off" id="nombr_cate" value="<?php echo $nombr_cate; ?>" maxlength="45" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-book"></i> Actualizar Categoria</button>
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

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#categoria_editar" ).validate( {
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