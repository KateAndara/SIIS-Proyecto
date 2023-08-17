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

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                        Promociones
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
                                <th>N° </th>
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
                    <h3 style="color: black;">
                        Agregar Promoción
                    </h3>
                </div>
                           <!-- inicio -->
                <div class="col-6">
    <form class="InsertPromocion">
   
    <label for="Nombre_Promocion">NOMBRE DE LA PROMOCION</label>
<input type="text" id="Nombre_Promocion" class="form-control" placeholder="Ingrese el nombre de la promoción" maxlength="30">
<p id="mensajeCaracteres" style="display: none;">Llegaste al límite de 30 caracteres.</p>
<script>
const inputNombrePromocion = document.getElementById("Nombre_Promocion");
const mensajeCaracteres = document.getElementById("mensajeCaracteres");

inputNombrePromocion.addEventListener("input", function() {
  // Remove special characters and keep only letters, numbers, and spaces
  const cleanedValue = inputNombrePromocion.value.replace(/[^a-zA-Z0-9 ]/g, "");
  
  if (cleanedValue.length === 30) {
    mensajeCaracteres.style.display = "block";
  } else {
    mensajeCaracteres.style.display = "none";
  }

  inputNombrePromocion.value = cleanedValue.toUpperCase();
});
</script>


<<label for="Precio_Venta">PRECIO DE VENTA</label>
<input type="text" id="Precio_Venta" class="form-control" placeholder="Ingrese el precio de venta de la promoción" oninput="validateInput()">
<p id="formatMessage"></p>

<script>
function validateInput() {
  var inputField = document.getElementById("Precio_Venta");
  var formatMessage = document.getElementById("formatMessage");
  
  // Eliminar todos los caracteres que no sean dígitos o el punto decimal
  var cleanInput = inputField.value.replace(/[^\d.]/g, "");
  
  // Verificar si el punto decimal aparece más de una vez
  if ((cleanInput.match(/\./g) || []).length > 1) {
    cleanInput = cleanInput.substring(0, cleanInput.lastIndexOf("."));
  }
  
  // Limitar la longitud del valor a 20 caracteres
  if (cleanInput.length > 20) {
    cleanInput = cleanInput.substring(0, 20);
  }
  
  // Actualizar el valor del campo con la entrada limpia
  inputField.value = cleanInput;
  
  if (cleanInput.length === 20) {
    formatMessage.textContent = "Máximo de 20 caracteres numéricos alcanzado.";
  } else {
    formatMessage.textContent = "";
  }
}
</script>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Fecha</title>
</head>
<body>
    <label for="Fecha_inicio">FECHA DE INICIO DE LA OFERTA</label>
    <input type="date" id="Fecha_inicio" class="form-control">

    <label for="Fecha_final">FECHA FINAL DE LA OFERTA</label>
    <input type="date" id="Fecha_final" class="form-control">

    <script>
        function setMinAndDefaultValue(inputId) {
            var input = document.getElementById(inputId);

            var fechaActual = new Date();
            var mes = fechaActual.getMonth() + 1;
            var dia = fechaActual.getDate();
            
            if (mes < 10) {
                mes = "0" + mes;
            }
            if (dia < 10) {
                dia = "0" + dia;
            }
            
            var fechaFormateada = fechaActual.getFullYear() + "-" + mes + "-" + dia;

            input.min = fechaFormateada;
            input.value = fechaFormateada;
        }

// Define una variable para rastrear si la alerta ya ha sido mostrada
var alertShown = false;

function validateDates() {
    var fechaInicio = new Date(document.getElementById("Fecha_inicio").value);
    var fechaFinal = new Date(document.getElementById("Fecha_final").value);

    if (fechaInicio > fechaFinal) {
        if (!alertShown) {
            // Crear la alerta
            var alertDiv = document.createElement("div");
            alertDiv.id = "customAlert";
            alertDiv.style.backgroundColor = "red";
            alertDiv.style.color = "white";
            alertDiv.style.padding = "10px";
            alertDiv.style.borderRadius = "5px";
            alertDiv.style.textAlign = "center";
            alertDiv.style.fontWeight = "bold";
            alertDiv.textContent = "La fecha de inicio debe ser menor que la fecha final. Ingresa la fecha final primero";

            document.body.insertBefore(alertDiv, document.body.firstChild);

            // Marcar la alerta como mostrada
            alertShown = true;
        }

        setMinAndDefaultValue("Fecha_inicio");
        setMinAndDefaultValue("Fecha_final");
    } else {
        // Si la fecha es válida, ocultar la alerta si estaba visible
        var existingAlert = document.getElementById("customAlert");
        if (existingAlert) {
            existingAlert.style.display = "none";
            alertShown = false;
        }
    }
}



        setMinAndDefaultValue("Fecha_inicio");
        setMinAndDefaultValue("Fecha_final");

        document.getElementById("Fecha_inicio").addEventListener("change", validateDates);
        document.getElementById("Fecha_final").addEventListener("change", validateDates);
    </script>
</body>
</html>


       
        <br>
        <div id="btnagregarPromocion">
            <input type="submit" id="btnagregar" onclick="AgregarPromocion()" value="Agregar Promoción" class="btn btn-success" disabled>
            <button type="button" id="btncancelar" class="btn btn-secondary">Cancelar</button>
        </div>
    </form>
    <script>
        const form = document.querySelector('.InsertPromocion');
        const nombrePromocionInput = document.getElementById('Nombre_Promocion');
        const precioVentaInput = document.getElementById('Precio_Venta');
        /* const fechaInicioInput = document.getElementById('Fecha_inicio');*/
        const fechaFinalInput = document.getElementById('Fecha_final');
        const addButton = document.getElementById('btnagregar');
        
        const checkFields = () => {
            const nombrePromocionValue = nombrePromocionInput.value.trim();
            const precioVentaValue = precioVentaInput.value.trim();
            /*const fechaInicioValue = fechaInicioInput.value;*/
            const fechaFinalValue = fechaFinalInput.value;
            
            addButton.disabled =
                nombrePromocionValue === '' ||
                precioVentaValue === '' ||
               /* fechaInicioValue === '' ||*/
                fechaFinalValue === '';
        };
        
        nombrePromocionInput.addEventListener('input', checkFields);
        precioVentaInput.addEventListener('input', checkFields);
        fechaInicioInput.addEventListener('input', checkFields);
        fechaFinalInput.addEventListener('input', checkFields);
        
        document.getElementById('btncancelar').onclick = function () {
            location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesVentas.php";
            
        };
    </script>
</div>
 <!-- Fin-->
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>
</html>
