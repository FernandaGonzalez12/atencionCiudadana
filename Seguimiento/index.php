<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Seguimiento</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
     <link type="text/css" rel="stylesheet" href="../css/styles.css"/>
</head>
<body>
<?php include_once("../Resource/html/header.php"); ?>    

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Registrar Seguimiento</span>

                    <form id="formSeguimiento" method="post" action="guardarSeguimiento.php">
                        
                        <!-- ID Reporte -->
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="id_reporte" id="id_reporte" required>
                                    <option value="" disabled selected>Selecciona un reporte</option>
                                    <?php include_once("./LlenaSelectReportes.php"); ?>
                                </select>
                                <label for="id_reporte">Reporte</label>
                            </div>
                        </div>

                        <!-- Estatus Anterior -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="estatus_anterior" id="estatus_anterior" readonly required>
                                <label for="estatus_anterior">Estatus Anterior</label>
                            </div>
                        </div>

                        <!-- Estatus Nuevo -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="estatus_nuevo" id="estatus_nuevo" required>
                                <label for="estatus_nuevo">Estatus Nuevo</label>
                            </div>
                        </div>
                        

                        <!-- Fecha de Cambio -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="date" name="fecha_cambio" id="fecha_cambio" required>
                                <label for="fecha_cambio">Fecha de Cambio</label>
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="observaciones" id="observaciones" class="materialize-textarea" required></textarea>
                                <label for="observaciones">Observaciones</label>
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light blue lighten-2">Registrar Seguimiento</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>    
</div>

<?php include_once("../Resource/html/footer.php"); ?>

<!-- Scripts -->
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script> 

<script>
$(document).ready(function(){
    $('select').formSelect();
    $('input[type="date"]').datepicker({
        format: 'yyyy-mm-dd'
    });

    // Auto llenar estatus anterior al seleccionar un reporte
    $('#id_reporte').on('change', function() {
        const estatus = $(this).find('option:selected').data('estatus');
        $('#estatus_anterior').val(estatus);
        M.updateTextFields(); // Refresca el label de Materialize
    });

    // Validación
    $("#formSeguimiento").validate({
        rules: {
            id_reporte: { required: true },
            estatus_anterior: { required: true },
            estatus_nuevo: { required: true },
            fecha_cambio: { required: true, date: true },
            observaciones: { required: true, minlength: 5 }
        },
        messages: {
            id_reporte: "Selecciona un reporte.",
            estatus_anterior: "Estatus anterior requerido.",
            estatus_nuevo: "Escribe el nuevo estatus.",
            fecha_cambio: "Selecciona una fecha válida.",
            observaciones: {
                required: "Agrega observaciones.",
                minlength: "Debe tener al menos 5 caracteres."
            }
        },
        errorElement: 'div',
        errorClass: 'invalid',
        validClass: 'valid',
        errorPlacement: function(error, element) {
            if (element.is('select')) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            alert("Formulario válido. Se procederá a guardar el seguimiento.");
            form.submit();
        }
    });
});
</script>

</body>
</html>
