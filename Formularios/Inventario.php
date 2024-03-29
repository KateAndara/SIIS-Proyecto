<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MINVENTARIO);
  

    
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
    <title>Inventario</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

    <script src="../JS/Inventario.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">

    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
     <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                        Inventario
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('TablaInventario','REPORTE DE INVENTARIO',60)">Generar PDF</button>
            </div>

            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="TablaInventario">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>NOMBRE PRODUCTO</th>
                                <th>EXISTENCIA</th>  
                                <th>PORCENTAJE</th>  
                                <th>OPCIONES</th>                          
                            </tr>
                        </thead>

                        <tbody id="DataInventario">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>       
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>