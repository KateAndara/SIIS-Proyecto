<?php

    session_start();
    require_once("../config/conexion.php");
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null || $varsesion ==''){
        header("location: index.html");
        die();
    }
    // Consulta para obtener el id_rol del usuario.
  $sql = "SELECT Id_Rol FROM tbl_ms_usuarios WHERE Usuario='$varsesion' LIMIT 1";
  $resultado = $conexion->query($sql);
  
  // Almacenar el id_rol en la variable de sesión.
  if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['Id_Rol'] = $fila['Id_Rol'];
    $id_rol=$_SESSION['Id_Rol'];
  }

  // Obtener el rol correspondiente al ID.
  $sql = "SELECT * FROM tbl_ms_roles WHERE Id_Rol='$id_rol' LIMIT 1";
  $resultado = $conexion->query($sql);
  
  // Almacenar el nombre del rol.
  if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $nombre_rol = $fila['Rol'];
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INICIO-SIIS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <script src="https://kit.fontawesome.com/f9fa9477bb.js" crossorigin="anonymous"></script>
    <link href="../bootstrap.min.css" rel="stylesheet">
    <link href="../style2.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h2>SIIS</h2>
                </a>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-hand-holding-dollar"></i></i>VENTAS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="" class="dropdown-item">Nueva Venta</a>
                            <a href="" class="dropdown-item">Descuentos</a>
                            <a href="" class="dropdown-item">Promociones</a>
                            <a href="" class="dropdown-item">Detalle de Venta</a>
                            <a href="" class="dropdown-item">Descuentos Aplicados</a>
                            <a href="" class="dropdown-item">Promociones Aplicadas</a>
                            <a href="" class="dropdown-item">Clientes</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-cart-shopping"></i></i>COMPRAS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="" class="dropdown-item">Nueva Compra</a>
                            <a href="" class="dropdown-item">Detalle de Compras</a>
                            <a href="" class="dropdown-item">Proveedores</a>
                            <a href="" class="dropdown-item">Detalle de los productos <br>comprados</a> 
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-piggy-bank"></i></i>PRODUCCIÓN</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="" class="dropdown-item">Proceso de Producción</a>
                            <a href="" class="dropdown-item">Producto terminado de la<br> Materia Prima</a>
                            <a href="" class="dropdown-item">Producto Terminado Final</a> 
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></i>INVENTARIO</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="" class="dropdown-item">Inventario</a>
                            <a href="" class="dropdown-item">Productos</a>
                            <a href="" class="dropdown-item">Kardex</a> 
                        </div>
                    </div>
                    <?php
                    if ($nombre_rol == 'Administrador') {
                        echo'<div class="nav-item dropdown">';
                        echo'<a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-shield-halved"></i></i>SEGURIDAD</a>';
                        echo '<div class="dropdown-menu bg-transparent border-0">';
                           echo '<a href="" class="dropdown-item">Usuarios</a>';
                            echo '<a href="" class="dropdown-item">Roles</a>';
                            echo '<a href="" class="dropdown-item">Permisos</a>';
                            echo '<a href="" class="dropdown-item">Bitácora</a>';
                            echo '<a href="" class="dropdown-item">Parámetros</a>';
                            echo '<a href="" class="dropdown-item">Preguntas</a>';
                        echo '</div>';
                    echo '</div>';
                    }
                    ?>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-screwdriver-wrench"></i></i>MANTENIMIENTO</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="" class="dropdown-item">Cargos</a>
                            <a href="" class="dropdown-item">Estado de Venta</a>
                            <a href="" class="dropdown-item">Tipo de Producto</a>
                            <a href="" class="dropdown-item">Talonario</a>
                            <a href="" class="dropdown-item">Contactos de Proveedores</a>
                            <a href="" class="dropdown-item">Contactos de Clientes</a>
                            <a href="" class="dropdown-item">Tipo de Contacto</a>
                            <a href="" class="dropdown-item">Tipo de Movimiento</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link"><i class="fa fa-table me-2"></i>ACERCA DE</a>
                </div>
            </nav>
        </div>
       
    </div>

    <div class="content">
        <nav class= "navbar bg-secondary navbar-dark"> 
            <div class="navbar-nav align-items-center ms-auto">
                <p style ="color:white">
                USUARIO CONECTADO <?php echo ucwords($_SESSION['usuario']);?> 
                </p>      
            <a href="cerrar_sesion.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> SALIR</a>      
            </div>
        </nav>
    </div>
    
    <!--Librería javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
