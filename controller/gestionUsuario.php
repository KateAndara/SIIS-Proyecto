<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  if (!empty($_POST["btnRegistrar"])){
       // Validación de campos vacios 
       if (empty($_POST["Usuario"]) or empty($_POST["Nombre"]) or empty($_POST["Dni"]) or empty($_POST["Clave"]) or empty($_POST["Confirmacion"]) or empty($_POST["Email"])) {
           echo '<div class="alert alert-danger">Uno de los campos esta vacio</div> ';
       } elseif ($_POST["Clave"] != $_POST["Confirmacion"]){
           echo '<div class="alert alert-danger">Los campos de contraseña no coinciden</div> ';
       } else {
        $usuario=strtoupper($_POST["Usuario"]);
        $clave=$_POST["Clave"];
        $nombre=strtoupper($_POST["Nombre"]);
        $dni=$_POST["Dni"];
        $email=$_POST["Email"];
        $rol=$_POST["Rol"];
        $estado='Nuevo';
        $Fecha=date("Y-m-d");

        $creadop = $_SESSION['usuario'];


        $id_cargo=1;
        $id_rol = $_POST["Rol"];
        $contrasena = $_POST["Clave"];
        $correo = $_POST["Email"];

 
        $parametro = $_POST["fecha_v"];


        

        //Función para validar el campo de nombre
        function valnombre($nombre) {    
          $patron = "/^[a-zA-Z \d]*$/";
          if(preg_match($patron, $nombre)) {
              return true;
          }else{
              return false;
          }
        }
        //Función para validar el campo dni
        function valdni($dni) {         
          $patron2 = "/^[0-9-\d]*$/";
          if(preg_match($patron2, $dni)) {
              return true;
          }else{
              return false;
          }
        } 
        //Función para validar el campo email
        function valcorreo($email){      
          $patron3 = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
          if(preg_match($patron3, $email)) {
              return true;
          }else{
              return false;
          }
        }
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

        //Validar las listas desplegables 
        if ($estado== ""){
            array_push($campos, "Selecciona un estado");
       }

        $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este nombre de usuario ya existe</div> ';
        }else if(strpbrk($usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
        }else if(valnombre($nombre)==false){ // Validación de solo texto en el campo nombre.
          echo '<br>';
          echo '<div class="alert alert-danger">El nombre del usuario debe contener solo texto.</div>';
        }else if(valdni($dni)==false){ // Validación de solo numeros en el campo del dni.
          echo '<br>';
          echo '<div class="alert alert-danger">El dni solo debe tener números y guión</div>';
        }else if(valcorreo($email)==false){ // Validación del campo del correo con @ y punto.
          echo '<br>';
          echo '<div class="alert alert-danger">El correo electrónico debe llevar una @ y un dominio(.com,.es,etc)</div>';
        }else if(valcontraseña($clave)==false){ // Validación del campo del correo con @ y punto.
          echo '<br>';
          echo '<div class="alert alert-danger">La contraseña debe tener minimo 1 carácter en mayúscula, minúscula y un carácter númerico </div>';
        }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
        }else{
          $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Nombre,Estado,Contraseña,DNI,Correo_Electronico, Fecha_creacion, Creado_por, Fecha_vencimiento)values('$id_rol','$id_cargo','$usuario','$nombre','$estado','$contrasena','$dni','$correo','$Fecha', '$creadop', '$parametro')");
          echo '<br>';
          echo '<div class="alert alert-success">El Usuario se creo correctamente.</div>';
        }

      //insertar datos en la tabla 

    
      } 
  }
  
?>