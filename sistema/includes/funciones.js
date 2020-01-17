function eliminar(e) {
	 e.preventDefault();
    alert('hola');
}



// $(document).ready(function(){

//     //ELIMINAR USUARIO
//     $('.del_usuario').click(function(e){
//         e.preventDefault();
//         var ident_usua = $(this).attr('product');
//         var action = 'infousuario';

//         $.ajax({
//             url:'../ajax/ajax.php',
//             type: 'POST',
//             async: true,
//             data: {action:action,ident_usua:ident_usua},

//         success:function(response){
//             if (response != 'error') 
//             {
//                 var info = JSON.parse(response);
//                 //$('#producto_id').val(info.codproducto);
//                 //$('.namePorducto').html(info.descripcion);

//                 $('.bodyModal').html('<form action="" method="POST" name="form_del_usuario" id="form_del_product" onsubmit="event.preventDefault(); delusuario();">'+
//                                         '<i class="fas fa-user-times fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px; font-size: 75pt;"></i> <br>'+
//                                         '<h2>¿Esta seguro de eliminar el siguiente registro?</h2><br>'+
//                                         '<h3 style="margin-bottom: 5px;" class="usuario">Usuario: <span>'+info.usuar_usua+'</span></h3>'+
//                                         '<h3 style="margin-bottom: 5px;" class="nombre">Nombre: <span>'+info.nombr_usua+'</span></h3>'+
//                                         '<h3 style="margin-bottom: 5px;" class="nombre">Apellido: <span>'+info.apeli_usua+'</span></h3>'+
//                                         '<h3 style="margin-bottom: 5px;" class="correo">Correo: <span>'+info.email_usua+'</span></h3>'+
//                                         '<input type="hidden" name="ident_usua" id="ident_usua" value="'+info.ident_usua+'" required>'+
//                                         '<input type="hidden" id="alert" name="action" value="delusuario" required>'+
//                                         '<div class="alert alertAddProduct"></div>'+
//                                         '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
//                                         '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+  
//                                     '</form>');


//             }
            
//         },
//         error:function(error){
//             console.log(error);
//         },
//         });
//         $('.modal').fadeIn();
//     });


// //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
//     $("#foto").on("change",function(){
//         var uploadFoto = document.getElementById("foto").value;
//         var foto       = document.getElementById("foto").files;
//         var nav = window.URL || window.webkitURL;
//         var contactAlert = document.getElementById('form_alert');
        
//             if(uploadFoto !='')
//             {
//                 var type = foto[0].type;

//                 var name = foto[0].name;
//                 if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
//                 {
//                     contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
//                     $("#img").remove();
//                     $(".delPhoto").addClass('notBlock');
//                     $('#foto').val('');
//                     return false;
//                 }else{  
//                         contactAlert.innerHTML='';
//                         $("#img").remove();
//                         $(".delPhoto").removeClass('notBlock');
//                         var objeto_url = nav.createObjectURL(this.files[0]);
//                         $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
//                         $(".upimg label").remove();
                        
//                     }
//               }else{
//                 alert("No selecciono foto");
//                 $("#img").remove();
//               }              
//     });

//     $('.delPhoto').click(function(){
//         $('#foto').val('');
//         $(".delPhoto").addClass('notBlock');
//         $("#img").remove();

//         if ($('#foto_actual') && $('#foto_remove')) 
//         {
//             $('#foto_remove').val('user.png');
//         }
//     });

//    //MENU DESLIZANTE
//     $('.btnmenu').click(function(e){
//         e.preventDefault();
//         if ($('nav').hasClass('viewMenu')) 
//         {
//             $('nav').removeClass('viewMenu');
//         }else{
//             $('nav').addClass('viewMenu');
//         }
//     });

//     $('nav ul li').click(function(){
//         $('nav ul li ul').slideUp();
//         $(this).children('ul').slideToggle();
//     });


// }); //FIN DEL READY 



// //ELIMINAR USUARIO
// function delusuario(){
    
//     $('.alertAddProduct').html('');
//     var ident_usua = $('#ident_usua').val();
//     var alert = $('#alert').val();
//     var action = 'eliminarusuario';

//     $.ajax({
//             url:'../ajax/ajax.php',
//             type: 'POST',
//             async: true,
//             data: {action:action,ident_usua:ident_usua,alert:alert},

//         success:function(response){
//            var info = JSON.parse(response);
//            console.log(info);

//             if (response == 'error') {
//                  $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el Usuario.</p>');
//             }else{

//                 $('.row'+info.ident_usua).slideUp();
//                 $('#form_del_product .btn_ok').slideUp();
//                 $('.alertAddProduct').html('<p style="color: green;">Usuario Eliminado correctamente.</p>');
//             }
                
            
           
//         },
//         error:function(error){
//              console.log(error);
//         },
//         });
// }

// //CERRAR EL MODAL
// function coloseModal(){
//     $('.alertAddProduct').html('');
//     $('#cantidad').val('');
//     $('#precio').val('');
//     $('.modal').fadeOut();
// }
