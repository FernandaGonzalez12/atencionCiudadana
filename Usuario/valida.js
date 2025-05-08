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
        $('#idusr').val('');
        $('#corr').val('');
        $('#nom').val('');
        $('#contra').val('');
        $('#idrol').val(1);
        $('#idrol').formSelect();
        $('#ventanaModal').modal('open');
        $('#corr').focus();
    });

    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var idusr = $(this).attr("data-idusr");
        var corr = $(this).attr("data-corr");
        var nom = $(this).attr("data-nom");
        var contra = $(this).attr("data-contra");
        var idrol = $(this).attr("data-idrol");

        $('#idusr').val(idusr);
        $('#corr').val(corr);
        $('#nom').val(nom);
        $('#contra').val(contra);
        $('#idrol').val(idrol);
        $('#idrol').formSelect(); // Recorre el select al dato en val especificado 
        M.updateTextFields();
        $('#ventanaModal').modal('open');
        $('#corr').focus();
    });

    $(document).on("click", '.delete', function(){
        var idusr = $(this).attr("data-idusr");
        var parametros = "idusr=" + idusr + "&accion=Eli";;
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    table.row('#' + data.idusr).remove().draw();
                    M.toast({html: 'Usuario Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){
    $('#formulario').validate({
        rules:{
            corr:{required:true, email:true, minlength:4, maxlength:100},
            nom:{required:true, minlength:4, maxlength:100},
            contra:{required:true, minlength:4, maxlength:100},
            idrol:{required:true}
        },
        messages: {
            corr:{required:"No puedes dejar este campo vacío",email:"Correo Invalido",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
            nom:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
            contra:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 32 caracteres"},
            idrol:{required:"No puedes dejar este campo vacío"},
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
    var nomrol = $("#idrol option:selected").text();
    var sURL = "";
    var parametros = $("#formulario").serialize();
    var idusr = $("#idusr").val();
    if(idusr > 0){
        parametros = parametros + "&accion=Act";
    }else{
        parametros = parametros + "&accion=Ins";
    }
    $.ajax({
        type: "POST",
        url: controlador,
        dataType:'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#idusr').val('');
                $('#corr').val('');
                $('#nom').val('');
                $('#contra').val('');
                $('#idrol').val(1);
                $('#idrol').formSelect();
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idusr >0){
                    table.row('#' + data.idusr).remove().draw();
                }
                var contra = data.contra.substring(0, 8);
                var row = table.row.add([
                    data.corr,
                    data.nom,
                    contra,
                    nomrol,
                    '<i class="material-icons edit" data-idusr="' + data.idusr + '" data-corr="' + data.corr +'" data-nom="' + data.nom +'" data-contra="' + data.contra +'" data-idrol="' + data.idrol +'" >create</i><i class="material-icons delete" data-idusr="' + data.idusr + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idusr);

                M.toast({html: 'Usuario Guardado', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}
