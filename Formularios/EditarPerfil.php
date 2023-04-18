<?php 
include '../components/header.components.php';
date_default_timezone_set('America/Tegucigalpa');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Usuario.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
</head>
<body>
<div class="col-md-12 cards-white" style="margin: 0 auto; width: 90%; max-width: none; margin-left: auto; margin-right: auto">
    <div class="consulta mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>
                    Mi Perfil
                </h3>
            </div>
        </div>
        <div class="col-10">

        <label for="id_usuario">ID de usuario:</label>
        <input type="text" name="id_usuario" id="id_usuario" class="form-control" >

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" class="form-control">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control">

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" class="form-control">

        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" class="form-control">

        <label for="correo_electronico">Correo electrónico:</label>
        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control">

        <label for="rol">Rol:</label><input type="text" name="rol" id="rol" class="form-control">

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" class="form-control">

        <label for="preguntas_contestadas">Preguntas contestadas:</label>
        <input type="number" name="preguntas_contestadas" id="preguntas_contestadas" class="form-control" value="0">
    </div>
</div>
<hr>
<div id="btnEditarPerfil">
    <a type="submit" id="btnEditar"  value="" class="btn btn-info"> Editar Perfil</a>
     <button type="button" id="btncancelar" onclick="regresarmiperfil()" class="btn btn-secondary">Cancelar</button>
</div>
<script>
	function regresarmiperfil() {
	    window.location.href = "MiPerfil.php";
	}
</script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>