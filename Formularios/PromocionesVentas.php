<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MPROMOCIONES);
  

    
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
    <title>Promociones</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/Promociones.js"></script>
    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
     <!-- Última versión de jspdf -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="../Reportes/Reporte.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Promociones en las Ventas
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" autocomplete="off">
            <?php
                if ($_SESSION['permisosMod']['c']) {
                    # code...
                    ?>
               <button class="rounded" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" onclick="mostrarFormulario()">Agregar</button>
               <?php } ?>
               <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="generarReporte('TablaPromociones','REPORTE DE PROMOCIONES',60)">Generar PDF</button>
            </form>
            
            </div>

            <script>
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarPromociones();
                        } else {
                            BuscarPromociones(busqueda);
                        }
                    });
                });
            </script>

            <script>
            function mostrarFormulario() {
            var formulario = document.querySelector('.Formulario'); //Muestra el formulario de agregar y actualizar.
            formulario.style.display = 'block';
            var consultaDiv = document.getElementById("consulta"); //Oculta el formulario de la tabla.
            consultaDiv.style.display = "none";
            }
            </script>
            
            <div class="box-body">
                <div class="table table-responsive">
                    <table id="TablaPromociones" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>NOMBRE</th>
                                <th>PRECIO DE VENTA</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FINAL</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataPromociones">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Promoción
                    </h3>
                </div>
                <div class="col-6">
                    <form class="InsertPromocion">
                       
                        <label for="Id_Promocion" hidden>ID PROMOCION</label>
                        <input type="number" id="Id_Promocion" class="form-control" placeholder="Ingrese el código de la promoción"hidden>
                        <label for="">NOMBRE DE LA PROMOCION</label>
                        <input type="text" id="Nombre_Promocion" class="form-control" placeholder="Oferta de Primavera...">
                        <label for="Select_Producto">SELECCIONE El PRODUCTO</label> 
                                <select id="Select_Producto" name="Select_Producto" class="form-control">
                                    <option value="">Seleccione una promocion</option>
                                </select>
                        <label for="">CANTIDAD A PROMOCIONAR</label>
                        <input type="number" id="Cantidad" name="Cantidad" class="form-control" placeholder="1,3,10, etc. ">       
                        <label for="">PRECIO DE VENTA</label>
                        <input type="number" id="Precio_Venta" class="form-control" placeholder="100.00,200.00,300.00, etc. ">
                        <label for="">FECHA DE INICIO DE LA OFERTA</label>
                        <input type="date" id="Fecha_inicio" class="form-control">
                        <label for="">FECHA FINAL DE LA OFERTA</label>
                        <input type="date" id="Fecha_final" class="form-control">
                        <hr>
                        <div id="btnagregarPromocion">
                            <input type="submit" id="btnagregar" onclick="AgregarPromocion()" value="Agregar Promocion" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesVentas.php";
                    };
                    </script>
                </div>
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
