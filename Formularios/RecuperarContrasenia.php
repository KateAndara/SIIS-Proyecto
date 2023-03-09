<?php ob_start(); ?>
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
  <title>Recuperar contraseña</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
<div class="formulario">
        <div class="welcome-back">
            <div class="message">
                <h1 class="create-account text-white">RECUPERACIÓN DE CONTRASEÑA</h1>
                <p class="text-white">¿Olvidaste tu contraseña?</p>
                <p class="text-white">Selecciona el método por el cual te gustaría recuperarla.</p>
                <a href="http://localhost/SIIS-PROYECTO/Formularios/RecuperarPorCorreo.php">
                    <button class="sign-up-btn">Vía correo electrónico</button>
                </a> 
                <a href="http://localhost/SIIS-PROYECTO/Formularios/ValidarUsuarioPS.php">
                    <button class="sign-up-btn">Vía preguntas secretas</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
<?php ob_end_flush(); ?> 