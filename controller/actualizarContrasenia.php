<?php 
ob_start(); 
require_once("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos.

    #obetener datos :33333
    # Consulto el id Usuario
    $consulta_Id="SELECT Id_Usuario FROM tbl_ms_bitacora ORDER by Id_bitacora DESC LIMIT 1";
    $resultado_Id=mysqli_query( $conexion , $consulta_Id);
    while ($otra_=mysqli_fetch_array( $resultado_Id )) {
        # code...
        $id=$otra_['Id_Usuario'];
    }
    #obener nombre usuario
    $consulta_name="SELECT Usuario FROM tbl_ms_usuarios where Id_Usuario = '$id'";
    $resultado_name=mysqli_query( $conexion , $consulta_name);
    while ($_otra_=mysqli_fetch_array( $resultado_name )) {
        # code...
        $nombre=$_otra_['Usuario'];
    }

    $usuario = $nombre;
    $contrasenia = $_POST['contraseña'];
    $confirmar_contrasenia = $_POST['confirmarcontraseña'];

    // Consulta para obtener el ID de usuario a partir del nombre de usuario
    $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si se encontró el usuario y obtener el ID
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $id_usuario = $fila["Id_Usuario"];

        // Consulta SQL para obtener el valor del campo "Parametro" para administrar el número máximo de caracteres de la contraseña.
        $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='MAX_CONTRASENIA'"; 
        $resultado = $conexion->query($sql);

        // Recuperar el valor del campo "parametro"
        $parametroMaxContrasenia = mysqli_fetch_assoc($resultado)['Valor'];

        // Consulta SQL para obtener el valor del campo "Parametro" para administrar el número mínimo de caracteres de la contraseña.
        $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='MIN_CONTRASENIA'"; 
        $resultado = $conexion->query($sql);

        // Recuperar el valor del campo "parametro"
        $parametroMinContrasenia = mysqli_fetch_assoc($resultado)['Valor'];

        if(strpbrk($contrasenia, " ")){ // Validación de espacios en blanco en el campo Contraseña.
            echo '<br>';
            echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
            ?>
                  <script> 
                     alert("El campo Contraseña no puede contener espacios en blanco.");
                     location.href= "../Formularios/CambiarContrasenia.php";
                  </SCRipt><?php
          }else if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{' . $parametroMinContrasenia . ',' . $parametroMaxContrasenia . '}$/', $contrasenia)) { //Validar los otros requisitos.
          
              $password=$contrasenia;

              //Validar la confirmación de la contraseña.
              if ($confirmar_contrasenia != $password){
                  echo '<br>';
                  echo '<div class="alert alert-danger">Los campos de contraseña no coinciden.</div> ';
                  ?>
                  <script> 
                     alert("Los campos de contraseña no coinciden.");
                     location.href= "../Formularios/CambiarContrasenia.php";
                  </SCRipt><?php
              }else{
                  // Escapar los caracteres especiales de la contraseña.
                  $password = mysqli_real_escape_string($conexion, $password);
                  // Función pra encriptar contraseña
                    function encriptar($pass) {
                        $Encriptada = hash('sha256', $pass);
                        return $Encriptada;
                    }
                    //Variable que almacena la contraseña encriptada
                    $contrasenaEncriptada = encriptar($password);

                  // Realizar la consulta para buscar la contraseña.
                  $query = "SELECT * FROM tbl_ms_usuarios WHERE Contraseña = '$contrasenaEncriptada' AND Id_Usuario='$id_usuario'";
                  $resultado = mysqli_query($conexion, $query);

                  // Verificar si se encontró la misma contraseña del usuario.
                  if (mysqli_num_rows($resultado) > 0) {
                      echo '<br>';
                      echo '<div class="alert alert-danger">Debe ingresar una contraseña que no haya usado anteriormente.</div> ';
                      ?>
                      <script> 
                         alert("Debe ingresar una contraseña que no haya usado anteriormente.");
                         location.href= "../Formularios/CambiarContrasenia.php";
                      </SCRipt><?php
                  } else {
                      //traer la información del usuario.
                      $sql=$conexion->query(" SELECT * FROM tbl_ms_usuarios WHERE Id_Usuario='$id_usuario' ");
                      //Actualizar la contraseña y el estado del usuario.
                      $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Contraseña = '$contrasenaEncriptada', Estado = 'Activo' where Id_Usuario='$id_usuario'");
                      //header('Location: Login.php'); // Redireccionamiento al Login.
                      ?>
                      <script> 
                         alert("Contraseña actualizada con éxito.");
                         location.href= "../Formularios/Login.php";
                      </SCRipt><?php
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
                   $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Contraseña actualizada con éxito','El usuario $usuario ha cambiado su contraseña') ");
                                      
                  }
              }
          } else { // Si la contraseña no cumple con los requisitos.
            ?>
            <script> 
               alert("La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, 8 caracteres y máximo 15 caracteres");
               location.href= "../Formularios/CambiarContrasenia.php";
            </SCRipt><?php
         // echo '<br>';
         // echo '<div class="alert alert-danger">La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, ' . $parametroMinContrasenia . ' caracteres y máximo ' . $parametroMaxContrasenia . ' caracteres.</div> ';
          }
}
}
ob_end_flush();
?>