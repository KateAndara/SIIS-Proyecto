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
  <title>Registro</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 25rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="container">
      <form class="form-horizontal" action="" method="post">
        <div class="input-group mt-4">
          <div class="input-group-text bg-light">
           <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="text" placeholder="Usuario..." name="Usuario" id="inputUser3" maxlength="45" pattern="[A-Z]+" />
        </div>
		<div class="input-group mt-4">
          <div class="input-group-text bg-light">
           <img src="https://icon-library.com/images/free-e-mail-icon/free-e-mail-icon-12.jpg" alt="username-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="email" placeholder="john@example.com" name="Email" id="floatingInputEmail" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+" />
        </div>
        <br>
        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
            <img src="https://icon-library.com/images/show-password-icon/show-password-icon-7.jpg" alt="password-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="password" placeholder="Contraseña..." name="Clave" id="inputPassword3" maxlength="15" minlength="5" required />
        </div>
        <br>
		<div class="input-group mt-1">
          <div class="input-group-text bg-light">
            <img src="https://icon-library.com/images/show-password-icon/show-password-icon-8.jpg" alt="password-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="password" placeholder="Confirmar contraseña..." name="Confirmacion" id="inputPassword3" maxlength="15" minlength="5" required />
        </div>
        <br>
        <div class="d-flex gap-1 justify-content-center mt-1">
          <div id="btnIniciarSesion">
            <input type="submit" name="btnRegistrar" value="REGISTRARSE" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
          </div>
        </div>
		<br>
		<div class="pt-1">
          <a href="../Formularios/Login.php" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">¿Tienes una cuenta? Inicia Sesión</a>
        </div>
        <?php require_once("../config/conexion.php");
        require_once("../controller/registro.php"); ?>
      </form>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>