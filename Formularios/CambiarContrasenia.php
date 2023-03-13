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
  <title>Nueva contraseña</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 32rem">
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="d-flex justify-content-center">
    <label for='titulo'>Usted ha solicitado reestablecer su contraseña, por favor complete los siguientes campos..</label><br>
    </div>
    <br>
    <div class="container">
      <form class="form-horizontal" action="../controller/actualizarContrasenia.php" method="post">

            <?php 
            require_once("../config/conexion.php");
            echo "<form method='post'>";
            echo "<label for='contraseña'>Ingrese la nueva contraseña:</label><br>";
            echo "<div class='input-group mt-1'>";
            echo "<div class='input-group-text bg-light'>";
            echo "<button id='how_password' class='btn btn-dark'  type='button' style='width:40px' onclick='mostrarPassword1()'> <span class='fa fa-eye-slash icon' ></span> </button>";
            echo "</div>";
            echo "<input class='form-control bg-light' type='password'  name='contraseña' id='txtPassword' placeholder='Contraseña' required><br>";
            echo "</div>";
            echo "<script type='text/javascript'>";
            echo "function mostrarPassword1(){";
                echo "var cambio = document.getElementById('txtPassword');";
                echo "if(cambio.type == 'password'){";
                  echo "cambio.type = 'text';";
                 echo "$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');";
                echo "}else{";
                  echo "cambio.type = 'password';";
                  echo "$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');";
                echo "}";
              echo "}"; 
            echo "</script>";
            echo "<br>";
            echo "<label for='confirmarcontraseña'>Confirme la nueva contraseña:</label><br>";
            echo "<div class='input-group mt-1'>";
            echo "<div class='input-group-text bg-light'>";
            echo "<button id='how_password2' class='btn btn-dark'  type='button' style='width:40px' onclick='mostrarPassword2()'> <span class='fa fa-eye-slash icon' ></span> </button>";
            echo "</div>";
            echo "<input class='form-control bg-light' type='password'  name='confirmarcontraseña' id='confirmarcontraseña' placeholder='Contraseña' required><br>";
            echo "</div>";
            echo "<script type='text/javascript'>";
            echo "function mostrarPassword2(){";
                echo "var cambio2 = document.getElementById('confirmarcontraseña');";
                echo "if(cambio2.type == 'password'){";
                  echo "cambio2.type = 'text';";
                 echo "$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');";
                echo "}else{";
                  echo "cambio2.type = 'password';";
                  echo "$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');";
                echo "}";
              echo "}"; 
            echo "</script>";
            
            echo "<div class='d-flex gap-1 justify-content-center mt-1'>";
            echo "<div id='btnContrasenia'>";
            echo "<input type='submit' name='btnContrasenia' value='ACEPTAR' class='btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm'>";
            echo "</div>";
            echo "</div>";
            echo "</form>";

           // require_once("../controller/actualizarContrasenia.php");
            ?>
      </form>
    </div>
</body>

</html>