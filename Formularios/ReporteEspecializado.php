
<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MPREGUNTAS);
  

    
    //si no exite el permiso de consultar vuelve a la pagina de inicio
    if(empty($_SESSION['permisosMod']['r'])){
        header('Location: inicio.php');
    }
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de Reportes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="../CSS/styleF.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        #reportForm {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        #reportForm label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        #reportForm select,
        #reportForm input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        #reportForm button[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        #reportForm button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="col-12 text-center">
                    <h1 style="color: black;">
                    Generación de Reportes con Filtros de Fechas
                    </h1>
                </div>    
                <script>
        function validateForm() {
            // Validación del formulario (si es necesario)
            return true;
        }
        
        function setFormAction() {
            var categorySelect = document.getElementById('tableSelect').value;
            var form = document.getElementById('reportForm');
            
            if (categorySelect === 'ventas') {
                form.action = '../controller/reporte-ventas.php';
            } else if (categorySelect === 'compras') {
                form.action = '../controller/reporte-compras.php';
            } else if (categorySelect === 'produccion') {
                form.action = '../controller/reporte-produccion.php';
            } else if (categorySelect === 'inventario') {
                form.action = '../controller/reporte-inventario.php';
            }
        }
    </script>
</head>
<body>
          <form id="reportForm" method="post" onsubmit="return validateForm() "target="_blank">
        <div>
            <label for="tableSelect">Selecciona un módulo:</label>
            <select id="tableSelect" name="categorySelect">
                <option value="">Selecciona una categoría...</option>
                <option value="ventas">Ventas</option>
                <option value="compras">Compras</option>
                <option value="produccion">Producción</option>
                <option value="inventario">Inventario</option>
            </select>
        </div>
        
        <div>
        <label for="startDate">Fecha de inicio:</label>
        <input type="date" id="startDate" name="startDate" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-01-01'); ?>">
        </div>

        <div>
            <label for="endDate">Fecha de fin:</label>
            <input type="date" id="endDate" name="endDate" max="<?php echo date('Y-m-d'); ?>">
        </div>

        <div style="text-align: center;">
            <button type="submit" onclick="setFormAction()">Generar Reporte</button>
        </div>
    </form>

    <script>
    function validateForm() {
        var selectedTable = document.getElementById('tableSelect').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        if (selectedTable === "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, selecciona una tabla.'
            });
            return false;
        }

        if (startDate === "" || endDate === "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, completa las fechas de inicio y fin.'
            });
            return false;
        }

        // Obtener la fecha de hoy
        var today = new Date();

        // Obtener el año actual
        var currentYear = today.getFullYear();

        // Crear una fecha para el 1 de enero del año actual
        var firstDayOfYear = new Date(currentYear, 0, 1);

        // Convertir las fechas ingresadas en objetos Date
        var startDateObject = new Date(startDate);
        var endDateObject = new Date(endDate);

        // Validar que la fecha de inicio no sea posterior a la fecha de hoy
        if (startDateObject > today) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha de inicio no puede ser posterior a la fecha de hoy.'
            });
            return false;
        }

        // Validar que la fecha de inicio no sea anterior al 1 de enero del año actual
        if (startDateObject < firstDayOfYear) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha de inicio no puede ser anterior al 1 de enero del año actual.'
            });
            return false;
        }

        // Aquí podrías agregar más validaciones si es necesario

        return true; // Permite que el formulario se envíe si todas las validaciones son exitosas
    }
</script>


    
    <div id="reportContainer">
        <canvas id="reportChart"></canvas>
    </div>
      
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>

