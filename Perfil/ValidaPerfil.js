$(init);
var controlador = "perfil.php";
function init(){
    $("#asignadas").load("tablaAsignadas.php?idr=1"); 
    $("#disponibles").load("tablaDisponibles.php?idr=1"); 
    $("#idrol").change(function(){
        $("#asignadas").load("tablaAsignadas.php?idr=" + $("#idrol").val()); 
        $("#disponibles").load("tablaDisponibles.php?idr=" + $("#idrol").val()); 
    });

    $(document).on("click", '.inserta', function(){
        var idopc = $(this).attr("data-idopc"); 
        var idrol = $("#idrol").val();
        var parametros = "ido=" + idopc +"&idr=" + idrol + "&accion=Insertar";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    $("#asignadas").load("tablaAsignadas.php?idr=" + $("#idrol").val()); 
                    $("#disponibles").load("tablaDisponibles.php?idr=" + $("#idrol").val()); 
                    M.toast({html: 'Opción Agregada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
    $(document).on("click", '.eliminar', function(){
        var idopc = $(this).attr("data-idopc"); 
        var idrol = $("#idrol").val();
        var parametros = "ido=" + idopc +"&idr=" + idrol + "&accion=Eliminar";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    $("#asignadas").load("tablaAsignadas.php?idr=" + $("#idrol").val()); 
                    $("#disponibles").load("tablaDisponibles.php?idr=" + $("#idrol").val()); 
                    M.toast({html: 'Opción Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
} // Fin de init()
