<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MTIPOPRODUCTO);
  

    
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
    <title>Tipo de producto</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Agregar jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/TipoProductoMM.js"></script>
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
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 100%; max-width: none; margin-left: -20px; border: 1px solid black;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                        Lista De Tipos De Producto
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
                    <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="generarReporte('TablaTiposProducto','REPORTE DE CARGOS',60)">Generar PDF</button>
                </form>
            </div>

            <script> 
                $(document).ready(function(){          //Lee la búsqueda
                    $('#form-busqueda').submit(function(event){ 
                        event.preventDefault(); 

                        var busqueda = $('#input-busqueda').val();
                        if(busqueda == "") {
                            CargarTipoProductosMM();
                        } else {
                            BuscarTipoProductoMM(busqueda);
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
                    <table class="table table-hover" id="TablaTiposProducto">
                        <thead>
                            <tr>
                                <th>N° </th>
                                <th>NOMBRE DEL TIPO DE PRODUCTO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataTipoProductosMM">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3 style="color: black;">
                        Agregar Tipo De Producto 
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertTipoProducto">
                        <input type="number" id="Id_Tipo_Producto" class="form-control" placeholder="Ingrese el tipo del producto"hidden>
                        
                        <label for="">NOMBRE TIPO DE PRODUCTO </label>
                        <input type="text" id="Nombre_tipo" autocomplete="off" class="form-control" placeholder="Ingrese El Nombre Del Tipo De Producto" oninput="validarEntrada(this)" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <hr>

                        <div id="btnagregarTipoProducto">
                            <a  id="btnagregar" onclick="AgregarTipoProductoMM()" value="Agregar el Tipo De Producto" class="btn btn-success">Agregar el Tipo De Producto</a>
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/TipoProductoMM.php";
                    };
                    </script>
                </div>
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script>
  function validarEntrada(input) { 

  const patron = /^[A-Z- a-z0-9-]+$/;
  const valor = input.value;
  if (!patron.test(valor)) {
    swal.fire('Error','Solo se permite ingresar letras, numeros y guiones', 'error');
    input.value = input.value.slice(0, -1);
  } else {
  
  }

}

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>
</html>
