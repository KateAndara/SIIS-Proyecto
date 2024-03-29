<?php
ob_start(); 
if (!empty($_POST["btniniciarSesion"])){
    $usuario=$_POST["usuario"];
    $contrasenia=$_POST["password"];
    $clave = hash('sha256', $contrasenia);
    $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' ");
    session_start();
    $_SESSION['usuario'] = $usuario;
    
    if ($usuario=="" ||$contrasenia==""){ // Validación de campos vacíos.
      echo '<br>';
      echo '<div class="alert alert-danger">Debe llenar el o los campos vacíos.</div>';
    }else if(!ctype_upper($usuario)){ // Validación de solo mayúsculas en el campo Usuario.
      echo '<br>';
      echo '<div class="alert alert-danger">En el campo usuario solo se permiten mayúsculas.</div>';
   }else if(strpbrk($contrasenia, " ")){ // Validación de espacios en blanco en el campo Contraseña.
      echo '<br>';
      echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
    }else if ($datos=$sql->fetch_object()){ // Los datos ingresados son correctos.
      unset($_SESSION["intentos"]); // Inicio de la Sesión de Intentos.
      $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' and Estado='Activo' ");
        if ($datos=$sql->fetch_object()){ // Si el Usuario está Activo.
          // Consulta para obtener los ingresos a partir del nombre de usuario.
          $sqlIngresos = "SELECT * FROM tbl_ms_usuarios WHERE Usuario = '$usuario'";
          $resultado = mysqli_query($conexion, $sqlIngresos);
          
          // Verificar si se encontró el usuario y obtener los ingresos.
          if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $ingresos_actuales = $fila["Primer_ingreso"];
            $ingresos_nuevos = $ingresos_actuales + 1;
            $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Primer_ingreso = '$ingresos_nuevos' where Usuario='$usuario'");
          }

          $fecha_actual = date('Y-m-d H:i:s');
          $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Fecha_ultima_conexion = '$fecha_actual' where Usuario='$usuario'");
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
          $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Inicio de Sesión','El usuario $usuario ha ingresado al sistema') ");
      

        }else{
          $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Contraseña='$clave' and Estado='Nuevo' and Id_Rol !='3' ");
          if ($datos=$sql->fetch_object()){ // Si el usuario es Nuevo y tiene rol asignado.
          
              header('Location: PreguntasUsuarioNuevo.php'); //Gestión de preguntas del usuario.
              //Bitácora
              $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
              $idusuario = $sql->fetch_object();


             //limpiar datos
             $informacion = json_encode($idusuario, true);
             $posicion = strpos($informacion, ":") + 2;
             $idusuario = substr($informacion, $posicion, -2);
             $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'PreguntasSecretas';");
             $idobjeto = $sql->fetch_object();

             // limpiar datos 
             $informacion = json_encode($idobjeto, true);

             $posicion = strpos($informacion, ":") + 2;

             $idobjeto = substr($informacion, $posicion, -2);

             //echo $idobjeto . ' Usuario:' . $idusuario;
             $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Configurar Preguntas Secretas','El usuario $usuario ha configurado sus preguntas secretas') ");

            }else{ // Si el usuario está Bloqueado o Inactivo
              echo '<br>';
              echo '<div class="alert alert-danger">No puede acceder. Por favor, contacte al administrador.</div>';
            }
        }
    }else{ // Si los datos ingresados no existen en la base de datos.
      echo '<br>';

      echo '<div class="alert alert-danger" id="mensaje-error">Acceso Denegado. Usuario/Contraseña inválidos.</div>';
      
      // Consulta SQL para obtener el valor del campo "Parametro".
      $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='ADMIN_INTENTOS'"; 
      $resultado = $conexion->query($sql);

      // Recuperar el valor del campo "parametro"
      $parametroIntentos = mysqli_fetch_assoc($resultado)['Valor'];

      $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Estado='Activo' ");
      if ($datos=$sql->fetch_object()){ //Conteo de intentos siendo un usuario Activo.
      
        $max_intentos = $parametroIntentos; //Número máximo de intentos permitidos.
          $intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 1;

          if ($intentos == $max_intentos) { //Si el usuario alcanza los intentos permitidos.
            echo '<style>#mensaje-error { display:none; }</style>';
            echo '<br>';
            echo '<div class="alert alert-danger" >Ha alcanzado el número máximo de intentos permitidos. Su usuario ha sido bloqueado.</div>';
            $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Estado = 'Bloqueado' where Usuario='$usuario' ");
           unset($_SESSION["intentos"]);
                 //Bitácora
                 $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
                 $idusuario = $sql->fetch_object();
       
       
                 //limpiar datos
                 $informacion = json_encode($idusuario, true);
                 $posicion = strpos($informacion, ":") + 2;
                 $idusuario = substr($informacion, $posicion, -2);
                 $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'bloqueo';");
                 $idobjeto = $sql->fetch_object();
       
                 // limpiar datos 
                 $informacion = json_encode($idobjeto, true);
       
                 $posicion = strpos($informacion, ":") + 2;
       
                 $idobjeto = substr($informacion, $posicion, -2);
      
                 $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Usuario Bloqueado','El usuario $usuario ha sido bloqueado por alcanzar el número máximo de intentos permitidos de ingreso al sistema') ");
       
          exit;
          }
          //Incrementar el contador de intentos
          $_SESSION['intentos'] = $intentos + 1;
      }else{
          $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' and Estado='Nuevo' ");
          if ($datos=$sql->fetch_object()){ //Conteo de intentos siendo un usuario Nuevo.
        
          $max_intentos = $parametroIntentos; //Número máximo de intentos permitidos.
          $intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 1;

          if ($intentos == $max_intentos) { //Si el usuario alcanza los intentos permitidos.
            echo '<style>#mensaje-error { display:none; }</style>';
            echo '<br>';
            echo '<div class="alert alert-danger" >Ha alcanzado el número máximo de intentos permitidos. Su usuario ha sido bloqueado.</div>';
            $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Estado = 'Bloqueado' where Usuario='$usuario' ");
           unset($_SESSION["intentos"]);
     
          exit;
          }
          //Incrementar el contador de intentos
          $_SESSION['intentos'] = $intentos + 1;
          }
      }
        //Bitácora
        $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
        $idusuario = $sql->fetch_object();

        // Solo si el usuario que intentó ingresar existe
        if ($idusuario !== null) {
          // Limpiar datos
          $informacion = json_encode($idusuario, true);
          $posicion = strpos($informacion, ":") + 2;
          $idusuario = substr($informacion, $posicion, -2);
          $sql = $conexion->query("SELECT id_objeto FROM tbl_objetos WHERE Objeto = 'login';");
          $idobjeto = $sql->fetch_object();

          // Limpiar datos 
          $informacion = json_encode($idobjeto, true);
          $posicion = strpos($informacion, ":") + 2;
          $idobjeto = substr($informacion, $posicion, -2);

          // Insertar en la tabla de bitácora 
          $sql = $conexion->query("INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) VALUES ($idusuario, $idobjeto, now(), 'Inicio de Sesión fallido', 'El usuario $usuario ha intentado ingresar al sistema')");
        }
    }
}
  ob_end_flush();

?>