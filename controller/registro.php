<?php
 
  
  if (!empty($_POST["btnRegistrar"])){
       if (empty($_POST["Usuario"]) or empty($_POST["Clave"]) or empty($_POST["Confirmacion"])) {
           echo '<div class="alert alert-danger">Uno de los campos esta vacio</div> ';
       } elseif ($_POST["Clave"] != $_POST["Confirmacion"]){
           echo '<div class="alert alert-danger">Los campos de contraseña no coinciden</div> ';
       } else {
        $usuario=$_POST["Usuario"];
        $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este nombre de usuario ya existe</div> ';
        }else{
            $rol=1;  // Rol agregado manualmente a la base de datos porque todavia no ejecuto una funcion para primer usuario
            $cargo=1; // Cargo agregado manualmente a la bd porque todavia no ejecuto una funcion para primer usuario
            $usuario=$_POST["Usuario"];
            $contraseña=$_POST["Clave"];
            $correo=$_POST["Email"];
            $Fecha=date("Y-m-d");
            $estado="Nuevo";
            $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Estado,Contraseña,Correo_Electronico, Fecha_creacion)values('$rol','$cargo','$usuario','$estado','$contraseña','$correo','$Fecha')");
            if ($sql==1){
                echo '<div class="alert alert-success">Usuario registrado correctamente</div> ';         
              } else {
                echo '<div class="alert alert-danger">Error al ingresar al usuario</div> ';
              }
        }
    
      } 
  }
  
?>