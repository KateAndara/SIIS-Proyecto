<!doctype html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../style.css">
  <script src="../JS/script.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Usuarios</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

<?php
    include_once "../config/conexion2.php"; 
    $sentencia = $conexion -> query("select * from tbl_ms_usuarios");
    $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($usuario);
?>

<div ALIGN="left" class="container mt-7">
    <div  class =" row justify-content-left">
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 ">
            <!-- inicio alerta -->
            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Usuario eliminado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 

            <!-- fin alerta -->
                
            <!--Noton que lleva a menu principal -->
            <a href="inicio.php" type="submit"  class="btn btn-warning">Menu principal</a>

            <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 103rem">
                <div class="d-flex justify-content-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
                </div>
                <div class="card-header">
                   <h2> Lista de personas </h2>
                </div>
                <div class="p-4">
                <table style="width: 80rem" class="table table-striped table table-hover table table-dark  table table-bordered border-secundary"> 
                        <thead>
                            <tr>
                                <th scope="col">Id Usuario</th>
                                <th scope="col">Id Rol</th>
                                <th scope="col">Id cargo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Fecha de ultima conexión</th>
                                <th scope="col">Preguntas contestadas</th>
                                <th scope="col">Primer ingreso</th>
                                <th scope="col">Fecha de vencimiento</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Correo electronico</th>
                                <th scope="col">Creado por</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col">Modificado por</th>
                                <th scope="col">Fecha de modificacion</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($usuario as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->Id_Usuario; ?></td>
                                <td><?php echo $dato->Id_Rol; ?></td>
                                <td><?php echo $dato->Id_Cargo; ?></td>
                                <td><?php echo $dato->Usuario; ?></td>
                                <td><?php echo $dato->Nombre; ?></td>
                                <td><?php echo $dato->Estado; ?></td>
                                <td><?php echo $dato->Contraseña; ?></td>
                                <td><?php echo $dato->Fecha_ultima_conexion; ?></td>
                                <td><?php echo $dato->Preguntas_contestadas; ?></td>
                                <td><?php echo $dato->Primer_ingreso; ?></td>
                                <td><?php echo $dato->Fecha_vencimiento; ?></td>
                                <td><?php echo $dato->DNI; ?></td>
                                <td><?php echo $dato->Correo_Electronico; ?></td>
                                <td><?php echo $dato->Creado_por; ?></td>
                                <td><?php echo $dato->Fecha_creacion; ?></td>
                                <td><?php echo $dato->Modificado_por; ?></td>
                                <td><?php echo $dato->Fecha_modificacion; ?></td>
                                <td><a class="text-success" href="EditarUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar el usuario?');" class="text-danger" href="../controller/DeleteUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>
                            
                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    <a href="GestionUsuario.php" type="submit"  class="btn btn-primary">Crear usuario</a>
                </div>
            </div>
        </div>
    </div>
</div>
      
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>