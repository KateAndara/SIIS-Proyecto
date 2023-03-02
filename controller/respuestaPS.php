<?php 
ob_start(); 

require_once("../config/conexion.php");
session_start();

$usuario = $_SESSION['usuario']; //Almacena la sesión del usuario.


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener las preguntas y respuestas del formulario.
    $preguntas = $_POST['pregunta'];
    $respuestas = $_POST['respuesta'];
    
    // Consulta para obtener el ID de usuario a partir del nombre de usuario.
    $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = '$usuario'";
    $resultado = mysqli_query($conexion, $sql);
    
    // Verificar si se encontró el usuario y obtener el ID
    if (mysqli_num_rows($resultado) > 0) {
      $fila = mysqli_fetch_assoc($resultado);
      $id_usuario = $fila["Id_Usuario"]; //Variable para verificar el usuario.
    
      //Validaciones del campo Respuesta:
    
        // Validación de solo un espacio entre cada palabra del campo de la respuesta.
        if (preg_match('/\s{2,}/', $respuestas)) {
            echo '<br>';
            echo '<div class="alert alert-danger">El campo Respuesta no puede contener más de un espacio entre cada palabra.</div>'; 
        } else {
            // Eliminar los espacios en blanco al principio y al final del campo Respuesta
            $respuestas = trim($respuestas);
    
            if (strlen($respuestas)> 100){ // Validación de la cantidad de caracteres en el campo Respuesta definido en la base de datos.
                echo '<br>';
                echo '<div class="alert alert-danger">El campo Respuesta no puede exceder de 100 caracteres.</div>';  
            }else{
                //Consultar la tabla "tbl_ms_preguntas_usuarios" para verificar que la pregunta seleccionada sea una pregunta configurada.
                $query = "SELECT Id_Pregunta FROM tbl_ms_preguntas_usuarios WHERE Id_Usuario='$id_usuario' AND Id_Pregunta = '$preguntas'";
                $resultado = mysqli_query($conexion, $query);

                // Si la pregunta seleccionada es una pregunta configurada.
                if (mysqli_num_rows($resultado) > 0) {
                    //Consultar la tabla "tbl_ms_preguntas_usuarios" para verificar que la respuesta es correcta.
                    $query = "SELECT * FROM tbl_ms_preguntas_usuarios WHERE Id_Usuario='$id_usuario' AND Id_Pregunta = '$preguntas' AND Respuesta='$respuestas'";
                    $resultado = mysqli_query($conexion, $query);

                    // Si la respuesta es correcta.
                    if (mysqli_num_rows($resultado) > 0) {
                        //Se controla el número de preguntas a contestar.
                        if ($contador=0 && isset($_POST["btnValidarRespuesta"])) {
                            //Se incrementa el parámetro que almacena el contador.
                            $contador = $contador + 1;
                        }else if ($contador =1 && isset($_POST["btnValidarRespuesta"])) { //Si se alcanza el número de preguntas contestadas.

                            header('Location: ../Formularios/RecuperacionContraseniaPS.php'); // Redireccionamiento a la configuración de una nueva contraseña.
                        } 
                    }else{
                        echo '<style>#btnValidarRespuesta { display:none; }</style>';
                        echo '<br>';
                        echo '<div class="alert alert-danger">Intento de recuperación de contraseña fallido. Su usuario se ha bloqueado. Contacte al administrador.</div>';  
                        $sql=$conexion->query(" UPDATE tbl_ms_usuarios SET Estado = 'Bloqueado' where Usuario='$usuario' ");
                        echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
                        echo "<a href='http://localhost/SIIS-PROYECTO/Formularios/index.html'>";
                        echo "<button class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm'>Ir a la página principal</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                }else{
                    echo '<br>';
                    echo '<div class="alert alert-danger">La pregunta seleccionada no ha sido configurada. Elija una pregunta que ya haya configurado anteriormente.</div>'; 
                }
            }
        }
    }
}
ob_end_flush();
?>