<?php 
ob_start(); 

require_once("../config/conexion.php");
session_start();
$usuario = $_SESSION['usuario']; //Almacena la sesión del usuario.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la contraseña del formulario
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
        //VERRR
        $query = "SELECT * FROM tbl_ms_usuarios WHERE Id_Usuario='$id_usuario'";
        $resultado = mysqli_query($conexion, $query);
        

        // Validar que la contraseña cumpla con los requisitos
        if(strpbrk($contrasenia, " ")){ // Validación de espacios en blanco en el campo Contraseña.
            echo '<br>';
            echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
          }else if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{' . $parametroMinContrasenia . ',' . $parametroMaxContrasenia . '}$/', $contrasenia)) {
           // Insertar la contraseña en la tabla tbl_ms_usuarios
           $password=$contrasenia;
             //Bitácora
             $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
             $idusuario = $sql->fetch_object();


             //limpiar datos
             $informacion = json_encode($idusuario, true);
             $posicion = strpos($informacion, ":") + 2;
             $idusuario = substr($informacion, $posicion, -2);
             $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'cambio_contraPS';");
             $idobjeto = $sql->fetch_object();

             // limpiar datos 
             $informacion = json_encode($idobjeto, true);

             $posicion = strpos($informacion, ":") + 2;

             $idobjeto = substr($informacion, $posicion, -2);

             
             $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Contraseña actualizada con éxito','El usuario $usuario cambió la contraseña por medio de preguntas secretas') ");
            //Validar la confirmación de la contraseña.
            if ($confirmar_contrasenia != $password){
                echo '<br>';
                echo '<div class="alert alert-danger">Los campos de contraseña no coinciden.</div> ';
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

                // Realizar la consulta para buscar la contraseña en el historial de contraseñas.
                $query = "SELECT * FROM tbl_ms_hist_contraseña WHERE Contraseña = '$contrasenaEncriptada' AND Id_Usuario='$id_usuario'";
                $resultado = mysqli_query($conexion, $query);

                // Verificar si la contraseña ingresada existe en el historial de contraseñas.
                if (mysqli_num_rows($resultado) > 0) {
                    echo '<br>';
                    echo '<div class="alert alert-danger">Debe ingresar una contraseña que no haya usado anteriormente.</div> ';
                } else {

                $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Contraseña = '$contrasenaEncriptada', Estado = 'Activo' where Id_Usuario='$id_usuario'");

                // Traer el nombre del usuario
                $nombreQuery = $conexion->query("SELECT Nombre FROM tbl_ms_usuarios WHERE Id_Usuario = '$id_usuario'");
                if ($nombreQuery) {
                    $nombreResultado = $nombreQuery->fetch_assoc();
                    $nombre = $nombreResultado['Nombre'];

                    // Obtener la cantidad de contraseñas registradas para el usuario
                    $cantidadContraseñasQuery = $conexion->query("SELECT COUNT(*) AS Total FROM tbl_ms_hist_contraseña WHERE Id_Usuario = '$id_usuario'");
                    if ($cantidadContraseñasQuery) {
                        $cantidadContraseñasResultado = $cantidadContraseñasQuery->fetch_assoc();
                        $cantidadContraseñas = $cantidadContraseñasResultado['Total'];

                        // Si hay 10 contraseñas, eliminar la más antigua
                        if ($cantidadContraseñas >= 10) {
                            $eliminarQuery = $conexion->query("DELETE FROM tbl_ms_hist_contraseña WHERE Id_Usuario = '$id_usuario' ORDER BY Fecha_modificacion ASC LIMIT 1");
                        }

                        // Insertar la nueva contraseña en el historial
                        $insertHistorial = $conexion->query("INSERT INTO tbl_ms_hist_contraseña (Id_Usuario, Contraseña, Modificado_por, Fecha_modificacion) VALUES ('$id_usuario', '$contrasenaEncriptada', '$nombre', CURRENT_TIMESTAMP())");
                    } 
                }

                header('Location: Login.php'); // Redireccionamiento al Login.
                }
          
            }
            
        } else {// Si la contraseña no cumple con los requisitos.
        echo '<br>';
        echo '<div class="alert alert-danger">La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, ' . $parametroMinContrasenia . ' caracteres y máximo ' . $parametroMaxContrasenia . ' caracteres.</div> ';
        //Bitácora
        $sql = $conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$usuario';");
        $idusuario = $sql->fetch_object();


        //limpiar datos
        $informacion = json_encode($idusuario, true);
        $posicion = strpos($informacion, ":") + 2;
        $idusuario = substr($informacion, $posicion, -2);
        $sql = $conexion->query("Select id_objeto from tbl_objetos where Objeto = 'cambio_contraPS';");
        $idobjeto = $sql->fetch_object();

        // limpiar datos 
        $informacion = json_encode($idobjeto, true);

        $posicion = strpos($informacion, ":") + 2;

        $idobjeto = substr($informacion, $posicion, -2);

        echo $idobjeto . ' Usuario:' . $idusuario;
        $sql = $conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de Contraseña erróneo','El usuario $usuario no cumple con los requisitos necesarios para una contraseña segura') ");
    }
    }       
}
   
ob_end_flush();
?>