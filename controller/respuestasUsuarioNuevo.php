<?php 
ob_start(); 

require_once("../config/conexion.php");

if (!isset($_SESSION['usuario'])) {
    // Si no hay un usuario en la sesión, redirige al usuario a la página de inicio de sesión
    header("Location: Login.php");
    exit();
}
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
      $id_usuario = $fila["Id_Usuario"]; //Variable que se insertará en el campo requerido en la tabla "tbl_ms_preguntas_usuarios".
    
    // Insertar los datos en la tabla tbl_ms_preguntas_usuarios.
    $sql = "INSERT INTO tbl_ms_preguntas_usuarios (Id_Usuario, Id_Pregunta, Respuesta) VALUES (?, ?, ?)";
    
    if ($stmt = $conexion->prepare($sql)) {
        // Asignar valores a los parámetros
        $stmt->bind_param("iis", $id_usuario, $preguntas, $respuesta);
         // Insertar las respuestas en la tabla.
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
            //Consultar la tabla "tbl_ms_preguntas_usuarios" para verificar que el usuario no vuelva a contestar una pregunta ya contestada.
            $query = "SELECT * FROM tbl_ms_preguntas_usuarios WHERE Id_Pregunta = '$preguntas' AND Id_Usuario='$id_usuario'";
            $resultado = mysqli_query($conexion, $query);

            // Verificar si el usuario está respondiendo una pregunta ya contestada
            if (mysqli_num_rows($resultado) > 0) {
                echo '<br>';
                echo '<div class="alert alert-danger">Usted ya contestó la pregunta seleccionada anteriormente. Por favor, elija otra pregunta.</div> ';
            }else{
                // Se insertan los parámetros de la tabla "tbl_ms_preguntas_usuarios".
                $respuesta = $respuestas;
                $stmt->execute();
                //Se controla el número de preguntas a contestar.
                if ($contador< ($parametroPreguntas-1) && isset($_POST["btnAceptar"])) {
                    //Se incrementa el parámetro que almacena el contador.
                    $siguiente = $contador + 1;
                    // Se envían los parámetros que incrementan al contador.
                    $url = "PreguntasUsuarioNuevo.php?pregunta=".base64_encode(json_encode([$siguiente]));
                    echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
                    echo "Contestada "; 
                    echo "</div>";
                    echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
                    echo "<a href='$url'>";
                    echo "<button class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm'>Siguiente Pregunta</button>";
                    echo "</a>";
                    echo "</div>";
                    echo '<style>#btnAceptar { display:none; }</style>';
                    echo '<style>#fila1 { display:none; }</style>';
                    echo '<style>#respuesta { display:none; }</style>';
                    echo '<style>#preguntas { display:none; }</style>';
                }else if ($contador =($parametroPreguntas) && isset($_POST["btnAceptar"])) { //Si se alcanza el número de preguntas contestadas.

                    header('Location: NuevaContrasenia.php'); // Redireccionamiento a la configuración de una nueva contraseña.
                }

            }
            // Cerrar la sentencia
            $stmt->close();
        }
        }
        
    } else { //Si no se pudo hacer la inserción en la tabla "tbl_ms_preguntas_usuarios".
        echo '<br>';
        echo '<div class="alert alert-danger">No se pudo guardar los cambios.</div> ';
    }
    
    }
    }
ob_end_flush();
?>