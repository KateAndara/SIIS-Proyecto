<?php
    session_start();
    print_r($_POST);
    if(!isset($_POST['Id_Usuario'])){
        header('Location:../Formularios/Usuarios.php?mensaje=error');
    }
    //Insertar edicion
    include '../config/conexion2.php';
    $Id_Usuario = $_POST['Id_Usuario'];
    $Id_Rol = $_POST['Id_Rol'];
    $Id_Cargo = $_POST['Id_Cargo'];
    $Usuario = $_POST['Usuario'];
    $Nombre = $_POST['Nombre'];
    $Estado = $_POST['Estado'];
    $Contraseña = $_POST['Contraseña'];
    $Fecha_ultima_conexion = $_POST['Fecha_ultima_conexion'];
    $Preguntas_contestadas = $_POST['Preguntas_contestadas'];
    $Primer_ingreso = $_POST['Primer_ingreso'];
    $Fecha_vencimiento = $_POST['Fecha_vencimiento'];
    $DNI = $_POST['DNI'];
    $Correo_Electronico = $_POST['Correo_Electronico'];
    $Creado_por = $_POST['Creado_por'];
    $Fecha_creacion = $_POST['Fecha_creacion'];
    $Modificado_por = $_POST['Modificado_por'];
    $Fecha_modificacion = $_POST['Fecha_modificacion'];

    $sentencia = $conexion->prepare("UPDATE tbl_ms_usuarios SET Id_Rol = ?,Id_Cargo = ?,Usuario = ?, Nombre = ?, Estado = ?, Contraseña = ?, Fecha_ultima_conexion = ?, Preguntas_contestadas = ?, Primer_ingreso = ?, Fecha_vencimiento = ?, DNI = ?, Correo_Electronico = ?, Creado_por = ?, Fecha_creacion = ?, Modificado_por = ?, Fecha_modificacion = ? where Id_Usuario = ?;");
    $resultado = $sentencia->execute([$Id_Rol, $Id_Cargo, $Usuario, $Nombre, $Estado, $Contraseña, $Fecha_ultima_conexion, $Preguntas_contestadas, $Primer_ingreso, $Fecha_vencimiento, $DNI, $Correo_Electronico, $Creado_por, $Fecha_creacion, $Modificado_por, $Fecha_modificacion, $Id_Usuario]);

    if ($resultado === TRUE) {
        header('Location: ../Formularios/Usuarios.php?mensaje=editado');
    } else {
        header('Location: ../Formularios/Usuarios.php?mensaje=error');
        exit();
    }

    //Validaciones para editar usuario 
if (!empty($_POST["btnEditar"])){
  include '../config/conexion2.php';
  $Id_Usuario = $_POST['Id_Usuario'];
  $Id_Rol = $_POST['Id_Rol'];
  $Id_Cargo = $_POST['Id_Cargo'];
  $Usuario = $_POST['Usuario'];
  $Nombre = $_POST['Nombre'];
  $Estado = $_POST['Estado'];
  $Contraseña = $_POST['Contraseña'];
  $Fecha_ultima_conexion = $_POST['Fecha_ultima_conexion'];
  $Preguntas_contestadas = $_POST['Preguntas_contestadas'];
  $Primer_ingreso = $_POST['Primer_ingreso'];
  $Fecha_vencimiento = $_POST['Fecha_vencimiento'];
  $DNI = $_POST['DNI'];
  $Correo_Electronico = $_POST['Correo_Electronico'];
  $Creado_por = $_POST['Creado_por'];
  $Fecha_creacion = $_POST['Fecha_creacion'];
  $Modificado_por = $_POST['Modificado_por'];
  $Fecha_modificacion = $_POST['Fecha_modificacion'];

  $sql=$conexion->query(" select * from tbl_ms_usuarios");
  session_start();
  if ($Usuario=="" ||$Id_Rol=="" ||$Id_Cargo=="" ||$Nombre=="" ||$Estado=="" ||$Preguntas_contestadas=="" ||$Primer_ingreso=="" ||$DNI=="" ||$Correo_Electronico=="" ||$Modificado_por=="" ||$Fecha_modificacion==""){ // Validación de campos vacíos.
    echo '<br>';
    echo '<div class="alert alert-danger">Debe llenar el o los campos vacíos.</div>';
  }else if (strlen($Usuario)> 45){ // Validación de la cantidad de caracteres en el campo Usuario.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Usuario no puede exceder de 45 caracteres.</div>';
  }else if(strpbrk($Usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
  }else if(!ctype_upper($Usuario)){ // Validación de solo mayúsculas en el campo Usuario.
    echo '<br>';
    echo '<div class="alert alert-danger">En el campo usuario solo se permiten mayúsculas.</div>';
  }else if (strlen($Contraseña)<5){ // Validación de la cantidad de caracteres minimo en el campo Contraseña.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Contraseña no puede tener menos de 5 caracteres.</div>';
  }else if (strlen($Contraseña)> 15){ // Validación de la cantidad de caracteres maximo en el campo Contraseña.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Contraseña no puede exceder de 15 caracteres.</div>';
  }else if(strpbrk($Contraseña, " ")){ // Validación de espacios en blanco en el campo Contraseña.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
  }else if (strlen($Nombre)> 45){ // Validación de la cantidad de caracteres en el campo Nombre.
    echo '<br>';
    echo '<div class="alert alert-danger">El campo Nombre no puede exceder de 60 caracteres.</div>';
  }
}
  ?> 