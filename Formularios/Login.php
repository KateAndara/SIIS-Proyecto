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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Inicio de sesión</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 25rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="container">
      <form class="form-horizontal" action="login.php" method="post">
        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
            <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2.5rem" />
          </div>
          <input class="form-control bg-light" type="text" placeholder="Usuario" name="usuario" id="inputUser3" />
        </div>
        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
          <button id="show_password" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" ></span> </button>
          </div>
          <input class="form-control bg-light" ID="txtPassword" type="Password" Class="form-control" placeholder="Contraseña" name="password">
        </div>
        <script type="text/javascript">
          function mostrarPassword(){
              var cambio = document.getElementById("txtPassword");
              if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
              }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
              }
            } 
        </script>
        <br>
        <div class="pt-1">
          <a href="../Formularios/RecuperarContrasenia.php" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">¿Olvidó su usuario y/o contraseña?</a>
        </div>
        <div class="d-flex gap-1 justify-content-center mt-1">
          <div id="btnIniciarSesion">
            <input type="submit" name="btniniciarSesion" value="INICIAR SESIÓN" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
          </div>
        </div>
        <?php require_once("../config/conexion.php");
        require_once("../controller/login.php"); ?>
      </form>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>