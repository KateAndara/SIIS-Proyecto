<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MCONTACTOCLIENTES);
  

    
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
    <title>Contacto de los clientes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/ContactoClienteMM.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 100%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista De Contactos De Clientes
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
                    <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="generarReporte('TablaContactoClientes','REPORTE DE CONTACTO DE LOS CLIENTES',60)">Generar PDF</button>
                </form>    
            </div>
            
            <script> 
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarContactoClientesMM();
                        } else {
                            BuscarContactoClienteMM(busqueda);
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
                    <table class="table table-hover" id="TablaContactoClientes">
                        <thead>
                            <tr>
                                <th>ID CONTACTO CLIENTE </th>
                                <th>TIPO DE CONTACTO</th>
                                <th>CLIENTE</th>
                                <th>CONTACTO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataContactoClientesMM">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Contacto Del  Cliente
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertContactoCliente">
                        <label for="Id_Cliente_Contacto" hidden>ID CONTACTO DEL CLIENTE</label>
                        <input type="number" id="Id_Cliente_Contacto" class="form-control" placeholder="Ingrese el código del contacto del cliente"hidden>
                        <label for="">SELECCIONE UN TIPO DE CONTACTO</label> 
                        <select id="Select_Contacto" class="form-control">
                            <option value="">Seleccione un tipo de contacto</option>
                        </select>
                        <label for="">SELECCIONE UN CLIENTE</label> 
                        <select id="Select_Cliente" class="form-control">
                            <option value="">Seleccione un cliente</option>
                        </select>
                        <label for="">CONTACTO</label>
                        <input type="number" id="Contacto" class="form-control" placeholder="Ingrese ingrese el número del contacto">
                        <hr>
                        <div id="btnagregarContactoCliente">
                            <input type="submit" id="btnagregar" onclick="AgregarContactoClienteMM()" value="Agregar Contacto Del Cliente" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/ContactoClienteMM.php";
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
