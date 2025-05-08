$(init);
var table = null;
var controlador = "rol.php";

function init(){
  table = $('#dtTable').DataTable({
      "alengtMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
      "iDisplayLength" : 15
  });
  //Inicializa la ventana modal
  $('#ventanaModal').modal();
  validaForm();
  //Si precionamos más
  $('#add').on("click", function(){
    //Abre la ventana modal
    $('#ventanaModal').modal('open');
    //manda el foco a la línea para escribir el nombre
    $('#nomr').focus();
  });
  
  //Guardamos
  $('#guardar').on("click", function(){
    $('#formulario').submit();
  });

//Editar

  $(document).on("click", '.edit', function(){
    var id = $(this).attr("data-id");
    var nom = $(this).attr("data-nom");
    $('#idr').val(id);
    $('#nomr').val(nom);
    $('#ventanaModal').modal('open');
    $('#nomr').focus();
    });



//Eliminar
  $(document).on("click", '.delete', function(){
    var idr = $(this).attr("data-id");
    var parametros = "idr= " + idr + "&accion=Eliminar";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                var data = respuesta['data'];
                if (idr>0){
                    table.row('#' + idr).remove().draw();
                }
                M.toast({html: 'Rol Eliminado', classes: 'rounded blue lighten-2'});
            }
        } 
      });
    });
}

//Validación del formulario
function validaForm(){
    $('#formulario').validate({
        rules:{
            nomr:{ required:true, minlength:4, maxlength:100 },
          
        },
        messages:{
            nomr:{required:'Campo Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 100 caracteres'},
          
        },
        errorElement:"div",
        errorClass:"invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)
        },
        submitHandler: function(form){
            guardarRegistro();
        }
    });
}

function guardarRegistro(){
  var idr = $("#idr").val();
  var parametros = $("#formulario").serialize();
  if(idr > 0){
    parametros = parametros + "&accion=Actualizar";
  }else{
    parametros = parametros + "&accion=Insertar";
  }

$.ajax({
  type: "POST",
  url: controlador,
  dataType:'json',
  data: parametros,
  success: function (respuesta){
    if(respuesta['status']==1){
      $('#idr').val('');
      $('#nomr').val('');
      $('#ventanaModal').modal('close');
      var  data = respuesta ['data'];
      if (idr > 0){
        table.row('#' + data.idr).remove().draw();
      }

      var row = table.row.add([
        data.nomr,
        '<i class="material-icons edit" data-id ="' + data.idr + '" data-nom= "' + data.nomr + '" >create</i>  <i class="material-icons delete" data-id ="' + data.idr + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.idr);
        M.toast({html: 'Rol Guardado', classes: 'rounded blue lighten-2'});
    }
  } 
  });
}
