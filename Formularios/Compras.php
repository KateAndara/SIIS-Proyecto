<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Compra.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">


</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: auto; margin-right: auto">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Compras
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" autocomplete="off">
                <button class="rounded" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" > <a style="text-decoration: none; background-color:  #147c4c; color: white; float: right; margin-left: 0px;" href="NuevaCompra.php">Agregar</a></button>
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"  target="_blank" onclick="window.open('../Reportes/Compras.php');" >Generar PDF</button>            </form>
            </div>
            <script>
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarRoles();
                        } else {
                            BuscarRol(busqueda);
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
                    <table class="table table-hover" id="TablaCompras">
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID COMPRA</th>
                                <th style="width: 90px;">PROVEEDOR</th>
                                <th style="width: 80px;">FECHA</th>
                                <th style="width: 80px;">TOTAL</th>
                                <th style="width: 100px;">OPCIONES</th>

                            </tr>
                        </thead>

                        <tbody id="DataCompras">
                            
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
</body>
</html>