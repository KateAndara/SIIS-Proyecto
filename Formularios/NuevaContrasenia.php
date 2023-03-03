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
    <title>Nueva Contraseña</title>
</head>


<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 32rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="d-flex justify-content-center">
    <label for='titulo'>Debe agregar una nueva contraseña, una vez agregada, ya podrá iniciar sesión con su nueva contraseña.</label><br>
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
            echo "<label for='contraseñaActual'>Ingrese su actual contraseña:</label><br>";
            echo "<input class='form-control bg-light' type='password'  name='contraseñaActual' id='contraseñaActual' placeholder='Contraseña actual' required><br>";
            echo "<label for='contraseña'>Ingrese la nueva contraseña:</label><br>";
            echo "<input class='form-control bg-light' type='password'  name='contraseña' id='contraseña' placeholder='Contraseña' required><br>";
            echo "<label for='confirmarcontraseña'>Confirme la nueva contraseña:</label><br>";
            echo "<input class='form-control bg-light' type='password'  name='confirmarcontraseña' id='confirmarcontraseña' placeholder='Contraseña' required><br>";
            echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
            echo "<div id='btnContrasenia'>";
            echo "<input type='submit' name='btnContrasenia' value='ACEPTAR' class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";

            require_once("../controller/contraseniaNueva.php");

            ?>
      </form>
    </div>
</body>

</html>

