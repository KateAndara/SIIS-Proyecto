<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MROLES);
  

    
    //si no exite el permiso de consultar vuelve a la pagina de inicio
    if(empty($_SESSION['permisosMod']['r'])){
        header('Location: inicio.php');
    }
    ob_start();

function getModal(string $nameModal, $data)
{
  $view_modal = "{$nameModal}.php";
  require_once $view_modal;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- Agregar jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Agregar DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script src="../JS/Roles.js"></script>
    <link href="../CSS/datatable.css" rel="stylesheet">
    <!-- Última versión de jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <link href="../CSS/styleF.css" rel="stylesheet">

    <!-- Última versión de AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.26/jspdf.plugin.autotable.min.js"></script>

    <script src="../Reportes/Reporte.js"></script>
   <style>
    .switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}

		.switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}

		input:checked+.slider {
			background-color: #2196F3;
		}

		input:focus+.slider {
			box-shadow: 0 0 1px #2196F3;
		}

		input:checked+.slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
			border-radius: 34px;
		}

		.slider.round:before {
			border-radius: 50%;
		}

   </style>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: auto; margin-right: auto; border: 1px solid black;">
        <div class="consulta mt-4" id="consulta">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="color: black;">
                        Lista de Roles
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
                <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarReporte('TablaRoles','REPORTE DE ROLES',60)">Generar PDF</button>            </form>
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

            function mostrarFormulario2() {
            var formulario = document.querySelector('.Formulario2'); //Muestra el formulario de agregar y actualizar.
            formulario.style.display = 'block';
            var consultaDiv = document.getElementById("consulta"); //Oculta el formulario de la tabla.
            consultaDiv.style.display = "none";
            }

            </script>
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover" id="TablaRoles">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>ROL</th>
                                <th>DESCRIPCIÓN</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody id="DataRoles">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3 style="color: black;">
                        Agregar Rol
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertRol" >
                        <label for="Id_Rol" hidden>ID ROL</label>
                        <input type="number" id="Id_Rol" class="form-control" placeholder="Ingrese el código del rol"hidden>
                        <label for="">ROL</label>
                        <input type="text" id="Rol" class="form-control" placeholder="Ingrese el rol"onkeyup="this.value=this.value.toUpperCase()">
                        <label for="">DESCRIPCIÓN</label>
                        <input type="text" id="Descripcion" class="form-control" placeholder="Ingrese la descripción del rol"onkeyup="this.value=this.value.toUpperCase()">
                        <hr>
                        <div id="btnagregarRol">
                            <input type="submit" id="btnagregar" onclick="AgregarRol()" value="Agregar Rol" class="btn btn-success">
                            <button type="button" id="btncancelar"  class="btn btn-secondary">Cancelar</button>
                        </div>
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/Roles.php";
                    };
                    </script>
                </div>
            </div>
        </div>


        
        <div class="Formulario2" style="display: none;">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                        <button class="rounded" style="background-color: #fff; color: dark; float: right;"onclick="generarPDF()">Generar PDF</button>           </form>

                            <h3 id="tituloPermisos">
                                Permisos
                            </h3>

                        </div>
                        <div class="col-12" id="getPermisos" >
                            
                        
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