<?php
ob_start(); 
if (!empty($_POST["btniniciarSesion"])){
    $usuario=$_POST["usuario"];
    $clave=$_POST["password"];
    $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' ");
    session_start();
    $_SESSION['usuario'] = $usuario;

    if ($usuario=="" ||$clave==""){ // Validación de campos vacíos.
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
    }else if (strlen($clave)> 15){ // Validación de la cantidad de caracteres en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede exceder de 15 caracteres.</div>';
    }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
    }else if ($datos=$sql->fetch_object()){ // Los datos ingresados son correctos.
      unset($_SESSION["intentos"]); // Inicio de la Sesión de Intentos.
      $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' and Estado='Activo' ");
        if ($datos=$sql->fetch_object()){ // Si el Usuario está Activo.
          header('Location: inicio.php'); //Acceso al sistema.
          //Bitácora
          $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
          $idusuario = $sql->fetch_object();


          //limpiar datos
          $informacion = json_encode($idusuario, true);
          $posicion = strpos($informacion, ":") + 2;
          $idusuario = substr($informacion, $posicion, -2);
          $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'login';");
          $idobjeto = $sql->fetch_object();

          // limpiar datos 
          $informacion = json_encode($idobjeto, true);

          $posicion = strpos($informacion, ":") + 2;

          $idobjeto = substr($informacion, $posicion, -2);

          echo $idobjeto . ' Usuario:' . $idusuario;
          $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Inicio de Sesión','El usuario $usuario ha ingresado al sistema') ");


        }else{
            $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' and Estado='Nuevo' ");
            if ($datos=$sql->fetch_object()){ // Si el usuario es Nuevo.
          
              header('Location: PreguntasUsuarioNuevo.php'); //Gestión de preguntas del usuario.
              //Bitácora
              $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
              $idusuario = $sql->fetch_object();


             //limpiar datos
             $informacion = json_encode($idusuario, true);
             $posicion = strpos($informacion, ":") + 2;
             $idusuario = substr($informacion, $posicion, -2);
             $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'cambio_contra';");
             $idobjeto = $sql->fetch_object();

             // limpiar datos 
             $informacion = json_encode($idobjeto, true);

             $posicion = strpos($informacion, ":") + 2;

             $idobjeto = substr($informacion, $posicion, -2);

             echo $idobjeto . ' Usuario:' . $idusuario;
             $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de contraseña(Usuario Nuevo)','El usuario $usuario ha cambiado la contraseña') ");

            }else{ // Si el usuario está Bloqueado o Inactivo
              echo '<br>';
              echo '<div class="alert alert-danger">Usuario no activo. Debe solicitar al administrador activarlo.</div>';
            }
        }
    }else{ // Si los datos ingresados no existen en la base de datos.
      echo '<br>';
      echo '<div class="alert alert-danger">Acceso Denegado. Usuario/Contraseña inválidos.</div>';
      // Consulta SQL para obtener el valor del campo "Parametro".
      $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='ADMIN_INTENTOS'"; 
      $resultado = $conexion->query($sql);

      // Recuperar el valor del campo "parametro"
      $parametroIntentos = mysqli_fetch_assoc($resultado)['Valor'];

      $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Estado='Activo' ");
      if ($datos=$sql->fetch_object()){ //Conteo de intentos siendo un usuario Activo.
      
        $max_intentos = $parametroIntentos; //Número máximo de intentos permitidos.
          $intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 1;

         if ($intentos >= $max_intentos) { //Si el usuario supera los intentos permitidos.
             echo "Ha excedido el número máximo de intentos permitidos. Su usuario se ha bloqueado.";
             $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Estado = 'Bloqueado' where Usuario='$usuario' ");
            unset($_SESSION["intentos"]);
           exit;
         }

          //El usuario aún tiene intentos disponibles
          echo "Se ha registrado el intento fallido. Le queda ", $max_intentos - $intentos, " intento/s más.";

          //Incrementar el contador de intentos
          $_SESSION['intentos'] = $intentos + 1;
      }else{
          $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Estado='Nuevo' ");
          if ($datos=$sql->fetch_object()){ //Conteo de intentos siendo un usuario Nuevo.
        
            $max_intentos = $parametroIntentos; //Número máximo de intentos permitidos.
          $intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 1;

         if ($intentos >= $max_intentos) { //Si el usuario supera los intentos permitidos.
             echo "Ha excedido el número máximo de intentos permitidos. Su usuario se ha bloqueado.";
             $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Estado = 'Bloqueado' where Usuario='$usuario' ");
            unset($_SESSION["intentos"]);
           exit;
         }

          //El usuario aún tiene intentos disponibles.
          echo "Se ha registrado el intento fallido. Le queda ", $max_intentos - $intentos, " intento/s más.";

          //Incrementar el contador de intentos
          $_SESSION['intentos'] = $intentos + 1;
          }
      }
        //Bitácora
        $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
        $idusuario = $sql->fetch_object();

        //limpiar datos
        $informacion = json_encode($idusuario, true);
        $posicion = strpos($informacion, ":") + 2;
        $idusuario = substr($informacion, $posicion, -2);
        $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'login';");
        $idobjeto = $sql->fetch_object();

        // limpiar datos 
        $informacion = json_encode($idobjeto, true);

        $posicion = strpos($informacion, ":") + 2;

        $idobjeto = substr($informacion, $posicion, -2);
        $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Inicio de Sesión fallido','El usuario $usuario ha intentado ingresar al sistema') ");
    }
}
  ob_end_flush();



?>