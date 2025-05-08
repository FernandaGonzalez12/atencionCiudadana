$(init);
var table = null;
var controlador = "controlador.php";

function init(){
    table = $('#dtTable').DataTable({
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){
        $('#idcla').val('');
        $('#nomc').val('');
        $('#descc').val('');
        $('#ventanaModal').modal('open');
        $('#nomc').focus();
    });

    $('#btnGuardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var idc = $(this).attr("data-idc");
        var nomc = $(this).attr("data-nomc");
        var descc = $(this).attr("data-descc");
        $('#idcla').val(idc);
        $('#nomc').val(nomc);
        $("#descc").val(descc);
        M.updateTextFields();
        $('#ventanaModal').modal('open');
        $('#nomc').focus();
    });

    $(document).on("click", '.delete', function()
    {
        var idc = $(this).attr("data-idc");
        var parametros = "idcla=" + idc + "&accion=Eli";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idc>0){
                        table.row('#' + data.idcla).remove().draw();
                    }
                    M.toast({html: 'Categoria Eliminada', classes: 'rounded red lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){
    $('#formulario').validate({
        rules:{
            nomc:{required:true, minlength:4, maxlength:60},
            descc:{required:true, minlength:4, maxlength:100},
        },
        messages: {
            nomc:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            descc:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            guardarRegistro();
        }
    });
}

function guardarRegistro(){
    var idc = $("#idcla").val();  
    var parametros = $("#formulario").serialize();
    if (idc > 0){
        parametros = parametros + "&accion=Act";
    }
    else{
        parametros = parametros + "&accion=Ins";
    }
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#idcla').val('');
                $('#nomc').val('');
                $('#descc').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idc > 0){ 
                    table.row('#' + data.idcla).remove().draw();
                }
                var row = table.row.add([
                    data.nomc,
                    data.descc,
                    '<i class="material-icons edit" data-idc="' + data.idcla + '" data-nomc="' + data.nomc +'" data-descc="' + data.descc +'">create</i><i class="material-icons delete" data-idc="' + data.idcla + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idcla);

                M.toast({html: 'Categoria Guardada', classes: 'rounded green lighten-2'});
            }
        } 
    });
}
