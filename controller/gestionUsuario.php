@@ -0,0 +1,42 @@
<?php
ob_start(); 
//Validaciones para crear usuario
if (!empty($_POST["btnResetear"])){
    $usuario=$_POST["Usuario"];
    $nombre=$_POST["Nombre"];
    $email=$_POST["Email"];
    $clave=$_POST["Clave"];


    $sql=$conexion->query(" select * from tbl_ms_usuarios");
    session_start();
    if ($usuario=="" ||$nombre=="" ||$email=="" ||$clave==""){ // Validación de campos vacíos.
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
    }else if (strlen($clave)<5){ // Validación de la cantidad de caracteres minimo en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede tener menos de 5 caracteres.</div>';
    }else if (strlen($clave)> 15){ // Validación de la cantidad de caracteres maximo en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede exceder de 15 caracteres.</div>';
    }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
    }else if (strlen($nombre)> 45){ // Validación de la cantidad de caracteres en el campo Nombre.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Nombre no puede exceder de 60 caracteres.</div>';
    }
    
}
  ob_end_flush();
?>
