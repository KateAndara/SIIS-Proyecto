<?php
if (empty($_POST["usuario"])and empty($_POST["password"])){
	}else{
    $usuario=$_POST["usuario"];
    $clave=$_POST["password"];
    $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' ");
    if ($datos=$sql->fetch_object()){  
      $sql=$conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
      $idusuario=$sql->fetch_object();


      //limpiar datos
      $informacion = json_encode($idusuario,true); 
      $posicion =  strpos($informacion, ":") + 2;
      $idusuario =  substr($informacion, $posicion, -2);
      $sql=$conexion->query("Select id_objeto from tbl_objetos where Objeto = 'login';");
      $idobjeto=$sql->fetch_object();

      // limpiar datos 
      $informacion = json_encode($idobjeto,true);
     
      $posicion =  strpos($informacion, ":") + 2;
     
      $idobjeto =  substr($informacion, $posicion, -2);

      echo $idobjeto.' Usuario:'.$idusuario;
      $sql=$conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Inicio de sesión','El usuario $usuario ha ingresado al sistema') ");
      
    }else{
      $sql=$conexion->query("Select Id_Usuario from tbl_ms_usuarios where Usuario = '$usuario';");
      $Id_Usuario=$sql->fetch_object();
      
      // limpiar datos 
      $informacion = json_encode($Id_Usuario,true);
            
      $posicion =  strpos($informacion, ":") + 2;

      $Id_Usuario =  substr($informacion, $posicion, -2);
      $sql=$conexion->query("Select id_objeto from tbl_objetos where Objeto = 'login';");
      $idobjeto=$sql->fetch_object();
      $informacion = json_encode($idobjeto,true);
     
      $posicion =  strpos($informacion, ":") + 2;
     
      $idobjeto =  substr($informacion, $posicion, -2);
      $sql=$conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($Id_Usuario,$idobjeto,now(),'Inicio de sesión fallido','El usuario $usuario ha intentado ingresar al sistema') ");

    }

  }

?>