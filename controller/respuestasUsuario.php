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
// Obtener las respuestas del formulario
$preguntas = $_POST['pregunta'];
$respuestas = $_POST['respuesta'];
$contrasenia = $_POST['contraseña'];
$confirmar_contrasenia = $_POST['confirmarcontraseña'];

// Consulta para obtener el ID de usuario a partir del nombre de usuario
$sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = '$usuario'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontró el usuario y obtener el ID
if (mysqli_num_rows($resultado) > 0) {
  $fila = mysqli_fetch_assoc($resultado);
  $id_usuario = $fila["Id_Usuario"];

  // Insertar las respuestas en la tabla tbl_ms_preguntas_usuarios
$sql = "INSERT INTO tbl_ms_preguntas_usuarios (Id_Usuario, Id_Pregunta, Respuesta) VALUES (?, ?, ?)";

if ($stmt = $conexion->prepare($sql)) {
    // Asignar valores a los parámetros
    $stmt->bind_param("iis", $id_usuario, $preguntas, $respuesta);
     // Insertar las respuestas en la tabla.
     //Validaciones del campo Respuesta:

    // Remover cualquier espacio en blanco adicional del campo Respuesta
    $respuestas = preg_replace('/\s+/', ' ', $respuestas); 
    // Eliminar los espacios en blanco al principio y al final del campo Respuesta
    $respuestas = trim($respuestas);

        if (strlen($respuestas)> 100){ // Validación de la cantidad de caracteres en el campo Respuesta.
            echo '<br>';
            echo '<div class="alert alert-danger">El campo Respuesta no puede exceder de 100 caracteres.</div>';  
        }else{
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
} else {
    echo '<br>';
    echo '<div class="alert alert-danger">No se pudo guardar los cambios.</div> ';
}

}
}
ob_end_flush();
?>