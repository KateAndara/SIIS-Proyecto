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
    <title>Promociones Productos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/PromocionesProductos.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="../CSS/styleF.css" rel="stylesheet">
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: auto; margin-right: auto; border: 1px solid black;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                        Lista de Promociones en Productos
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
                <?php } ?>                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('TablaPromocionesProductos','REPORTE DE PROMOCIONES EN LOS PRODUCTOS',60)">Generar PDF</button>            
            </form>
            </div>
            <script> //Carga la función "generarReporte" de formulario "form-busqueda"
                $(document).ready(function(){ 
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 
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
                    <table class="table table-hover" id="TablaPromocionesProductos">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>PRODUCTO</th>
                                <th>PROMOCIÓN</th>
                                <th>CANTIDAD</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataPromocionesProductos">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3 style="color: black;">
                        Agregar Promoción a Productos
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertPromocionProducto" >
                       
                        <input type="number" id="Id_Promocion_Producto" class="form-control" placeholder="Ingrese el código de la promoción"hidden>
                        <label id="producto" for="">SELECCIONE UN PRODUCTO</label> 
                                <br>

                                <select id="Select_ProductoFinal" name="Select_ProductoFinal" style="width: 100%" class="select2">
                                    <!-- <option value="">Seleccione un producto</option> -->
                                    
                                </select>
                        <label id="promocion" for="">SELECCIONE UNA PROMOCIÓN</label> 
                                <br>

                                <select id="Select_Promocion" name="Select_Promocion" style="width: 100%" class="select2">
                                    <!-- <option value="">Seleccione una promoción</option> -->
                                    
                                </select>
                       
                       <label for="Cantidad">CANTIDAD</label>
<input type="number" id="Cantidad" class="form-control" placeholder="Ingrese la cantidad de productos que tendrán esta promoción" 
       min="0" oninput="checkInputLength()" autocomplete="off" onpaste="return false;">
<p id="lengthMessage" ></p>

<script>
function checkInputLength() {
  var inputField = document.getElementById("Cantidad");
  var lengthMessage = document.getElementById("lengthMessage");
  
  if (inputField.value.length > 20) {
    inputField.value = inputField.value.substring(0, 20);
    lengthMessage.textContent = "Máximo de 20 caracteres alcanzado.";
  } else {
    lengthMessage.textContent = "";
  }
}
</script>
                        <hr>
                        <div id="btnagregarPromocion">
                            <input type="submit" id="btnagregar" onclick="AgregarPromocion(event)" value="Agregar Promoción al producto" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/PromocionesProductos.php";
                    };
                    </script>
                </div>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

</body>
</html>
