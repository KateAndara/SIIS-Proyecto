<?php
    require('../config/conexion.php');
    session_start();
    $varsesion = $_SESSION['usuario'];

    //Bitácora
    $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$varsesion';");
     $idusuario = $sql->fetch_object();


     //limpiar datos
     $informacion = json_encode($idusuario, true);
     $posicion = strpos($informacion, ":") + 2;
     $idusuario = substr($informacion, $posicion, -2);
    $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'log_out';");
    $idobjeto = $sql->fetch_object();

    // limpiar datos 
    $informacion = json_encode($idobjeto, true);

     $posicion = strpos($informacion, ":") + 2;

     $idobjeto = substr($informacion, $posicion, -2);

     $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cierre de Sesión','El usuario $varsesion ha cerrado sesión') ");


     session_destroy();
    session_destroy();
    header("location: index.html");

?>