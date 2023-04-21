<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MPRODUCTOS);
  

    
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
    <title>Productos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Productos.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">

    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/ReporteOH.js"></script>
</head>

<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Productos
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
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('TablaProductos','REPORTE DE PRODUCTOS',60)">Generar PDF</button>
            </form>
            </div>

            <script>
                $(document).ready(function(){//Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarProductos();
                        } else {
                            BuscarProducto(busqueda);
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
                    <table class="table table-hover" id="TablaProductos">
                        <thead>
                            <tr>
                                <th>ID PRODUCTO</th>
                                <th>TIPO PRODUCTO</th>
                                <th>NOMBRE</th> 
                                <th>UNIDAD MEDIDA</th> 
                                <th>PRECIO</th> 
                                <th>CANTIDAD MAXIMA</th> 
                                <th>CANTIDAD MÍNIMA</th>                                 
                                <th>OPCIONES</th>                      
                            </tr>
                        </thead>

                        <tbody id="DataProductos">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Producto 
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertProducto">
                        <label for="Id_Producto" hidden>ID PRODUCTO</label>
                        <input type="number" id="Id_Producto" class="form-control" placeholder="Ingrese el código del producto "hidden>                            
                        <label for="">ID TIPO DE PRODUCTO</label>
                        <select id="Select_TipoProducto" class="form-control">
                            <option value="">Seleccione un tipo producto</option>
                        </select>                                                               
                        <label for="">NOMBRE</label>
                        <input type="text" id="Nombre" class="form-control" placeholder="Ingrese el nombre del producto" onkeyup="this.value=this.value.toUpperCase()">
                        <label for="">UNIDAD MEDIDA</label>
                        <input type="text" id="Unidad_medida" class="form-control" placeholder="Ingrese unidad medida del producto" onkeyup="this.value=this.value.toUpperCase()">
                        <label for="">PRECIO</label>
                        <input type="number" id="Precio" class="form-control" placeholder="Ingrese el precio del producto" step="0.01">
                        <label for="">CANTIDAD MAXIMA </label>
                        <input type="number" id="Cantidad_maxima" class="form-control" placeholder="Ingrese la cantidad maxima del producto">
                        <label for="">CANTIDAD MINIMA</label>
                        <input type="number" id="Cantidad_minima" class="form-control" placeholder="Ingrese la cantidad minima producto">
                        <hr>
                        <div id="btnagregarProducto">
                            <input type="submit" id="btnagregar" onclick="AgregarProducto()" value="Agregar Producto" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/Productos.php";
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