$(init);

function init(){
    $('#modal1').modal();
    validateForm(); // Inicializa la validación

    $('#entrar').on("click",function(){
        $('#frm').submit(); // Disparamos la validación del formulario frm
    });

}

function validateForm(){
    $('#frm').validate({
        rules:{
            usr:{required:true, minlength:6, maxlength:120, email:true},
            contra:{required:true, minlength:4, maxlength:32}
        },
        messages:{
            usr:{required:'Campo Requerido', minlength:'6 caracteres minimo',
                  maxlength:'120 carcateres maximo',email:'Correo Invalido'},
            contra:{required:'Campo Requerido', minlength:'4 carcateres minimo',
                     maxlength:'32 caracteres maximo'},
        },
        errorElement:"div",
        errorClass:"invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)
        },
        submitHandler: function(form){
            validarEntrada();
        }
    
    });
}

function validarEntrada(){
  var parametros = $("#frm").serialize();
  $.ajax({
      type: "post",
      url: "validaUsr.php",
      dataType: 'json',
      data: parametros,
      success: function(respuesta){
          if (respuesta['status']==1){
                document.location.href="../Home/";
          }
          else{
             M.toast({html: 'Acceso No Permitido', classes: 'rounded blue lighten-2'});
          }
      } 
  });
}

