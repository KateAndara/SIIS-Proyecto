<?php 
   ob_start();
   include '../components/header.components.php';
    getPermisos(MUSUARIOS);
  

    
    //si no exite el permiso de consultar vuelve a la pagina de inicio
    if(empty($_SESSION['permisosMod']['r'])){
        header('Location: inicio.php');
    }
    ob_start();

date_default_timezone_set('America/Tegucigalpa');

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige al usuario a la página de inicio de sesión
    header("Location: Login.php");
    exit();
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
    <script src="../JS/Usuario.js"></script>
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

<style>
    #btnAgregarUsuario button {
        display: inline-block;
    }
    #btnAgregarUsuario button:first-child {
        margin-right: 10px; /* opcional: añade un margen derecho al primer botón */
    }
</style>

    <div id="btnAgregarUsuario">
            <?php
            if (!isset($_SESSION['usuario'])) {
                // Si no hay un usuario en la sesión, redirige al usuario a la página de inicio de sesión
                header("Location: Login.php");
                exit();
            }
            $usuario = $_SESSION['Id_Usuario']; // Almacena la sesión del usuario.

            // Imprimes el botón HTML con el parámetro $usuario en el atributo onclick
            echo '<button class="btn btn-success" onclick="verUsuario(\'' . $usuario . '\');" data-bs-toggle="modal" data-bs-target="#modalUsuario">Ver Mi Perfil</button>';
            echo '<button class="btn btn-success" onclick="CargarUsuarioPerfil(\'' . $usuario . '\'); mostrarFormulario();">Editar Mi Perfil</button>';
           ?>
                        <script>
                        function mostrarFormulario() {
                        var formulario = document.querySelector('.Formulario'); //Muestra el formulario de agregar y actualizar.
                        formulario.style.display = 'block';
                        var consultaDiv = document.getElementById("consulta"); //Oculta el formulario de la tabla.
                        consultaDiv.style.display = "none";
                        }
                        </script>
                                        
    </div>
<!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:black">Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                    <td>USUARIO:</td>
                    <td id="celUsuario"></td>
                    </tr>
                    <tr>
                    <td>Nombre:</td>
                    <td id="celNombre"></td>
                    </tr>
                    <tr>
                    <td>Correo:</td>
                    <td id="celCorreo"></td>
                    </tr>
                    <tr>
                    <td>Estado:</td>
                    <td id="celEstado">Larry</td>
                    </tr>
                    <tr>
                    <td>DNI:</td>
                    <td id="celDNI">Larry</td>
                    </tr>
                    <tr>
                    <td>ROL:</td>
                    <td id="celRol">Larry</td>
                    </tr> 
                    <tr>
                    <td>Cargo:</td>
                    <td id="celCargo">Larry</td>
                    </tr> 
                    <tr>
                    <td>Fecha Creación:</td>
                    <td id="celFCreacion">Larry</td>
                    </tr> 
                    <tr>
                    <td>Creado Por:</td>
                    <td id="celCreado">Larry</td>
                    </tr>
                    <tr>
                    <td>Fecha Modificación:</td>
                    <td id="celFModificación">Larry</td>
                    </tr>
                    <tr>
                    <td>Modificado Por::</td>
                    <td id="celModificado">Larry</td>
                    </tr>
                    <tr>
                    <td>Fecha Vencimiento:</td>
                    <td id="celFVencimiento">Larry</td>
                    </tr>
                    <tr>
                    <td>Ultima Conexión:</td>
                    <td id="celConexion">Larry</td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>


    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: auto; margin-right: auto">
        <div class="Formulario" style="display: none;">
            <div class="row">
                <div class="Col-12" id="titulo">
                    <h3>
                        Agregar Usuario
                    </h3>
                </div>
                <div class="col-12">
                    <form class="InsertUsuario"  id="InsertUsuario"  onsubmit="validarFormulario()">
                    <input type="number" id="Id_Usuario" class="form-control" placeholder="Ingrese el código del rol" hidden>
                      <div class="col-12 mt-2 row">
                          <div class="col-6">
                             
                            <label for="">USUARIO</label>
                            <input type="text" id="usuario" onkeyup="javascript:this.value=this.value.toUpperCase();" name="usuario" class="form-control " placeholder="Ingrese el Usuario">
                          </div>

                          <div class="col-6">
                            <label for="">NOMBRE</label>
                            <input type="text" id="nombre" name="Nombre" class="form-control valid validText" placeholder="Ingrese el Nombre">
                          </div>
                      </div>

                      <div class="col-12 mt-2 row">
                          <div class="col-6">
                             
                            <label for="">DNI</label>
                            <input type="text" id="DNI" name="DNI" class="form-control valid validNumberDni" placeholder="Ingrese el DNI">
                          </div>

                          <div class="col-6">
                            <label for="">Correo Electronico</label>
                            <input type="text" id="correo" name="correo" class="form-control valid validEmail" placeholder="Ingrese el Correo Electronico">
                          </div>
                      </div>

                      <div class="col-12 mt-2 row">
                          <div class="col-6">
                             
                            <label for="">Contraseña</label>
                            <input type="password" name="contraseña " id="contraseña" class="form-control valid ValidContra" placeholder="Ingrese la contraseña ">
                          </div>

                          <div class="col-6">
                            <label for="">Confirmar Contraseña</label>
                            <input type="password" id="confirmContraseña" name="confirmContraseña" class="form-control valid ValidContra" placeholder="Ingrese la confirmación de la contraseña ">
                          </div>
                      </div>

                      <div class="col-12 mt-2 row">
                          <div class="col-6">
                             
                            <label for="">Rol</label>
                            <select name="rolSelect" id="rolSelect" class="form-select"></select>
                          </div>

                          <div class="col-6">
                             
                             <label for="">Cargo</label>
                             <select name="cargoSelect" id="cargoSelect" class="form-select"></select>
                           </div>
                      </div>

                      
                      <div class="col-12 mt-2 row">
                          <div class="col-6">
                            <label for="">Fecha Vencimiento</label>
                            <input type="date" readonly  value=<?php $hoy=date("Y-m-d"); echo date("Y-m-d",strtotime($hoy."+ 30 days"));?> id="fechaVencimiento" name="fechaVencimiento" class="form-control" placeholder="Ingrese la confirmación de la contraseña">
                          </div>

                          <div class="col-6">
                            <label for="">Estado</label>
                            <select name="selecEstado"  id="selecEstado" class="form-select">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>

                            </select>

                          </div>
                      </div>
                        <hr>

                        
                    </form>
                    <script> //Cancela la acción
                    document.getElementById("btncancelar").onclick = function() {
                        location.href = "http://localhost/SIIS-PROYECTO/Formularios/GestionUsuario.php";
                    };
                    </script>
                    
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