<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();
    if (isset($_POST["btnEditar"])){
 
        include '../config/conexion2.php';
        $Id_Usuario = $_POST['Id_Usuario'];
        $Id_Rol = $_POST['Id_Rol'];
        $Id_Cargo = $_POST['Id_Cargo'];
        $Usuario = strtoupper($_POST['Usuario']);
        $Nombre = strtoupper($_POST['Nombre']);
        $Estado = $_POST['Estado'];
        $Contraseña = $_POST['Contraseña'];
        $clave =  $_POST['Contraseña'];
        $Fecha_ultima_conexion = $_POST['Fecha_ultima_conexion'];
        $Preguntas_contestadas = $_POST['Preguntas_contestadas'];
        $Primer_ingreso = $_POST['Primer_ingreso'];
        $Fecha_vencimiento = $_POST['Fecha_vencimiento'];
        $DNI = $_POST['DNI'];
        $Correo_Electronico = $_POST['Correo_Electronico'];
        $Creado_por = $_POST['Creado_por'];
        $Fecha_creacion = $_POST['Fecha_creacion'];
        $Modificado_por = $_POST['Modificado_por']; 

        // Funcion para validar contraseña
        function valcontraseña($clave){
            if (!preg_match('`[a-z]`',$clave)){
              
              return false;
           }
           if (!preg_match('`[A-Z]`',$clave)){
              
              return false;
           }
           if (!preg_match('`[0-9]`',$clave)){
              
              return false;
           }
           return true;
          }

          function valdni($DNI) {         
            $patron2 = "/^[0-9-\d]*$/";
            if(preg_match($patron2, $DNI)) {
                return true;
            }else{
                return false;
            }
          } 
      
        $sql=$conexion->query(" select * from tbl_ms_usuarios");
 
        if ($Usuario=="" ||$Id_Rol=="" ||$Id_Cargo=="" ||$Nombre=="" ||$Estado=="" ||$DNI=="" ||$Correo_Electronico=="" ||$Modificado_por=="" ){ // Validación de campos vacíos.
          echo '<br>';
          echo '<div class="alert alert-danger">Debe llenar el o los campos vacíos.</div>';
        }else if (strlen($Usuario)> 45){ // Validación de la cantidad de caracteres en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Usuario no puede exceder de 45 caracteres.</div>';
        }else if (strlen($DNI)> 16){ // Validación de la cantidad de caracteres en el campo DNI.
            echo '<br>';
            echo '<div class="alert alert-danger">El campo DNI no puede exceder de 16 caracteres.</div>';
        }else if(strpbrk($Usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
        }else if(valcontraseña($clave)==false){ // Validación del campo del correo con @ y punto.
            echo '<br>';
            echo '<div class="alert alert-danger">La contraseña debe tener minimo 1 carácter en mayúscula, minúscula y un carácter númerico </div>';
          }else if(valdni($DNI)==false){ // Validación de solo numeros en el campo del dni.
            echo '<br>';
            echo '<div class="alert alert-danger">El dni solo debe tener números y guión</div>';
          }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
            echo '<br>';
            echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
          }else{
            $id = $_GET['Id_Usuario'];
            $datesss = date("Y-m-d");
            $sql=$conexion -> query("
            UPDATE TBL_MS_USUARIOS SET 
            Id_Rol = '$Id_Rol', 
            Usuario = '$Usuario', 
            Nombre = '$Nombre',
            Estado = '$Estado',
            Contraseña = '$Contraseña', 
            DNI = '$DNI',
            Correo_Electronico = '$Correo_Electronico',
            Modificado_por = '$Modificado_por',
            Fecha_modificacion = '$datesss' 
            WHERE  Id_Usuario = $id");
            echo '<br>';
          echo '<div class="alert alert-success">El Usuario se creo correctamente.</div>';
          header('Location: GestionUsuarios.php?mensaje=editado');
          
        }
    }

?>
<?phpinclude '../components/header.components.php';?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style3.css">
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
    include_once '../config/conexion2.php';
    //Sentecia para jalar los datos de los usuarios
    $Id_Usuario = $_GET['Id_Usuario'];
    $sentencia = $conexion->prepare("select * from tbl_ms_usuarios where Id_Usuario = ?;");

    $sentencia->execute([$Id_Usuario]);
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);

    require_once("../config/conexion.php");
    
    //Sentencia que jala los roles desde la tabla 
    $resultado = mysqli_query($conexion,"SELECT Id_Rol, Rol FROM tbl_ms_roles");

    //Sentencia que jala los cargos desde la tabla 
    $resultado1 = mysqli_query($conexion,"SELECT Id_Cargo, Nombre_cargo FROM tbl_cargos");

    //print_r($usuario);
    ?>
<div class="bg-black p-5 rounded-5 text-secondary shadow " style="width: 80rem">
    <div class="row justify-content-center ">
        <div class="form-group col-md-6" >
            <div class="d-flex justify-content-center">
              <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
            </div>
            <div class="card">
                <div class="card-header bg-black">
                   <h2 class="text-light"> Editar Usuario:</h2>
                </div>
                <h5>
                <form class="p-12 bg-black" method="POST" action="EditarUsuario.php?Id_Usuario=<?php echo $_GET['Id_Usuario'] ?>">
                
                <div class="row justify-content-center">
                <div class="form-group col-md-6">
                        <label class="text-light"> Id Usuario: </label>
                        <input type="number" class="form-control"  readonly name="Id_Usuario"   required readonly
                        value="<?php echo $usuario->Id_Usuario; ?>">
                </div>
                <!--Muestra los datos traidos desde la base de datos de los roles que hay-->
                    <div class="form-group col-md-6">
                        <label class="text-light">Id Rol: </label>
                        <select name="Id_Rol" class="custom-select">
                                <?php while ($fila = $resultado->fetch_assoc()):
                                    $id_rol = $fila["Id_Rol"];
                                    $rol = $fila["Rol"];
                                     $s =  ($usuario->Id_Rol == $id_rol ) ? 'selected' : '';

                                    echo "<option 
                                      ".$s."
                                    value='{$id_rol}'>{$rol}
                                    </option>";
                                    endwhile;  
                                ?>  
                        </select>
                    </div>

                    </div>
                    <div class="row justify-content-center">
                        <!--Muestra los datos traidos desde la base de datos de los roles que hay-->
                        <div class="form-group col-md-6">
                            <label class="text-light">Id Cargo: </label>
                            <select name="Id_Cargo" class="custom-select">
                                    <?php while ($fila = $resultado1->fetch_assoc()):
                                        $id_Cargo = $fila["Id_Cargo"];
                                        $nombre_cargo = $fila["Nombre_cargo"];
                                        $s =  ($usuario->Id_Cargo == $id_Cargo ) ? 'selected' : '';

                                        echo "<option 
                                        ".$s."
                                        value='{$id_Cargo}'>{$nombre_cargo}
                                        </option>";
                                        endwhile;  
                                    ?>  
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-light">Usuario: </label>
                            <input style=" text-transform: uppercase; " type="text" class="form-control" name="Usuario" maxlength="45" autofocus required
                            value="<?php echo $usuario->Usuario; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Nombre: </label>
                            <input style=" text-transform: uppercase; " type="text" class="form-control" name="Nombre" maxlength="60" autofocus required 
                            value="<?php echo $usuario->Nombre; ?>">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <div style="font-size: 20px">
                                <label class="text-light" for="Estado">Estado del usuario</label>
                                <select name="Estado" id="Estado">
                                    <option <?php echo ($usuario->Estado == 'Estado') ? 'selected' : '' ?> value="Activo">Activo</option>
                                    <option <?php echo ($usuario->Estado == 'Inactivo') ? 'selected' : '' ?> value="Inactivo">Inactivo</option>
                                    <option <?php echo ($usuario->Estado == 'Bloqueado') ? 'selected' : '' ?> value="Bloqueado">Bloqueado</option>
                                    <option <?php echo ($usuario->Estado == 'Nuevo') ? 'selected' : '' ?> value="Nuevo">Nuevo</option>
                                </select>
                            </div>    
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Contraseña: </label>
                            <input type="text" class="form-control" name="Contraseña" maxlength="15" minlength="5" autofocus required
                            value="<?php echo $usuario->Contraseña; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-light">Ultima fecha de conexion: </label>
                            <input type="date" class="form-control" readonly name="Fecha_ultima_conexion" 
                            value="<?php echo $usuario->Fecha_ultima_conexion; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Preguntas contestadas: </label>
                            <input type="number" class="form-control" name="Preguntas_contestadas"   readonly
                            value="<?php echo $usuario->Preguntas_contestadas; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-light">Primer ingreso: </label>
                            <input type="number" class="form-control" name="Primer_ingreso" autofocus autofocus readonly
                            value="<?php echo $usuario->Primer_ingreso; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Fecha vencimiento: </label>
                            <input type="date" class="form-control" readonly name="Fecha_vencimiento" autofocus required  readonly
                            value="<?php echo $usuario->Fecha_vencimiento; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-light">DNI: </label>
                            <input type="text" class="form-control" name="DNI" maxlength="16" autofocus required readonly
                            value="<?php echo $usuario->DNI; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Correo Electronico: </label>
                            <input type="Email" class="form-control" name="Correo_Electronico" autofocus required
                            value="<?php echo $usuario->Correo_Electronico; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-light">Creado por: </label>
                            <input type="text" class="form-control" readonly name="Creado_por" autofocus required
                            value="<?php echo $usuario->Creado_por; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Fecha de creación: </label>
                            <input type="date" class="form-control" readonly name="Fecha_creacion" autofocus required
                            value="<?php echo $usuario->Fecha_creacion; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-light">Modificado por: </label>
                            <input type="text" class="form-control" name="Modificado_por" autofocus required readonly
                            value="<?php echo $_SESSION['usuario']; ?>">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="text-light">Fecha de modificacion: </label>
                            <input type="text" class="form-control"   name="Fecha_modificacion" autofocus readonly
                            value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="d-flex gap-1 justify-content-center mt-1">
                            <input type="hidden" name="Id_Usuario" value="<?php echo $usuario->Id_Usuario; ?>">
                            <div >
                                <input name="btnEditar" type="submit" class="btn btn-primary" value="Editar">
                                <a href="GestionUsuarios.php" type="submit"  class="btn btn-warning">Cancelar</a>
                            </div>
                        </div>
                    </div>
                    <?php require_once("../config/conexion2.php");?>
            </form>
        </h5>
            </div>
        </div>
    </div>
</div>

    <!--librerias Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>

<?php include '../components/footer.components.php' ?>

