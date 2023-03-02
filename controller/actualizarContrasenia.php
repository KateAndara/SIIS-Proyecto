<?php 
ob_start(); 

require_once("../config/conexion.php");
//require_once('Formularios/CambiarContrasenia.php');
//require_once('token/Token.php');




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario =  $_SESSION['usuario'];

    // Obtener las respuestas del formulario
    $contrasenia = $_POST['contraseña'];
    $confirmar_contrasenia = $_POST['confirmarcontraseña'];

    //Consulta para obtener el ID de usuario a partir del nombre de usuario
    $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se encontró el usuario y obtener el ID
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $id_usuario = $fila["Id_Usuario"];


        // Validar que la contraseña cumpla con los requisitos
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,15}$/', $contrasenia)) {
            // Insertar la contraseña en la tabla tbl_ms_usuarios
           $password=$contrasenia;
           if ($confirmar_contrasenia != $password){
               echo '<br>';
               echo '<div class="alert alert-danger">Los campos de contraseña no coinciden.</div> ';
           }else{

           // Escapar los caracteres especiales de la contraseña
           $password = mysqli_real_escape_string($conexion, $password);

           // Realizar la consulta para buscar la contraseña
           $query = "SELECT * FROM tbl_ms_usuarios WHERE Contraseña = '$password' AND Id_Usuario='$id_usuario'";
           $resultado = mysqli_query($conexion, $query);

                  // Verificar si se encontró la misma contraseña del usuario.
                  if (mysqli_num_rows($resultado) > 0) {
                      echo '<br>';
                      echo '<div class="alert alert-danger">Debe ingresar una contraseña que no haya usado anteriormente.</div> ';
                  } else {
                      //traer la información del usuario.
                      $sql=$conexion->query(" SELECT * FROM tbl_ms_usuarios WHERE Id_Usuario='$id_usuario' ");
                      //Actualizar la contraseña y el estado del usuario.
                      $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Contraseña = '$password', Estado = 'Activo' where Id_Usuario='$id_usuario'");
                      //Bitácora
                    $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
                    $idusuario = $sql->fetch_object();


                    //limpiar datos
                    $informacion = json_encode($idusuario, true);
                    $posicion = strpos($informacion, ":") + 2;
                    $idusuario = substr($informacion, $posicion, -2);
                    $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'cambio_contraC';");
                    $idobjeto = $sql->fetch_object();

                    // limpiar datos 
                    $informacion = json_encode($idobjeto, true);

                    $posicion = strpos($informacion, ":") + 2;

                    $idobjeto = substr($informacion, $posicion, -2);

                    echo $idobjeto . ' Usuario:' . $idusuario;
                    $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de Contraseña exitoso','El usuario $usuario cambió la contraseña') ");
                      header('Location: Login.php'); // Redireccionamiento al Login.
                  }
              }
          } else { // Si la contraseña no cumple con los requisitos.
          echo '<br>';
          echo '<div class="alert alert-danger">La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, ' . $parametroMinContrasenia . ' caracteres y máximo ' . $parametroMaxContrasenia . ' caracteres.</div> ';
          //Bitácora
          $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
          $idusuario = $sql->fetch_object();


          //limpiar datos
          $informacion = json_encode($idusuario, true);
          $posicion = strpos($informacion, ":") + 2;
          $idusuario = substr($informacion, $posicion, -2);
          $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'cambio_contraC';");
          $idobjeto = $sql->fetch_object();

          // limpiar datos 
          $informacion = json_encode($idobjeto, true);

          $posicion = strpos($informacion, ":") + 2;

          $idobjeto = substr($informacion, $posicion, -2);

          //echo $idobjeto . ' Usuario:' . $idusuario;
          $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de Contraseña erróneo','El usuario $usuario no cumple con los requisitos necesarios para una contraseña segura') ");
          }
}
           // Verificar si se encontró la misma contraseña del usuario
           if (mysqli_num_rows($resultado) > 0) {
               echo '<br>';
               echo '<div class="alert alert-danger">La nueva contraseña debe ser diferente a la anterior.</div> ';
           } else {
               //traer la información del usuario
               $sql=$conexion->query(" SELECT * FROM tbl_ms_usuarios WHERE Id_Usuario='$id_usuario' ");
               //Actualizar la contraseña y el estado del usuario
               $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Contraseña = '$password', Estado = 'Activo' where Id_Usuario='$id_usuario'");
               $respuesta = $respuestas;
               $stmt->execute();
               // Cerrar la sentencia
               $stmt->close();
               header('Location: Login.php'); // Redireccionamiento al Login.
           }
           }
       } else {
           echo '<br>';
           echo '<div class="alert alert-danger">La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, 8 caracteres y máximo 15 caracteres.</div> ';
       }
    }
}

ob_end_flush();
?>