<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }


include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: especializaciones_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT ident_espe, nombr_espe FROM tab_especi WHERE ident_espe = '$id' AND statu_espe = 1");
	
	
$result_user = mysqli_num_rows($query_user);


$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: especializaciones_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	
	$nombr_espe = $data_user['nombr_espe'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Especializacion</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="especializacion_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_especializaciones.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombr_espe">Nombre: </label>
		            <input type="text" class="form-control" name="nombr_espe" autocomplete="off" id="nombr_espe" value="<?php echo $nombr_espe; ?>" maxlength="40" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-university"></i> Actualizar Especializacion</button>
		            <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
		          </div>
		        </div>
		      </form>
				</div>
				<div class="card-footer">
           <a href="especializaciones_lista.php" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Volver al Listado</a> 
				</div>
    </div> 
  </div>
</div>

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#especializacion_editar" ).validate( {
    rules: {
      nombr_espe: {
        required: true,
        lettersonly: true,
        minlength: 2,
        remote: {
          url: "especializaciones_nombre_availability.php",
          type: "post",
          data:
            {
              usuar_usua: function()
              {
                return $('#especializacion_registro :input[name="nombr_espe"]').val();
              }
            }
        }     
      }
    },

    messages: {
      nombr_espe: {
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