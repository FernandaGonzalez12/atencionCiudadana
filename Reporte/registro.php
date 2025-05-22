<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Reporte</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
</head>
<body>
<?php include_once("../Resource/html/header.php"); ?>    

<!-- Contenedor principal -->
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Registrar Reporte</span>

                    <!-- Formulario para registrar un reporte -->
                    <form id="formReporte" method="post" enctype="multipart/form-data" action="guardarReporte.php">
                        
                        <!-- Usuario -->
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="idusr" id="idusr" required>
                                    <option value="" disabled selected>Selecciona un usuario</option>
                                    <?php 
                                        include_once("./LlenaSelectUsuario.php");
                                    ?>
                                </select>
                                <label for="idusr">Usuario</label>
                            </div>
                        </div>

                        <!-- Categoría -->
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="idc" id="idc" required>
                                    <option value="" disabled selected>Selecciona una categoría</option>
                                    <?php 
                                        include_once("./LlenaSelectCategoria.php");
                                    ?>
                                </select>
                                <label for="idc">Categoría</label>
                            </div>
                        </div>

                        <!-- Título -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="titulo" id="titulo" class="validate" required>
                                <label for="titulo">Título del Reporte:</label>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="descripcion" id="descripcion" class="materialize-textarea" required></textarea>
                                <label for="descripcion">Descripción del Reporte:</label>
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="ubicacion" id="ubicacion" class="validate" required>
                                <label for="ubicacion">Ubicación:</label>
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>Subir Imagen</span>
                                    <input type="file" name="imagen" id="imagen">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Selecciona una imagen">
                                </div>
                            </div>
                        </div>

                        <!-- Fecha del reporte -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="date" name="fechar" id="fechar" class="validate" required>
                                <label for="fechar">Fecha del Reporte:</label>
                            </div>
                        </div>

                        <!-- Fecha de actualización -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="date" name="fechac" id="fechac" class="validate" required>
                                <label for="fechac">Fecha de Actualización:</label>
                            </div>
                        </div>

                        <!-- Botón de registro -->
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light blue lighten-2">Registrar Reporte</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>    
</div>

<?php include_once("../Resource/html/footer.php"); ?>

<!-- Scripts de jQuery, Materialize y otros -->
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script> 
<script type="text/javascript" src="./Valida.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('select').formSelect();
        $('.modal').modal();
        $('input[type="date"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
    // Valida.js

$(document).ready(function () {
    $("#formReporte").validate({
        rules: {
            idusr: {
                required: true
            },
            idc: {
                required: true
            },
            titulo: {
                required: true,
                minlength: 5
            },
            descripcion: {
                required: true,
                minlength: 10
            },
            ubicacion: {
                required: true
            },
            fechar: {
                required: true,
                date: true
            },
            fechac: {
                required: true,
                date: true
            }
        },
        messages: {
            idusr: "Selecciona un usuario.",
            idc: "Selecciona una categoría.",
            titulo: {
                required: "Escribe un título.",
                minlength: "El título debe tener al menos 5 caracteres."
            },
            descripcion: {
                required: "Escribe una descripción.",
                minlength: "La descripción debe tener al menos 10 caracteres."
            },
            ubicacion: "Ingresa una ubicación.",
            fechar: "Selecciona la fecha del reporte.",
            fechac: "Selecciona la fecha de actualización."
        },
        errorElement: 'div',
        errorClass: 'invalid',
        validClass: 'valid',
        errorPlacement: function (error, element) {
            if (element.is('select')) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            // Puedes hacer un submit normal o por AJAX
            alert("Formulario válido. Se procederá a guardar el reporte.");
            form.submit(); // o usa AJAX si deseas procesarlo sin recargar
        }
    });
});

</script>

</body>
</html>
