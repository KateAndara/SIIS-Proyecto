<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="../JS/script.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Preguntas-Usuario Nuevo</title>
</head>

<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 35rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="d-flex justify-content-center">
    <label for='titulo'>Debe configurar las preguntas de seguridad para luego agregar una nueva contraseña.</label><br>
    </div>
    <br>
    <div class="container">
      <form class="form-horizontal" action="" method="post">

            <?php session_start();
            if (!isset($_SESSION['usuario'])) {
                // Si no hay un usuario en la sesión, redirige al usuario a la página de inicio de sesión
                header("Location: Login.php");
                exit();
            }
            $usuario = $_SESSION['usuario']; // Almacena la sesión del usuario.

            require_once("../config/conexion.php");
            
          
            if(isset($_GET['pregunta'])) { // Decodificar los parámetros enviados a este formulario después de haber respondido la pregunta.
              $parametro= json_decode(base64_decode($_GET['pregunta'])); // Recibe el número de preguntas contestadas.
               // Contador de las preguntas contestadas.
              $contador = $parametro[0];
            }else{ // Si no se ha respondido ni una pregunta, el contador es igual a 0.
                $contador = isset($_GET["pregunta"]) ? $_GET["pregunta"] : 0;
            }
            // Consulta SQL para obtener el valor del campo "Parametro" para administrar el número de preguntas a responder.
            $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='ADMIN_PREGUNTAS'"; 
            $resultado = $conexion->query($sql);

            // Almacena el valor del campo "Parametro".
            $parametroPreguntas = mysqli_fetch_assoc($resultado)['Valor'];

            // Consultar los datos de la tabla "tbl_ms_preguntas" para mostrar las preguntas en el formulario.
            $sql = "SELECT Id_Pregunta, Pregunta FROM tbl_ms_preguntas"; 
            $resultado = $conexion->query($sql);

            // Formulario para ingresar las respuestas
            echo "<form method='post'>";
            echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
            echo "Pregunta " . $contador+1, "/". $parametroPreguntas; // Indica el número de pregunta a contestar. 
            echo "</div>";
            echo "<br>";
            echo "<span id='fila1'>Seleccione una pregunta:</span>";
            echo "<select class=' form-select form-control bg-light' name='pregunta' id='preguntas'>";

            // Recorrer los resultados de la consulta y generar una opción para cada pregunta.
            if ($resultado->num_rows > 0) {
              while ($fila = $resultado->fetch_assoc()) {
                $id_pregunta = $fila["Id_Pregunta"];
                $pregunta = $fila["Pregunta"];
                echo "<option value='{$id_pregunta}'>{$pregunta}</option>";
              }
            } else {
              echo "No se han encontrado preguntas.";
            }
            echo "</select><br>";
            echo "<span for 'respuesta' id='fila1'>Ingrese la respuesta:</span>";
            echo "<input class='form-control bg-light' type='text' name='respuesta' id='respuesta' autocomplete='off' onpaste='return false;' placeholder='Respuesta' required><br>";
            echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
            echo "<div id='btnEnviarRespuestas'>";
            echo "<input id= 'btnAceptar' type='submit' name='btnAceptar' value='ACEPTAR' class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm' >";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            require_once("../controller/respuestasUsuarioNuevo.php"); 
            ?>
      </form>
    </div>
</body>

</html>