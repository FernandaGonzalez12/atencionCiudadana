$(init);
var table = null;
var controlador = "menu.php";

function init(){
    table = $('#dtTable').DataTable({
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){
        $('#idopc').val('');
        $('#idm').val('');
        $('#nomm').val('');
        $('#ventanaModal').modal('open');
        $('#idm').focus();
    });

    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var idopc = $(this).attr("data-idopc");
        var idm = $(this).attr("data-idmenu");
        var nomm = $(this).attr("data-nommenu");
        $('#idopc').val(idopc);
        $('#idm').val(idm);
        $("#nomm").val(nomm);
        M.updateTextFields();
        $('#ventanaModal').modal('open');
        $('#idm').focus();
    });

    $(document).on("click", '.delete', function(){
        var idopc = $(this).attr("data-idopc");
        var parametros = "idopc=" + idopc + "&accion=Eliminar";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idopc>0){
                        table.row('#' + data.idopc).remove().draw();
                    }

                    M.toast({html: 'Menu Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){
    $('#formulario').validate({
        rules:{
            idm:{required:true, minlength:4, maxlength:40},
            nomm:{required:true, minlength:4, maxlength:100},
        },
        messages: {
            idm:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 40 caracteres"},
            nomc:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            saveData();
        }
    });
}

function saveData(){
    var idopc = $("#idopc").val();  
    var parametros = $("#formulario").serialize();
    if (idopc > 0){
        parametros = parametros + "&accion=Actualizar";
    }
    else{
        parametros = parametros + "&accion=Insertar";
    }
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#idopc').val('');
                $('#idm').val('');
                $('#nomm').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idopc >0){
                    table.row('#' + data.idopc).remove().draw();
                }
                var row = table.row.add([
                    data.idm,
                    data.nomm,
                    '<i class="material-icons edit" data-idopc="' + data.idopc + '" data-idmenu="' + data.idm +'" data-nommenu="' + data.nomm +'">create</i><i class="material-icons delete" data-idopc="' + data.idopc + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idopc);

                M.toast({html: 'Menu Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
