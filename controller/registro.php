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
          $patron3 = "/^([a-zA-Z0-9_.\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
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
              $id_rol=mysqli_fetch_assoc($sql2)['Id_Rol']; // Id del rol en la BD
              $id_rol= (int) $id_rol;
              
            } 
            //Condicion para crear el cargo por defecto de los usuarios o selecionarlo
            $sql4=$conexion->query(" select * from tbl_cargos where Nombre_Cargo='$cargo' ");
            if ($datos=$sql4->fetch_object()){
              $sql5=$conexion->query(" select Id_Cargo from tbl_cargos where Nombre_Cargo='$cargo' ");
              $id_cargo=mysqli_fetch_assoc($sql5)['Id_Cargo']; // Id del cargo en la BD
              $id_cargo=(int)$id_cargo;
              
            } 
            
            $parametro="FEC_VENCIMIENTO";
            $sql3=$conexion->query("select Valor from tbl_ms_parametros where Parametro='$parametro'");
            $valor=mysqli_fetch_assoc($sql3)['Valor'];
            $valor=(string)$valor;
            $usuario=$_POST["Usuario"];
            $nombre=$_POST["Nombre"];
            $dni=$_POST["Dni"];
            $contraseña=$_POST["Clave"];
            $correo=$_POST["Email"];
            $Fecha=date("Y-m-d");
            $Fec_vencimiento=date("Y-m-d",strtotime("+30 days"));
            $estado="Nuevo";
            $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Nombre,Estado,Contraseña,Fecha_vencimiento,DNI,Correo_Electronico, Fecha_creacion)values('$id_rol','$id_cargo','$usuario','$nombre','$estado','$contraseña','$Fec_vencimiento','$dni','$correo','$Fecha')");
            if ($sql==1){
                 echo '<div class="alert alert-success">Usuario registrado correctamente</div> ';
                 //Bitácora
                 $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
                 $idusuario = $sql->fetch_object();


                 //limpiar datos
                 $informacion = json_encode($idusuario, true);
                 $posicion = strpos($informacion, ":") + 2;
                 $idusuario = substr($informacion, $posicion, -2);
                 $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'autoregistro';");
                 $idobjeto = $sql->fetch_object();

                 // limpiar datos 
                 $informacion = json_encode($idobjeto, true);

                 $posicion = strpos($informacion, ":") + 2;

                 $idobjeto = substr($informacion, $posicion, -2);

                 echo $idobjeto . ' Usuario:' . $idusuario;
                 $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Autoregistro','Se ha autoregistrado el Usuario $usuario') ");

               
              } else {
                echo '<div class="alert alert-danger">Error al ingresar al usuario</div> ';
              }

              
        }
    
      } 
  }
  
?>