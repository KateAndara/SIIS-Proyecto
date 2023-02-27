<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="../JS/script.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Editar Usuarios</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

  <!-- Re insertar los datos modificados-->
  <?php
  if(!isset($_GET['Id_Usuario'])){
    header('Location: Usuarios.php?mensaje=error');
    exit();
    }
    include_once '../config/conexion.php';
    
    $Id_Usuario = $_GET['Id_Usuario'];
    $sentencia = $conexion->prepare("select * from tbl_ms_usuarios where Id_Usuario = ?;");

    $sentencia->execute([$Id_Usuario]);
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($usuario);
?>
<div class="container mt-5" style="width: 100rem">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar usuarios:
                </div>
                <form class="p-4" method="POST" action="../controller/editarUsuario.php" action="../controller/editarUsuario.php">
                <div class="mb-3">
                        <label class="form-label">Id Usuario: </label>
                        <input type="number" class="form-control"  readonly name="Id_Usuario" autofocus required
                        value="<?php echo $usuario->Id_Usuario; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Id Rol: </label>
                        <input type="number" class="form-control" name="Id_Rol" required 
                        value="<?php echo $usuario->Id_Cargo; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Id_Cargo: </label>
                        <input type="number" class="form-control" name="Id_Cargo" autofocus required
                        value="<?php echo $usuario->Id_Cargo; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Usuario: </label>
                        <input type="text" class="form-control" name="Usuario" autofocus required
                        value="<?php echo $usuario->Usuario; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="Nombre" required 
                        value="<?php echo $usuario->Nombre; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <div style="font-size: 20px">
                            <label for="Estado">Estado del usuario</label>
                            <select name="Estado" id="Estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Bloqueado">Bloqueado</option>
                                <option value="Nuevo">Nuevo</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label class="form-labesl">Contraseña: </label>
                        <input type="text" class="form-control" name="Contraseña" autofocus required
                        value="<?php echo $usuario->Contraseña; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ultima fecha de conexion: </label>
                        <input type="date" class="form-control" readonly name="Fecha_ultima_conexion" required 
                        value="<?php echo $usuario->Fecha_ultima_conexion; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preguntas contestadas: </label>
                        <input type="number" class="form-control" name="Preguntas_contestadas" autofocus required
                        value="<?php echo $usuario->Preguntas_contestadas; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Primer_ingreso: </label>
                        <input type="number" class="form-control" name="Primer_ingreso" autofocus required
                        value="<?php echo $usuario->Primer_ingreso; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha_vencimiento: </label>
                        <input type="date" class="form-control" readonly name="Fecha_vencimiento" required 
                        value="<?php echo $usuario->Fecha_vencimiento; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DNI: </label>
                        <input type="number" class="form-control" name="DNI" autofocus required
                        value="<?php echo $usuario->DNI; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo_Electronico: </label>
                        <input type="Email" class="form-control" name="Correo_Electronico" autofocus required
                        value="<?php echo $usuario->Correo_Electronico; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Creado_por: </label>
                        <input type="text" class="form-control" readonly name="Creado_por" autofocus required
                        value="<?php echo $usuario->Creado_por; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha_creacion: </label>
                        <input type="date" class="form-control" readonly name="Fecha_creacion" autofocus required
                        value="<?php echo $usuario->Fecha_creacion; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modificado_por: </label>
                        <input type="text" class="form-control" name="Modificado_por" autofocus required
                        value="<?php echo $usuario->Modificado_por; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha_modificacion: </label>
                        <input type="date" class="form-control"  name="Fecha_modificacion" autofocus required
                        value="<?php echo $usuario->Fecha_modificacion; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="Id_Usuario" value="<?php echo $usuario->Id_Usuario; ?>">
                        <div id="btnEditar">
                            <input type="submit" class="btn btn-primary" value="Editar">
                        </div>
                    </div>
                    <?php require_once("../config/conexion.php");?>
            </form>
            </div>
        </div>
    </div>
</div>

  
      
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>