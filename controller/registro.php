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
            $contraseña=$_POST["Clave"];
            $correo=$_POST["Email"];
            $Fecha=date("Y-m-d");
            $estado="Nuevo";
            $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Estado,Contraseña,Correo_Electronico, Fecha_creacion)values('$id_rol','$id_cargo','$usuario','$estado','$contraseña','$correo','$Fecha')");
            if ($sql==1){
                echo '<div class="alert alert-success">Usuario registrado correctamente</div> ';         
              } else {
                echo '<div class="alert alert-danger">Error al ingresar al usuario</div> ';
              }
        }
    
      } 
  }
  
?>