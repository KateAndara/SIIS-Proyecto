<?php
 
  
  if (!empty($_POST["btnRegistrar"])){
       // Validación de campos vacios 
       if (empty($_POST["Usuario"]) or empty($_POST["Nombre"]) or empty($_POST["Dni"]) or empty($_POST["Clave"]) or empty($_POST["Confirmacion"]) or empty($_POST["Email"])) {
           echo '<div class="alert alert-danger">Uno de los campos esta vacio</div> ';
       } elseif ($_POST["Clave"] != $_POST["Confirmacion"]){
           echo '<div class="alert alert-danger">Los campos de contraseña no coinciden</div> ';
       } else {
        $usuario=$_POST["Usuario"];
        $clave=$_POST["Clave"];
        $nombre=$_POST["Nombre"];
        $dni=$_POST["Dni"];
        $email=$_POST["Email"];
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
        $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este nombre de usuario ya existe</div> ';
        }else if(strpbrk($usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
        }else if(!ctype_upper($usuario)){ // Validación de solo mayúsculas en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">En el campo usuario solo se permiten mayúsculas.</div>';
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

            $rol="DEFAULT";  
            $cargo="Empleado";
            //Condicion para crear el rol por defecto de los usuarios o selecionarlo
            $sql1=$conexion->query(" select * from tbl_ms_roles where Rol='$rol' ");
            if ($datos=$sql1->fetch_object()){
              $sql2=$conexion->query(" select Id_Rol from tbl_ms_roles where Rol='$rol' ");
              $id_rol=mysqli_fetch_assoc($sql2); // Id del rol en la BD
              $id_rol= (int) $id_rol;
            } else {
              $sql2=$conexion -> query("insert into tbl_ms_roles(Rol,Descripcion)values('$rol','Rol por defecto')");
              $sql3=$conexion->query(" select Id_Rol from tbl_ms_roles where Rol='$rol' ");
              $id_rol=mysqli_fetch_assoc($sql3);  // Id del rol en la BD
              $id_rol= (int) $id_rol;
            }
            //Condicion para crear el cargo por defecto de los usuarios o selecionarlo
            $sql4=$conexion->query(" select * from tbl_cargos where Nombre_Cargo='$cargo' ");
            if ($datos=$sql4->fetch_object()){
              $sql5=$conexion->query(" select Id_Cargo from tbl_cargos where Nombre_Cargo='$cargo' ");
              $id_cargo=mysqli_fetch_assoc($sql5); // Id del cargo en la BD
              $id_cargo=(int)$id_cargo;
              
            } else {
              $sql5=$conexion -> query("insert into tbl_cargos(Nombre_Cargo)values('$cargo')");
              $sql6=$conexion->query(" select Id_Cargo from tbl_cargos where Nombre_Cargo='$cargo' ");
              $id_cargo=mysqli_fetch_assoc($sql6); // Id del cargo en la BD
              $id_cargo=(int)$id_cargo;
            }

            $usuario=$_POST["Usuario"];
            $nombre=$_POST["Nombre"];
            $dni=$_POST["Dni"];
            $contraseña=$_POST["Clave"];
            $correo=$_POST["Email"];
            $Fecha=date("Y-m-d");
            $estado="Nuevo";
            $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Nombre,Estado,Contraseña,DNI,Correo_Electronico, Fecha_creacion)values('$id_rol','$id_cargo','$usuario','$nombre','$estado','$contraseña','$dni','$correo','$Fecha')");
            if ($sql==1){
        
                 $slq7=$conexion->query(" select Id_Usuario from tbl_ms_usuarios where Usuario='$usuario' ");
                 $id_usuario=mysqli_fetch_assoc($slq7)['Id_Usuario'];
                 $id_usuario=(int)$id_usuario;
                 $fec_vencimiento=date("Y-m-d",strtotime("+ 1 month"));
                 $sql8=$conexion->query("insert into tbl_ms_parametros(Id_Usuario,Parametro,Valor,Fecha_creacion)Values('$id_usuario','FEC_VENCIMIENTO','$fec_vencimiento','$Fecha')");
                 echo '<div class="alert alert-success">Usuario registrado correctamente</div> ';
               
              } else {
                echo '<div class="alert alert-danger">Error al ingresar al usuario</div> ';
              }

              
        }
    
      } 
  }
  
?>