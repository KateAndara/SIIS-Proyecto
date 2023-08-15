<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MPROCESOPRODUCCION);
  

    
    //si no exite el permiso de consultar vuelve a la pagina de inicio
    if(empty($_SESSION['permisosMod']['c'])){
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
    <title>Proceso de producción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/NuevoProcesoProduccion.js"></script>
    <script src="../JS/ProductoTerminadoMP.js"></script>
    <script src="../JS/ProductoTerminadoFinal.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
    " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
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
                                    <label for="">SELECCIONE EL ESTADO DEL PROCESO</label> 
                                    <select id="Select_Estados_Proceso" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                    </select>
                                    <label for="Fecha">FECHA</label>
                                    <input type="date" id="Fecha" class="form-control" />
                                    <hr>
                                    <div id="btnagregarProcesoProduccion">
                                        <input type="submit" id="btnagregar" onclick="AgregarProcesoProduccion(); mostrarDiv(); document.querySelector('.nav-tabs li:nth-child(2) a').click(); return false;" value="Siguiente" class="btn btn-dark">
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
                                <div id="btnagregarProductoTerminado" style="display:flex; justify-content:space-between; align-items:center;">
                                    <input type="submit" id="btnagregarMP" onclick="AgregarProductoTerminadoMP(event)" value="Agregar" class="btn btn-success" style="margin-right:300px;">
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

                                <select id="Select_ProductoFinal" name="Select_ProductoFinal" style="width: 100%" class="form-control js-example-basic-single">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="CantidadF" class="form-control" placeholder="Ingrese la cantidad del producto" autocomplete="off" onpaste="return false;">
                                <hr>
                                <div id="btnagregarProductoTerminadoFinal" style="display:flex; justify-content:space-between; align-items:center;">
                                    <input type="submit" id="btnagregarPF" onclick="AgregarProductoTerminadoFinal(event)" value="Agregar" class="btn btn-success" style="margin-right:350px;">
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
    <hr>
    <div class="card-body table-responsive mt-4" id="tableProceso" style="display: none;">
        <div class="table-title">
        <h3 style="color: black;">Materia Prima</h3>
        </div>
        <table class="table table-hover text-nowrap">
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
        <table class="table table-hover text-nowrap">
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

    <div id="mensaje"></div>
    <script>                  //Muestra el mensaje de que se guardó el proceso.
        function mostrarMensaje() {
        // Crear un elemento de mensaje con clases CSS de Bootstrap
        var mensaje = document.createElement("p");
        mensaje.innerText = "El proceso se guardó correctamente.";
        mensaje.classList.add("alert", "alert-success");

        // Agregar el elemento de mensaje al elemento de mensaje en la página
        document.getElementById("mensaje").appendChild(mensaje);

         // Redirigir a la página de gestión después de 2 segundos
         setTimeout(function() {
            location.href = "../Formularios/GestionProcesoProduccion.php";
        }, 1000);
        }
    </script> 

    <script>
        // Evitar que se pueda escribir en el campo de entrada
        document.getElementById('Fecha').addEventListener('keydown', function(event) {
            event.preventDefault();
        });

        // Obtiene la fecha y hora actual en la zona horaria "America/Tegucigalpa"
        var now = new Date();
        var timeZoneOffset = -360; // Offset en minutos para "America/Tegucigalpa"
        var timeZoneDifference = timeZoneOffset * 60 * 1000; // Convertir minutos a milisegundos
        var localDateTime = new Date(now.getTime() + timeZoneDifference);
        
        // Convierte la fecha y hora local a una cadena en formato "YYYY-MM-DD"
        var formattedDate = localDateTime.toISOString().split('T')[0];

        // Establece el valor del campo de fecha al valor actual en la zona horaria local
        document.getElementById('Fecha').value = formattedDate;

        // Establece la fecha máxima seleccionable en el campo de entrada de fecha
        document.getElementById('Fecha').setAttribute('max', formattedDate);
    </script>


    <script>
        function mostrarDiv() {
        var divProceso = document.getElementById("tableProceso");
        divProceso.style.display = "block";
        }
    </script>
    
    <script>
    // Desactivar la posibilidad de hacer clic en las pestañas 2 y 3
    var pestaña2 = document.querySelector('.nav-tabs li:nth-child(2) a');
    var pestaña3 = document.querySelector('.nav-tabs li:nth-child(3) a');
    pestaña2.classList.add('disabled');
    pestaña3.classList.add('disabled');

    // Activar la pestaña 2 desde el botón "btnagregar"
    var btnAgregar = document.querySelector('#btnagregar');
    btnAgregar.addEventListener('click', function() {
    pestaña2.classList.remove('disabled');
    pestaña2.click();
    });

    // Activar la pestaña 3 desde el botón "btnsiguiente"
    var btnSiguiente = document.querySelector('#btnsiguiente');
    btnSiguiente.addEventListener('click', function() {
    pestaña3.classList.remove('disabled');
    pestaña3.click();
    });
    </script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>
