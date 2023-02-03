<?php
if (!empty($_POST["btniniciarSesion"])){
	if (empty($_POST["usuario"])and empty($_POST["password"])){
    echo '<br>';
		echo '<div class="alert alert-danger">Debe llenar el o los campos vacios.</div>';
	
	}else{
    $usuario=$_POST["usuario"];
    $clave=$_POST["password"];
    $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' ");
    if ($datos=$sql->fetch_object()){
      header('Location: inicio.html');
    }else{
      echo '<br>';
      echo '<div class="alert alert-danger">Acceso Denegado. Usuario/Contraseña inválidos.</div>';
    }

  }
}

?>