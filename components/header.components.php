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
    <link href="../CSS/styleF.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
</head>

    <body>
            <div class="container-fluid">
                
                 
                        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                          <div class="container">
                                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>
                                    
                                    <div class="text-end">
                                    
                                        <span><i class="fa-solid fa-user"></i>  USUARIO CONECTADO <span style=" font-weight: 800; color: #1621CB; "><?php echo ucwords($_SESSION['usuario']);?></span> </span>
                                        <a href="../Formularios/cerrar_sesion.php" type="button" class="btn btn-outline-danger me-2">Salir</a>
                                        
                                    </div>
                                </div>
                          </div>
                        </header> 


                        <div class="sidebar pe-4 pb-3">
                            <nav class="navbar">
                                <a href="" class="navbar-brand mx-4 mb-3">
                                    <h2>SIIS</h2>
                                </a>
                                <div class="navbar-nav w-100">
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-hand-holding-dollar"></i></i>VENTAS</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <a href="../Formularios/NuevaVenta.php" class="dropdown-item">Nueva Venta</a>
                                            <a href="../Formularios/Ventas.php" class="dropdown-item">Proceso de ventas</a>
                                            <a href="../Formularios/DescuentosVentas.php" class="dropdown-item">Descuentos</a>
                                            <a href="../Formularios/PromocionesVentas.php" class="dropdown-item">Promociones</a>
                                            <a href="../Formularios/DetalleVenta.php" class="dropdown-item">Detalle de Venta</a>
                                            <a href="../Formularios/DescuentosAplicados.php" class="dropdown-item">Descuentos Aplicados</a>
                                            <a href="../Formularios/PromocionesAplicadas.php" class="dropdown-item">Promociones Aplicadas</a>
                                            <a href="../Formularios/Clientes.php" class="dropdown-item">Clientes</a>
                                        </div>
                                    </div>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-cart-shopping"></i></i>COMPRAS</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <a href="../Formularios/Compra.php" class="dropdown-item">Nueva Compra</a>
                                            <a href="" class="dropdown-item">Detalle de Compras</a>
                                            <a href="" class="dropdown-item">Proveedores</a>
                                            <a href="" class="dropdown-item">Detalle de los productos <br>comprados</a> 
                                        </div>
                                    </div>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-piggy-bank"></i></i>PRODUCCIÓN</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <a href="../Formularios/ProcesoProduccion.php" class="dropdown-item">Proceso de Producción</a>
                                            <a href="../Formularios/ProductoTerminadoMP.php" class="dropdown-item">Producto terminado de la<br> Materia Prima</a>
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
                                        echo '<a href="GestionUsuarios.php" class="dropdown-item">Usuarios</a>';
                                        echo '<a href="../Formularios/Roles.php" class="dropdown-item">Roles</a>';
                                        echo '<a href="../Formularios/Permisos.php" class="dropdown-item">Permisos</a>';
                                        echo '<a href="../Formularios/Bitacora.php" class="dropdown-item">Bitácora</a>';
                                        echo '<a href="../Formularios/Parametros.php" class="dropdown-item">Parámetros</a>';
                                        echo '<a href="../Formularios/Preguntas.php" class="dropdown-item">Preguntas</a>';
                                        echo '<a href="../Formularios/Objetos.php" class="dropdown-item">Objetos</a>';
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
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-regular fa-folder-open"></i></i>ADMINISTRACIÓN</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <a href="" class="dropdown-item">Mi Perfil</a>
                                            <a href="" class="dropdown-item">Acerca de</a>
                                            <a href="" class="dropdown-item">Backup</a>
                                        </div>
                                    </div>
                                </div>
                            </nav>



                        </div>

            </div>


            <div class="container mt-0" style=" padding-left: 224px; ">
                <div class="row justify-content-center">
                    <div class="col-md-12">