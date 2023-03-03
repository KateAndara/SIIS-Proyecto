<?php 
ob_start(); 

require_once("../config/conexion.php");

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige al usuario a la página de inicio de sesión
    header("Location: Login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la contraseña del formulario
    $contraseniaActual=$_POST['contraseñaActual'];
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

        // Realizar la consulta para buscar la contraseña actual.
        $query = "SELECT * FROM tbl_ms_usuarios WHERE Contraseña ='$contraseniaActual' AND Id_Usuario='$id_usuario'";
        $resultado = mysqli_query($conexion, $query);
        // Verificar si se encontró la misma contraseña actual del usuario.
        if (mysqli_num_rows($resultado) > 0) {
            // Validar que la contraseña cumpla con los requisitos
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{' . $parametroMinContrasenia . ',' . $parametroMaxContrasenia . '}$/', $contrasenia)) {
                // Insertar la contraseña en la tabla tbl_ms_usuarios
                $password=$contrasenia;

                //Validar la confirmación de la contraseña.
                if ($confirmar_contrasenia != $password){
                    echo '<br>';
                    echo '<div class="alert alert-danger">Los campos de contraseña no coinciden.</div> ';
                }else{
                    // Escapar los caracteres especiales de la contraseña.
                    $password = mysqli_real_escape_string($conexion, $password);

                    // Realizar la consulta para buscar la contraseña.
                    $query = "SELECT * FROM tbl_ms_usuarios WHERE Contraseña = '$password' AND Id_Usuario='$id_usuario'";
                    $resultado = mysqli_query($conexion, $query);

                    // Verificar si se encontró la misma contraseña del usuario.
                    if (mysqli_num_rows($resultado) > 0) {
                        echo '<br>';
                        echo '<div class="alert alert-danger">La nueva contraseña debe ser diferente a la actual.</div> ';
                    } else {
                        //traer la información del usuario.
                        $sql=$conexion->query(" SELECT * FROM tbl_ms_usuarios WHERE Id_Usuario='$id_usuario' ");
                        //Actualizar la contraseña y el estado del usuario.
                        $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Contraseña = '$password', Estado = 'Activo' where Id_Usuario='$id_usuario'");
                        header('Location: Login.php'); // Redireccionamiento al Login.
                    }
                }
            } else { // Si la contraseña no cumple con los requisitos.
            echo '<br>';
            echo '<div class="alert alert-danger">La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un carácter especial, un número, ' . $parametroMinContrasenia . ' caracteres y máximo ' . $parametroMaxContrasenia . ' caracteres.</div> ';
            }
        } else { //Contraseña actual ingresada incorrecta.
            echo '<br>';
            echo '<div class="alert alert-danger">La contraseña actual es incorrecta.</div> ';
        }
    }
}
ob_end_flush();
?>