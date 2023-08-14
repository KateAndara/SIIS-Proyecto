<?php

    session_start();
    require_once("../config/conexion.php");
    require_once("../config/helpers.php") ;

    $varsesion = $_SESSION['usuario'];
    if($varsesion == null || $varsesion ==''){
        header("location: index.html");
        die();
    }
  // Verificar si ha pasado más de 5 minutos desde la última actividad del usuario
if (isset($_SESSION['time']) && (time() - $_SESSION['time']) > 600) {
    // Si ha pasado más de 5 minutos, redirigir a la página de cierre de sesión
    header("Location: inactividad.php");
    die();
}

// Actualizar la última actividad del usuario en la variable de sesión
$_SESSION['time'] = time();
    // Consulta para obtener el id_rol del usuario.
    $sql = "SELECT * FROM tbl_ms_usuarios WHERE Usuario='$varsesion' LIMIT 1";
    $resultado = $conexion->query($sql);

    
  
  // Almacenar el id_rol en la variable de sesión.
  if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['Id_Rol'] = $fila['Id_Rol'];
    $_SESSION['Id_Usuario'] = $fila['Id_Usuario'];
    $_SESSION['nombre'] = $fila['Nombre'];

    $id_rol=$_SESSION['Id_Rol'];


    $sql = "SELECT * FROM tbl_ms_parametros where Parametro='IMPUESTO'";
    $resultado = $conexion->query($sql);
    $fila2 = $resultado->fetch_assoc();
    $_SESSION['IMPUESTO']=$fila2['Valor'];


  }

  // Obtener el rol correspondiente al ID.
  $sql = "SELECT * FROM tbl_ms_roles WHERE Id_Rol='$id_rol' LIMIT 1";
  $resultado = $conexion->query($sql);
  
  // Almacenar el nombre del rol.
  if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    $nombre_rol = $fila['Rol'];
  }

  getPermisos(0);

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
  <script> var Impuesto=<?=  $_SESSION['IMPUESTO']  ?> ;</script>
</head>

    <body>
            <div class="container-fluid">
                
                 
                        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                          <div class="container">
                                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>
                                    
                                    <div class="text-end">
                                    
                                        <span><i class="fa-solid fa-user"></i>  USUARIO CONECTADO <span style=" font-weight: 800; color: #1621CB; "><?php echo ucwords($_SESSION['usuario']);?></span> </span>
                                        <a href="cerrar_sesion.php" type="button" class="btn btn-outline-danger me-2">Salir</a>
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

                                <?php
                                    if (!empty($_SESSION['permisos'][MVENTAS]['r']) || !empty($_SESSION['permisos'][MDESCUENTOS]['r']) || !empty($_SESSION['permisos'][MPROMOCIONES]['r']) || !empty($_SESSION['permisos'][MDETALLEVENTAS]['r']) || !empty($_SESSION['permisos'][MDESCUENTOSAPLICADOS]['r']) || !empty($_SESSION['permisos'][MPROMOCIONES_APLICADAS]['r']) || !empty($_SESSION['permisos'][MCLIENTES]['r'])) {

                                ?>

                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-hand-holding-dollar"></i></i>VENTAS</a>
                                        <div class="dropdown-menu bg-transparent border-0">

                                            <?php
                                                if (!empty($_SESSION['permisos'][MVENTAS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Ventas.php" class="dropdown-item">Ventas</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MDESCUENTOS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Descuentos.php" class="dropdown-item">Descuentos</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MPROMOCIONES]['r']) ) {
                                            ?>
                                            <a href="../Formularios/PromocionesVentas.php" class="dropdown-item">Promociones</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MPROMOCIONES]['r']) ) {
                                            ?>
                                            <a href="../Formularios/PromocionesProductos.php" class="dropdown-item">Promociones de productos</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MVENTAS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/DetalleVenta.php" class="dropdown-item">Detalle de Venta</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MVENTAS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/DescuentosAplicados.php" class="dropdown-item">Descuentos Aplicados</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MVENTAS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/PromocionesAplicadas.php" class="dropdown-item">Promociones Aplicadas</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MCLIENTES]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Clientes.php" class="dropdown-item">Clientes</a>
                                            <?php } 
                                               
                                            ?>
                                        </div>
                                    <?php } ?>


                                    <?php
                                    if (!empty($_SESSION['permisos'][MCOMPRAS]['r']) || !empty($_SESSION['permisos'][MPROVEEDORES]['r'])) {

                                    ?>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-cart-shopping"></i></i>COMPRAS</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <?php
                                                if (!empty($_SESSION['permisos'][MCOMPRAS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Compras.php" class="dropdown-item">Compras</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MCOMPRAS]['c']) ) {
                                            ?>
                                            <!--<a href="../Formularios/NuevaCompra.php" class="dropdown-item">Nueva Compra</a>-->
                                            <!-- <a href="" class="dropdown-item">Detalle de Compras</a> -->
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MPROVEEDORES]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Proveedores.php" class="dropdown-item">Proveedores</a>
                                        </div>
                                        <?php }} ?>
                                    </div>

                                    <?php
                                    if (!empty($_SESSION['permisos'][MPROCESOPRODUCCION]['r'])) {

                                    ?>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-piggy-bank"></i></i>PRODUCCIÓN</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <a href="../Formularios/GestionProcesoProduccion.php" class="dropdown-item">Gestionar Procesos de <br>Producción</a>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php
                                    if (!empty($_SESSION['permisos'][MINVENTARIO]['r']) || !empty($_SESSION['permisos'][MPRODUCTOS]['r']) || !empty($_SESSION['permisos'][MKARDEX]['r'])) {

                                    ?>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></i>INVENTARIO</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                            <?php
                                                if (!empty($_SESSION['permisos'][MINVENTARIO]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Inventario.php" class="dropdown-item">Inventario</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MPRODUCTOS]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Productos.php" class="dropdown-item">Productos</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MKARDEX]['r']) ) {
                                            ?>
                                            <a href="../Formularios/Kardex.php" class="dropdown-item">Kardex</a> 
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                   

                                    <?php
                                    if (!empty($_SESSION['permisos'][MUSUARIOS]['r']) || !empty($_SESSION['permisos'][MROLES]['r']) || !empty($_SESSION['permisos'][MBITACORA]['r']) || !empty($_SESSION['permisos'][MPARAMETROS]['r']) || !empty($_SESSION['permisos'][MPREGUNTAS]['r']) || !empty($_SESSION['permisos'][MOBJETOS]['r'])) {

                                    ?>
                                       <div class="nav-item dropdown">
                                       <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-shield-halved"></i></i>SEGURIDAD</a>
                                         <div class="dropdown-menu bg-transparent border-0">
                                         <?php
                                                if (!empty($_SESSION['permisos'][MUSUARIOS]['r']) ) {
                                            ?>
                                         <a href="GestionUsuario.php" class="dropdown-item">Usuarios</a>
                                         <?php } 
                                                if (!empty($_SESSION['permisos'][MROLES]['r']) ) {
                                            ?>
                                         <a href="../Formularios/Roles.php" class="dropdown-item">Roles</a>
                                         <?php } 
                                                if (!empty($_SESSION['permisos'][MBITACORA]['r']) ) {
                                            ?>
                                         <!-- <a href="../Formularios/Permisos.php" class="dropdown-item">Permisos</a> -->
                                         <a href="../Formularios/Bitacora.php" class="dropdown-item">Bitácora</a>
                                         <?php } 
                                                if (!empty($_SESSION['permisos'][MPARAMETROS]['r']) ) {
                                            ?>
                                         <a href="../Formularios/Parametros.php" class="dropdown-item">Parámetros</a>
                                         <?php } 
                                                if (!empty($_SESSION['permisos'][MPREGUNTAS]['r']) ) {
                                            ?>
                                         <a href="../Formularios/Preguntas.php" class="dropdown-item">Preguntas</a>
                                         <?php } 
                                                if (!empty($_SESSION['permisos'][MOBJETOS]['r']) ) {
                                            ?>
                                         <a href="../Formularios/Objetos.php" class="dropdown-item">Objetos</a>
                                         
                                         </div>
                                         <?php } ?>
                                     </div>
                                     <?php } ?>

                                     <?php
                                    if (!empty($_SESSION['permisos'][MCARGOS]['r']) || !empty($_SESSION['permisos'][MESTADOvENTA]['r']) || !empty($_SESSION['permisos'][MTIPOPRODUCTO]['r']) || !empty($_SESSION['permisos'][MTALONARIO]['r']) || !empty($_SESSION['permisos'][MCONTACTOPROVEEDORES]['r']) || !empty($_SESSION['permisos'][MCONTACTOCLIENTES]['r'])|| !empty($_SESSION['permisos'][MTIPOCONTACTO]['r'])|| !empty($_SESSION['permisos'][MTIPOMOVIMIENTO]['r'])|| !empty($_SESSION['permisos'][MESTADOPROCESO]['r'])) {

                                    ?>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-screwdriver-wrench"></i></i>MANTENIMIENTO</a>
                                        <div class="dropdown-menu bg-transparent border-0">
                                        <?php
                                                if (!empty($_SESSION['permisos'][MCARGOS]['r']) ) {
                                            ?>
                                            <a href="CargosMM.php" class="dropdown-item">Cargos</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MESTADOvENTA]['r']) ) {
                                            ?>
                                            <a href="EstadoVentaMM.php" class="dropdown-item">Estado de Venta</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MTIPOPRODUCTO]['r']) ) {
                                            ?>
                                            <a href="TipoProductoMM.php" class="dropdown-item">Tipo de Producto</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MTALONARIO]['r']) ) {
                                            ?>
                                            <a href="Talonario.php" class="dropdown-item">Talonario</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MCONTACTOPROVEEDORES]['r']) ) {
                                            ?>
                                            <!--<a href="ContactoProveedorMM.php" class="dropdown-item">Contactos de Proveedores</a>-->
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MCONTACTOCLIENTES]['r']) ) {
                                            ?>
                                            <a href="EspeciesMM.php" class="dropdown-item">Especies</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MTIPOCONTACTO]['r']) ) {
                                            ?>
                                            <a href="TipoContactoMM.php" class="dropdown-item">Tipo de Contacto</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MTIPOMOVIMIENTO]['r']) ) {
                                            ?>
                                            <a href="TipoMovimientoMM.php" class="dropdown-item">Tipo de Movimiento</a>
                                            <?php } 
                                                if (!empty($_SESSION['permisos'][MESTADOPROCESO]['r']) ) {
                                            ?>
                                            <a href="EstadoProcesoMM.php" class="dropdown-item">Estado del Proceso</a>
                                            <?php } 
                                              
                                            ?>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-regular fa-folder-open"></i></i>ADMINISTRACIÓN</a>
                                        <div class="dropdown-menu bg-transparent border-0">                                           
                                            <?php 
                                                if (!empty($_SESSION['permisos'][MBACKUP]['r']) ) {
                                            ?>
                                           <a href="../Formularios/Backup.php" class="dropdown-item">Backup</a>
                                            <?php } 
                                            ?>
                                            <a href="../Formularios/MiPerfil.php" class="dropdown-item">Mi Perfil</a>
                                            <a href="../Formularios/AcercaDe.php" class="dropdown-item">Acerca de</a>                                            
                                        </div>
                                    </div>
                                    <div class="nav-item dropdown">
                                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-file-contract"></i></i>REPORTES</a><i class=""></i>
                                        <div class="dropdown-menu bg-transparent border-0">                                           
                                           <a href="../Formularios/ReporteEspecializado.php" class="dropdown-item">Crear Reporte</a>
                                        </div>
                                    </div>
                                </div>
                            </nav>



                        </div>

            </div>


            <div class="container mt-0" style=" padding-left: 224px; ">
                <div class="row justify-content-center">
                    <div class="col-md-12">