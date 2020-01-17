$(document).ready(function(){


//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
        var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;

                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
                alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();

        if ($('#foto_actual') && $('#foto_remove')) 
        {
            $('#foto_remove').val('user.png');
        }
    });

    $('.delPhotoo').click(function(){
        $('#foto').val('');
        $(".delPhotoo").addClass('notBlock');
        $("#img").remove();

        if ($('#foto_actual') && $('#foto_remove')) 
        {
            $('#foto_remove').val('libros.jpg');
        }
    });

   //MENU DESLIZANTE
    $('.btnmenu').click(function(e){
        e.preventDefault();
        if ($('nav').hasClass('viewMenu')) 
        {
            $('nav').removeClass('viewMenu');
        }else{
            $('nav').addClass('viewMenu');
        }
    });

    $('nav ul li').click(function(){
        $('nav ul li ul').slideUp();
        $(this).children('ul').slideToggle();
    });


}); //FIN DEL READY 



//ELIMINAR USUARIO
function delusuario(){
    
    $('.alertAddProduct').html('');
    var ident_usua = $('#ident_usua').val();
    var alert = $('#alert').val();
    var action = 'eliminarusuario';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,ident_usua:ident_usua,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el Usuario.</p>');
            }else{

                $('.row'+info.ident_usua).slideUp();
                $('#form_del_product .btn_ok').slideUp();
                $('.alertAddProduct').html('<p style="color: green;">Usuario Eliminado correctamente.</p>');
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}



//ELIMINAR USUARIO
function delusuario(){
    
    $('.alertAddProduct').html('');
    var idusuario = $('#id').val();
    var alert = $('#alert').val();
    var action = 'eliminarusuario';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,id:id,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}