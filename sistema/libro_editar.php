<?php 
  require_once('includes/admin_header.php');
  if ($_SESSION['ident_tipu'] == 3) 
    {
      header('location: ../index.php');
    }
 

include '../conexion.php' ;

if (empty($_GET['id'])) {
	header('location: libro_lista.php');
}

$id = $_GET['id'];

	$query_user = mysqli_query($conexion,"SELECT u.ident_libr,u.nombr_libr, u.descr_libr, u.autor_libr, u.image_libr, r.ident_cate, r.nombr_cate FROM tab_libros u INNER JOIN tab_catego r ON u.ident_cate = r.ident_cate WHERE ident_libr = '$id' AND statu_libr = 1");
	
	
$result_user = mysqli_num_rows($query_user);


$foto = '';
$classRemove = 'notBlock';

if ($result_user == 0) 
{
	header('location: libro_lista.php');
}else{
	$data_user = mysqli_fetch_array($query_user);
	if ($data_user['image_libr'] != 'libros.png') 
	{
		$classRemove = '';
		$foto = '<img id="img" src="img/uploads/'.$data_user['image_libr'].'" alt="libro">';
	}
	
	$nombr_libr = $data_user['nombr_libr'];
  $descr_libr = $data_user['descr_libr'];
  $autor_libr = $data_user['autor_libr'];
  $ident_cate = $data_user['ident_cate'];
  $nombr_cate = $data_user['nombr_cate'];
}
mysqli_close($conexion);
?>

<div class="container col-lg-6">
  <div class="form-group text-center">
    <div class="card">
    	<div class="card-header">
			    <b>Editar Libro</b>
			  </div>
		   	<div class="card-body">
  				<form role="form" id="libro_editar" class="justify-content-center mx-3 my-1" align="center" enctype="multipart/form-data" action="../ajax/editar_libro.php" method="post">
  					<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
						<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_user['image_libr'] ?>">
						<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_user['image_libr'] ?>">
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="nombr_libr">Nombre: </label>
		            <input type="text" class="form-control" name="nombr_libr" autocomplete="off" id="nombr_libr" value="<?php echo $nombr_libr; ?>" maxlength="60" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
            <div class="form-row">
              <div class="col form-group">
                <label class="form-label" for="descr_libr">Descripción: </label>
                <input type="texttarea" class="form-control" name="descr_libr" autocomplete="off" id="descr_libr" value="<?php echo $descr_libr; ?>" maxlength="200" onkeyup="this.value = this.value.toUpperCase();">
              </div>
            </div>
		        <div class="form-row">
		          <div class="col form-group">
		            <label class="form-label" for="autor_libr">Autor: </label>
		            <input type="text" class="form-control" name="autor_libr" autocomplete="off" value="<?php echo $autor_libr; ?>" id="autor_libr" maxlength="100" onkeyup="this.value = this.value.toUpperCase();">
		          </div>
		        </div>
		        <div class="form-row">
              <div class="col form-group">
                <div class="photo">
                      <label class="form-label" for="fotou_usua"><b>Imagen: </b></label>  
                        <div class="prevPhoto">
                        <span class="delPhotoo <?php $classRemove; ?>">X</span>
                        <label for="foto"></label>
                        <?php echo $foto; ?>
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
		            <label class="form-label" for="ident_tipu"><b>Categoría del Libro: </b></label>
		            <?php
		            	include "../conexion.php";
									$query_rol = mysqli_query($conexion,"SELECT * FROM  tab_catego");
									$result_rol = mysqli_num_rows($query_rol);
								?>
								<select class="form-control notItemOne" name="ident_libr" id="ident_libr">
                  <option value="<?php echo $ident_cate;?>"><?php echo $nombr_cate;?></option>
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
		            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-book"></i> Actualizar Libro</button>
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

<script type="text/javascript">
  $( document ).ready( function () {
  $( "#libro_editar" ).validate( {
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

<?php require_once('includes/admin_footer.php');  ?>