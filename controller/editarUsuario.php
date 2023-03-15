<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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