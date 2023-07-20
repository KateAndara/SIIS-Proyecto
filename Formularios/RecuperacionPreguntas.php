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
    <title>Contestar la pregunta secreta</title>
</head>


<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 32rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="d-flex justify-content-center">
    <label for='titulo'>Para recuperar su contraseña debe ingresar la respuesta a la pregunta que seleccione.</label><br>
    </div>
    <br>
    <div class="container">
      <form class="form-horizontal" action="" method="post">

            <?php

            require_once("../config/conexion.php");

            $sql = "SELECT Id_Pregunta, Pregunta FROM tbl_ms_preguntas"; // Obtiene los datos de la tabla de las preguntas.
            $resultado = $conexion->query($sql);

            // Formulario para ingresar las respuestas
            echo "<form method='post'>";
            echo "<label for='preguntas'>Seleccione una pregunta:</label><br>";
            echo "<select class='form-select form-control bg-light' name='pregunta' id='preguntas'>";

            // Recorrer los resultados de la consulta y generar una opción para cada pregunta
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
            echo "<label for='respuesta'>Ingresa la respuesta:</label><br>";
            echo "<input class='form-control bg-light' type='text' name='respuesta' id='respuesta'  autocomplete='off' onpaste='return false;' placeholder='Respuesta' required><br>";
            echo "<div id='btnEnviarRespuesta'>";
            echo "<input id='btnValidarRespuesta' type='submit' name='btnValidarRespuesta' value='Comprobar respuesta' class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            require_once("../controller/respuestaPS.php"); 
            //require_once("../controller/validacionUsuarioPS.php"); 
            ?>
      </form>
    </div>
</body>

</html>