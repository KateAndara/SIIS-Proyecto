<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descuentos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/Descuentos.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                    Lista de Descuentos para las Ventas
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" autocomplete="off">
                <input type="text" class="rounded" style="border: 2px solid black;" placeholder=" Buscar..." id="input-busqueda">
                <button style="background-color: black; color: white;" class="rounded" id="btn-busqueda" type="submit">Buscar</button>
            </form>
            <button class="rounded" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" onclick="mostrarFormulario()">Agregar</button>
            <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="PDFDescuento('+MisItems[i].Id_Descuento +')">Generar PDF</button>
            </div>

            <script>
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarDescuentos();
                        } else {
                            BuscarDescuentos(busqueda);
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>NOMBRE DEL DESCUENTO</th>
                                <th>PORCENTAJE</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataDescuentos">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Descuentos
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertDescuento">
                        <label for="Id_Promocion" hidden>ID PROMOCION</label>
                        <input type="number" id="Id_Descuento" class="form-control" placeholder="Ingrese el código del descuento"hidden>
                        <label for="">NOMBRE DEL DESCUENTO</label>
                        <input type="text" id="Nombre_descuento" class="form-control" placeholder="Oferta de Primavera...">
                        <label for="">PORCENTAJE A DESCONTAR</label>
                        <input type="number" id="Porcentaje_a_descontar" class="form-control" placeholder="1,2,3,4,5... etc. ">
                        <hr>
                        <div id="btnagregarDescuento">
                            <input type="submit" id="btnagregar" onclick="AgregarDescuento()" value="Agregar Descuento" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/DescuentosVentas.php";
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
