<?php

if (!empty($_POST["btnComprobarUsuario"])){
    $usuario=$_POST["usuario"];    
    $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario'");
    session_start();
    $_SESSION['usuario'] = $usuario;

    if ($usuario=="" ){ // Validación de campos vacíos.
      echo '<br>';
      echo '<div class="alert alert-danger">Debe llenar el o los campos vacíos.</div>';
    }else if (strlen($usuario)> 45){ // Validación de la cantidad de caracteres en el campo Usuario.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Usuario no puede exceder de 45 caracteres.</div>';
    }else if(strpbrk($usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
    }else if(!ctype_upper($usuario)){ // Validación de solo mayúsculas en el campo Usuario.
      echo '<br>';
      echo '<div class="alert alert-danger">En el campo usuario solo se permiten mayúsculas.</div>';
    }
    
    else if ($datos=$sql->fetch_object()){ // Los datos ingresados son correctos.
        header('Location: RecuperacionPreguntas.php');
    }else{ // Si los datos ingresados no existen en la base de datos.
      echo '<br>';
      echo '<div class="alert alert-danger">Acceso Denegado. Usuario inválidos.</div>';  
    }
}
ob_end_flush();
?>