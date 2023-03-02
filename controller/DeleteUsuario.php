<?php
    if(!isset($_GET['Id_Usuario'])){
        header('Location:../Formularios/GestionUsuarios.php?mensaje=error');
        exit();
    }

    include '../config/conexion2.php';
    $Id_Usuario = $_GET['Id_Usuario'];

    $sentencia = $conexion->prepare("DELETE FROM tbl_ms_usuarios where Id_Usuario = ?;");
    $resultado = $sentencia->execute([$Id_Usuario]);

    if ($resultado === TRUE) {
        header('Location:../Formularios/GestionUsuarios.php?mensaje=eliminado');
    } else {
        header('Location:../Formularios/GestionUsuarios.php?mensaje=error');
    }
?>

      