<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MCLIENTES);
  

    
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
    <title>Clientes</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Clientes.js"></script>
    <script src="../Reportes/Reporte.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
     <!-- Última versión de jspdf -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>
    
    <script src="../Reportes/ReporteClientes.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../CSS/styleF.css" rel="stylesheet">

</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: auto; margin-right: auto; border: 1px solid black;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                    Lista de Clientes
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
               <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="generarReporte('TablaClientes','REPORTE DE CLIENTES',60)">Generar PDF</button>
            </form>
            </div>

            <script>
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarClientes();
                        } else {
                            BuscarClientes(busqueda);
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
                    <table id="TablaClientes" class="table table-hover">
                        <thead>
                            <tr>
                                <th>N° </th>
                                <th>NOMBRE DEL CLIENTE</th>
                                <th>FECHA DE NACIMIENTO</th>
                                <th>DNI</th>
                                <th>OPCIONES</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="DataClientes">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3 style="color: black;">
                        Agregar Clientes 
                    </h3>
                </div>
                <div class="col-6">
                    <form class="InsertCliente">
                        <input type="number" id="Id_Cliente" name="Id_Cliente" class="form-control" placeholder="Ingrese el código del cliente"hidden>
                        <label for="">NOMBRE DEL CLIENTE</label>
                        <input type="text" id="Nombre" onkeyup=" javascript:this.value=this.value.toUpperCase();"  name="Nombre" class="form-control" placeholder="Inrese el nombre del cliente" oninput="validarEntrada(this)" autocomplete="off" onpaste="return false;">
                        <label for="">FECHA DE NACIMIENTO</label>
                        <input type="date" id="Fecha_nacimiento" class="form-control" />
                        <label for="">DNI</label>
                        <input type="text" id="DNI" name="DNI" class="form-control valid validNumberDni" autocomplete="off" onpaste="return false;" placeholder="0000-0000-00000" oninput="validarEntrada2(this)">
                        <hr>
                        <div id="btnagregarCliente">
                            <a  id="btnagregar" onclick="AgregarCliente()" value="Agregar Cliente" class="btn btn-success">Agregar Cliente</a>
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/Clientes.php";
                    };
                    </script>
                </div> 
            </div>
        </div>
    </div>
      
    <script>
    // Evitar que se pueda escribir en el campo de entrada
    document.getElementById('Fecha_nacimiento').addEventListener('keydown', function(event) {
        event.preventDefault();
    });

    // Obtener la fecha actual
    var now = new Date();

    // Restar 100 años a la fecha actual
    var oneHundredYearsAgo = new Date();
    oneHundredYearsAgo.setFullYear(now.getFullYear() - 100);

    // Convertir la fecha a una cadena en formato "YYYY-MM-DD"
    var formattedOneHundredYearsAgo = oneHundredYearsAgo.toISOString().split('T')[0];

    // Establecer el valor mínimo del campo de fecha a 100 años antes en la zona horaria local
    document.getElementById('Fecha_nacimiento').setAttribute('min', formattedOneHundredYearsAgo);

    // Obtener la fecha y hora actual en la zona horaria "America/Tegucigalpa"
    var timeZoneOffset = -360; // Offset en minutos para "America/Tegucigalpa"
    var timeZoneDifference = timeZoneOffset * 60 * 1000; // Convertir minutos a milisegundos
    var localDateTime = new Date(now.getTime() + timeZoneDifference);

    // Convertir la fecha y hora local a una cadena en formato "YYYY-MM-DD"
    var formattedDate = localDateTime.toISOString().split('T')[0];

    // Establecer la fecha máxima seleccionable en el campo de entrada de fecha
    document.getElementById('Fecha_nacimiento').setAttribute('max', formattedDate);
</script>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
  function validarEntrada(input) { 

  const patron = /^[A-Z a-z]+$/;
  const valor = input.value;
  if (!patron.test(valor)) {
    swal.fire('Error','Solo se permite ingresar letras', 'error');
    input.value = input.value.slice(0, -1);
  } else {
  
  }

}

function validarEntrada2(input) { 
 
const patron = /^[0-9 -]+$/;
const valor = input.value;
if (!patron.test(valor)) {
  swal.fire('Error','Solo se permite ingresar numeros y guines', 'error');
  input.value = input.value.slice(0, -1);
} else {

}

} 

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>
</html>
