<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MTALONARIO);
  

    
    //si no exite el permiso de consultar vuelve a la pagina de inicio
    if(empty($_SESSION['permisosMod']['r'])){
        header('Location: inicio.php');
    }
    ob_start();


date_default_timezone_set('America/Tegucigalpa');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talonario</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Talonario.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
    " rel="stylesheet">


</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 100%; max-width: none; margin-left: auto; margin-right: auto">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Talonarios
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
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('tablaTalonario','REPORTE DE TALONARIOS',60)">Generar PDF</button>
                        </form>
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
                    <table class="table table-hover" id="tablaTalonario">
                        <thead>
                            <tr>
                                <th>ID TALONARIO</th>
                                <th>CAI</th>
                                <th>RANGO INICIAL</th>
                                <th>RANGO FINAL</th>
                                <th>RANGO ACTUAL</th>
                                <th>VENCIMIENTO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Talonario
                    </h3>
                </div>
                <div class="col-12">
                    <form class="insert"   onsubmit="validarFormulario()">
                        <label for="Id" hidden>ID Talonario</label>
                        <input type="number" id="Id_Talonario" class="form-control" placeholder="Ingrese el código del rol" hidden>
                            <div class="col-12 mt-2 row">
                                    <div class="col-12">
                                    <label for="">NUMERO CAI</label>
                                    <input type="text" maxlength="60"  pattern="^[\d-]+$" id="CAI" class="form-control " placeholder="Ingrese el numero Cai" oninput="validarEntrada(this)">
                                    </div>
                                 
                                </div>
                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">Rango Inicial:</label>
                                       
                                        <span class="badge text-bg-primary" id="num">0</span>
                                        <input type="range" value="0" id="rangeInicial" class="form-range" placeholder="Ingrese el numero Cai">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Rango Final</label>
                                    
                                        <span class="badge text-bg-success" id="num2">0</span>

                                        <input type="range" value="0" id="rangeFinal" class="form-range" placeholder="Ingrese el numero Cai">
                                    </div>
                          
                                </div>
                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                    <label for="">Rango Actual</label>
                                    <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    type="number"
                                    maxlength="10" id="rangeActual"  class="form-control" placeholder="Ingrese el rango actual del talonario">
                                    </div>

                                    <div class="col-6">
                                    <label for="">Fecha Vencimiento</label>
                                    <input type="date" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> id="date_vencimiento" class="form-control" placeholder="Ingrese el rango actual del talonario">
                                    </div>
                                </div>
                       
                       
                        <hr>
                        <div id="btnagregarRol">
                            <a  id="btnagregar" onclick="agregarTalonario()" value="" class="btn btn-success">Agregar Talonario</a>
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/Talonario.php";
                    };
                    </script>
                </div>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script>

var slider = document.getElementById("rangeInicial");
  var output = document.getElementById("num");
  var slider2 = document.getElementById("rangeFinal");
  var output2 = document.getElementById("num2");
  var rangoActual=document.getElementById("rangeActual");


  $(output).val(slider.value);
  slider.oninput = function() {
    
      output.innerHTML=slider.value;
      minRange2=slider.value;
      minRange2 =parseInt(minRange2);
      minRange2=minRange2+1;
      slider2.setAttribute("min",minRange2);
      output2.setAttribute("min",minRange2);    
      rangoActual.setAttribute("value",slider.value);
      output2.innerHTML=minRange2;
     
      
  }
 
  $(output).val(slider2.value);
  slider2.oninput = function() {
  
      output2.innerHTML=slider2.value;

      maxRange=slider2.value;
      maxRange =parseInt(maxRange);
      maxRange=maxRange-1;
      slider.setAttribute("max",maxRange);
  }



    function validarEntrada(input) { 
  const patron = /^[0-9-]+$/;
  const valor = input.value;
  if (!patron.test(valor)) {
    swal.fire('Error','Solo se permiten números del 0 al 9 y guiones', 'error');
    input.value = input.value.slice(0, -1);
  } else {
  
  }
}


</script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>