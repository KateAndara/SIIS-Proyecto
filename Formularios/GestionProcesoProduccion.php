<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MPROCESOPRODUCCION);
  

    
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
    <title>Procesos de producción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/GestionProcesoProduccion.js"></script>
    <script src="../JS/NuevoProcesoProduccion.js"></script>
    <script src="../JS/ProductoTerminadoMP.js"></script>
    <script src="../JS/ProductoTerminadoFinal.js"></script>

    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
    " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
    <div id="consulta" class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de los Procesos de Producción
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" autocomplete="off">
            <?php
                if ($_SESSION['permisosMod']['c']) {
                    # code...
                    ?>
                <button class="rounded" style="background-color: #147c4c; color: white; float: right; margin-left: 10px;" type="button" onclick="location.href='../Formularios/NuevoProcesoProduccion.php'">
                    Nuevo Proceso
                </button>
                <?php } ?>
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="generarReporte('TablaProcesosProduccion','REPORTE DE PROCESOS DE PRODUCCION',60)">Generar PDF</button>
            </form>
            </div>

            <script> //Carga la función "generarReporte" de formulario "form-busqueda"
                $(document).ready(function(){ 
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 
                    });
                });
            </script>
            
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="TablaProcesosProduccion">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>ESTADO DEL PROCESO</th>
                                <th>FECHA</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataProcesosProduccion">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="editarProceso" class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; display: none; border: 1px solid black;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pestaña1" style="color:black">Inicio de proceso</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña2" style="color:black">Materia prima</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña3" style="color:black">Producto terminado</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="pestaña1" class="tab-pane fade show active">
                <!-- Aquí va el formulario original -->
                <div id="pestaña1" class="tab-pane fade show active">
                    <div class="Formulario">
                        <div class="row">
                            <div class="Col-12" id="titulo">
                                <h3>
                                    Proceso de Producción
                                </h3>
                            </div>
                            <div class="col-12">
                                <form class="InsertProcesoProduccion">
                                    <input type="number" id="Id_Proceso_Produccion" class="form-control" hidden>
                                    <label for="">SELECCIONE EL ESTADO DEL PROCESO</label> 
                                    <select id="Select_Estados_Proceso" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                    </select>
                                    <label for="Fecha">FECHA</label>
                                    <input type="date" id="Fecha" class="form-control" />
                                    <hr>
                                    <div id="btnagregarProcesoProduccion">
                                        <input type="submit" id="btnagregar" onclick="AgregarProcesoProduccion(); document.querySelector('.nav-tabs li:nth-child(2) a').click(); return false;" value="Siguiente" class="btn btn-dark">
                                        <button class="btn btn-secondary" type="button" onclick="location.href='../Formularios/GestionProcesoProduccion.php'">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña2" class="tab-pane fade">
                <!-- Aquí va el contenido de la segunda pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Producto Terminado de Materia Prima
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertProductoTerminado">
                            <label for="">SELECCIONE UN PRODUCTO</label> 
                                <br>

                                <select id="Select_ProductoMP" name="Select_ProductoMP" style="width: 100%" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" class="form-control" placeholder="Ingrese la cantidad de producto a utilizar" autocomplete="off" onpaste="return false;">
                                <hr>
                                <div id="btnagregarProductoTerminadoMP" style="display:flex; justify-content:space-between; align-items:center;">
                                    <input type="submit" id="btnagregarMP"  value="Agregar" class="btn btn-success" style="margin-right:400px;">
                                    <input type="submit" id="btnanterior" onclick="document.querySelector('.nav-tabs li:nth-child(1) a').click(); return false;" value="Anterior" class="btn btn-dark" style="margin-right:5px;">
                                    <input type="submit" id="btnsiguiente" onclick="document.querySelector('.nav-tabs li:nth-child(3) a').click(); return false;" value="Siguiente" class="btn btn-dark" style="margin-right:20px;">
                                    <button type="button" id="btnfinalizarProceso" class="btn btn-info" onclick="mostrarMensaje()" style="margin-left:auto;">Finalizar proceso</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña3" class="tab-pane fade">
                <!-- Aquí va el contenido de la tercera pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Producto Terminado Final
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertProductoTerminadoFinal">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <br>

                                <select id="Select_ProductoFinal" name="Select_ProductoFinal"  style="width: 100%" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="CantidadF" class="form-control" placeholder="Ingrese la cantidad del producto" autocomplete="off" onpaste="return false;">
                                <label for="">SELECCIONE EL ESTADO DEL PROCESO</label> 
                                    <select id="Select_Estado_Proceso" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                    </select>
                                <hr>
                                <div id="btnagregarProductoFinal" style="display:flex; justify-content:space-between; align-items:center;">
                                    <input type="submit" id="btnagregarPF" value="Agregar" class="btn btn-success" style="margin-right:450px;">
                                    <input type="submit" id="btnanterior" onclick="document.querySelector('.nav-tabs li:nth-child(2) a').click(); return false;" value="Anterior" class="btn btn-dark" style="margin-right:5px;">
                                    <button type="button" id="btnfinalizarProceso" class="btn btn-info" onclick="mostrarMensaje()" style="margin-left:auto;">Finalizar proceso</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive mt-4" id="tableEditarProceso" style="display: none;">
        <div class="table-title">
        <h3 style="color: black;">Materia Prima</h3>
        </div>
        <table class="mi-tabla-productos-gestion-proceso-produccion">
            <thead class="thead-dark">
            <tr>
                <th style="width: 400px">Nombre</th>
                <th style="width: 100px">Cantidad</th>
                <th style="width: 100px">Quitar</th>
            </tr>
            </thead>
            <tbody id="DataProductosTerminadosMP"></tbody>
        </table>
        <div class="table-title">
        <h3 style="color: black;">Productos Terminados</h3>
        </div>
        <table class="mi-tabla-productos-gestion-proceso-produccion">
            <thead class="thead-dark">
            <tr>
                <th style="width: 400px">Nombre</th>
                <th style="width: 100px">Cantidad</th>
                <th style="width: 100px">Quitar</th>
            </tr>
            </thead>
            <tbody id="DataProductosTerminadosFinal"></tbody>
        </table>
    </div>

    <script>
        // Evitar que se pueda escribir en el campo de entrada
        document.getElementById('Fecha').addEventListener('keydown', function(event) {
            event.preventDefault();
        });

        // Obtener la fecha actual
        var now = new Date();

        // Restar 6 meses a la fecha actual
        var sixMonthsAgo = new Date();
        sixMonthsAgo.setMonth(now.getMonth() - 6);

        // Convertir la fecha a una cadena en formato "YYYY-MM-DD"
        var formattedSixMonthsAgo = sixMonthsAgo.toISOString().split('T')[0];

        // Establecer el valor mínimo del campo de fecha a 6 meses antes en la zona horaria local
        document.getElementById('Fecha').setAttribute('min', formattedSixMonthsAgo);

        // Obtener la fecha y hora actual en la zona horaria "America/Tegucigalpa"
        var timeZoneOffset = -360; // Offset en minutos para "America/Tegucigalpa"
        var timeZoneDifference = timeZoneOffset * 60 * 1000; // Convertir minutos a milisegundos
        var localDateTime = new Date(now.getTime() + timeZoneDifference);

        // Convertir la fecha y hora local a una cadena en formato "YYYY-MM-DD"
        var formattedDate = localDateTime.toISOString().split('T')[0];

        // Establecer el valor del campo de fecha al valor actual en la zona horaria local
        document.getElementById('Fecha').value = formattedDate;

        // Establecer la fecha máxima seleccionable en el campo de entrada de fecha
        document.getElementById('Fecha').setAttribute('max', formattedDate);
    </script>


    <script>
        function mostrarDiv() {
            // seleccionar el primer div por ID
            const divMostrar = document.querySelector('#editarProceso');

            // seleccionar el segundo div por ID
            const divOcultar = document.querySelector('#consulta');

            // cambiar el estilo del primer div para mostrarlo
            divMostrar.style.display = 'block';

            // cambiar el estilo del segundo div para ocultarlo
            divOcultar.style.display = 'none';

            var divProceso = document.getElementById("tableEditarProceso");
            divProceso.style.display = "block";

        }
    </script>
    <hr>
    <div id="mensaje"></div>
    <script>                  //Muestra el mensaje de que se guardó el proceso.
        function mostrarMensaje() {
        // Crear un elemento de mensaje con clases CSS de Bootstrap
        var mensaje = document.createElement("p");
        mensaje.innerText = "El proceso se guardó correctamente.";
        mensaje.classList.add("alert", "alert-success");

        // Agregar el elemento de mensaje al elemento de mensaje en la página
        document.getElementById("mensaje").appendChild(mensaje);

        // Recargar la página después de 2 segundos
        setTimeout(function() {
            location.reload();
        }, 1000);
        }
    </script> 

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>
