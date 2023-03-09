
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
                <h2 class="text-white d-flex justify-content-center">RECUPERACIÓN DE CONTRASEÑA</h2>
                <div class="d-flex justify-content-center">
                <img src="https://w7.pngwing.com/pngs/546/655/png-transparent-password-computer-icons-user-the-plain-style-miscellaneous-area-padlock.png" alt="recup-icon" style="height: 7rem" />
            </div>
        <form class="form-horizontal" method="post">
            <br><br><p class="text-white fw-semibold">Ingrese su usuario</p>
            <input class="form-control bg-light" type="text" placeholder="Usuario" name="usuario" id="inputUser3" /> 
            <div class="d-flex gap-1 justify-content-center mt-1">
                <div id="btnComprobarUsuario">
                    <input type="submit" name="btnComprobarUsuario" value="Comprobar Usuario" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
                </div>
            </div>
            <?php require_once("../config/conexion.php");
            require_once("../controller/validacionUsuarioPS.php"); ?>
        </form>   
    </div> 
</body> 

</html>
            
