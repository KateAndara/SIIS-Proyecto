<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Terminado (materia prima)</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/ProductoTerminadoMP.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Productos Terminados de Materia Prima
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <input type="text" class="rounded" style="border: 2px solid black;" placeholder="Id Producto Terminado" id="input-busqueda">
            <button style="background-color: black; color: white;" class="rounded" id="btn-busqueda">Buscar</button>
            <button class="rounded" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" onclick="BuscarProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Agregar</button>
            <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="PDFProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Generar PDF</button>
            </div>
            <script>
            $(document).ready(function(){
                $('#btn-busqueda').click(function(){
                    var busqueda = $('#input-busqueda').val();
                    BuscarProductoTerminadoMP(busqueda);
                });
            });
            </script>
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID PRODUCTO TERMINADO</th>
                                <th>PRODUCTO</th>
                                <th>ID PROCESO DE PRODUCCI??N</th>
                                <th>CANTIDAD</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataProductosTerminadosMP">
                            
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
