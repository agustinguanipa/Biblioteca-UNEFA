<?php 
	
	require_once('includes/admin_header.php');
?>

<div class="card-deck">
	<div class="card text-center">
	  <div class="card-header">
	    <b>Configuración</b>
	  </div>
	 <div class="card-body">
    <h5>Información Personal</h5>
		  <hr class="my-4">
		  <div class="form-row">
		  	<div class="logoUser">
					<img src="<?php echo $login; ?>" alt="">
				</div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="nombr_usua">Nombre: </label>
		      <label><?= $_SESSION['nombr_usua']; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="apeli_usua">Apellido: </label>
		      <label><?= $_SESSION['apeli_usua']; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="email_usua">E-Mail: </label>
		      <label><?= $_SESSION['email_usua']; ?></label>
		    </div>
		  </div>
	  <h5>Datos Usuario</h5>
	  <hr class="my-4">
	  	<div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="usuar_usua">Usuario: </label>
		      <label><?= $_SESSION['usuar_usua']; ?></label>
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="col form-group">
		      <label class="form-label" for="ident_tipu"><b>Tipo de Usuario: </b></label>
		      <label><?= $_SESSION['nombr_tipu']; ?></label>
		    </div>
	  	</div>
		</div>
  </div>

	<div class="card text-center">
		<div class="card-header">
	    <b>Cambiar Contraseña</b>
	  </div>
	  <div class="container">
	    <div class="form-group text-center">
	      <div class="justify-content-center mx-3 my-1">
	        <form role="form" name="frmChangePass" id="frmChangePass" action="../ajax/actualizar_contrasena.php" class="justify-content-center" align="center" method="post">
	          <div class="form-row">
	            <div class="col form-group">
	              <label class="form-label" for="txtPassUser">Contraseña Actual: </label>
	              <input class="form-control" type="password" name="txtPassUser" id="txtPassUser" placeholder="*********" required>
	            </div>
	          </div>
	          <div class="form-row">
	            <div class="col form-group">
	              <label class="form-label" for="txtNewPassUser">Nueva Contraseña: </label>
	              <input class="form-control newPass" type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="*********" required>
	            </div>
	          </div>
	          <div class="form-row">
	            <div class="col form-group">
	              <label class="form-label" for="txtPassConfirm">Confirmar Contraseña: </label>
	              <input class="form-control newPass" type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="*********" required>
	            </div>
	          </div>
	          <div class="alertChangePass" style="display: none;"></div>
	          <div class="form-row">
	            <div class="col form-group">
	              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-key"></i> Cambiar Contraseña</button>
	              <button type="reset" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Limpiar</button>
	            </div>
	          </div>
	        </form>
	      </div> 
	    </div>
  	</div>
	</div>
</div>

<?php require_once('includes/admin_footer.php');  ?>

<script type="text/javascript">
	$( document ).ready( function () {
  $( "#frmChangePass" ).validate( {
    rules: {
    	txtPassUser: {
    		required: true,
    		minlength: 4
    	},
      txtNewPassUser: {
        required: true,
        minlength: 4
      },
      txtPassConfirm: {
        required: true,
        minlength: 4,
        equalTo: "#txtNewPassUser"
      }, 
    },

    messages: {
    	txtPassUser: {
    		required: "Ingrese su Contraseña Actual",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
    	},
      txtNewPassUser: {
        required: "Ingrese una Contraseña Nueva",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres"
      },
      txtPassConfirm: {
        required: "Ingrese una Contraseña",
        minlength: "Tu Contraseña debe contener al menos 5 caracteres",
        equalTo: "Ingrese la Misma Contraseña"
      },
      
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
