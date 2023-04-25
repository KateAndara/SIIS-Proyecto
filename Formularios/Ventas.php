<?php 
/*    require_once("../config/conexion.php");
   require_once("../config/helpers.php") ;

   session_start(); */
   //obtener permisos del modulo ventas
   ob_start();
   include '../components/header.components.php';
    getPermisos(MVENTAS);
  

    
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
    <title>Ventas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    
    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de AutoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>
<script src="../Reportes/ReporteOH.js"></script>
    <!-- Sweetalert -->
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
    
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Proceso de Ventas
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" autocomplete="off">
                <?php
                    //si el permiso crear del modulo es igual a 1 muestra el boton
                    if ($_SESSION['permisosMod']['c']) {
                        # code...
                        ?>
                <button class="rounded" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" ><a style="text-decoration: none; background-color:  #147c4c; color: white; float: right; margin-left: 0px;" href="Nueva_Venta.php">Agregar</a></button>
                    <?php
                    }
                    ?>

                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('TableVentas','REPORTE DE VENTAS',60)">Generar PDF</button>

            </form>
            </div>
            
            
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="TableVentas">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>CLIENTE</th>
                                <!-- <th>USUARIO</th> -->
                                <th>ESTADO</th>
                              <!--   <th>SUBTOTAL</th> -->
                                <th>IMPUESTO</th>
                                <th>TOTAL</th>
                                <th>FECHA</th>
                                <th>RTN</th>
                                <th>No. FACTURA</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataVentas">
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<script src="../JS/Ventas.js"></script>
</body>
</html>