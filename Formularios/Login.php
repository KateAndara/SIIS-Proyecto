<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="../JS/funciones.js"></script>
  
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
  <div id="mensaje" style="display: none; background-color: dark; padding: 5px; text-align: center;">
    <span style="font-size: 14px; color: pink;">En el campo "usuario" solo se permiten letras.</span>
  </div>
  <div id="mensaje2" style="display: none; background-color: dark; padding: 5px; text-align: center;">
    <span style="font-size: 14px; color: pink;">El campo "Contraseña" no puede contener más de 15 caracteres.</span>
  </div>
  <div id="mensaje3" style="display: none; background-color: dark; padding: 5px; text-align: center;">
    <span style="font-size: 14px; color: pink;">El campo 'Usuario' no puede contener más de 45 caracteres.</span>
  </div>
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="container">
      <form class="form-horizontal" action="login.php" method="post">
        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
            <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2.5rem" />
          </div>
          <input class="form-control bg-light" type="text" placeholder="Usuario" name="usuario" id="usuario" onkeydown="this.value=Mayus(this.value)" onkeyup="this.value=Mayusculas(this.value)" autocomplete="off" oninput="validarCampoUsuario()" onkeypress="javascript:return soloLetras(event)" onpaste="return false;"/>
        </div>
        <script>
                function Mayus(string){//Solo mayusculas
                 var out = '';
                 var filtro = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';//Caracteres validos
	
                //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
                  for (var i=0; i<string.length; i++)
                  if (filtro.indexOf(string.charAt(i)) != -1) 
                   //Se añaden a la salida los caracteres validos
	                 out += string.charAt(i);
	  
                   //Retornar valor filtrado
                   return out;
                }
              
                function Mayusculas(tx){
	                //Retornar valor convertido a mayusculas
	                 return tx.toUpperCase();
                }

                function soloLetras(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                especiales = "8-37-39-46";

                tecla_especial = false;
                for (var i in especiales) {
                    if (key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }

                if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                    // Mostrar el mensaje
                    var mensajeElemento = document.getElementById("mensaje");
                    mensajeElemento.style.display = "block";

                    // Ocultar el mensaje después de 2 segundos (2000 ms)
                    setTimeout(function() {
                        mensajeElemento.style.display = "none";
                    }, 3000);

                    return false;
                }
            }

          </script>
        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
          <button id="show_password" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword('password')"> <span class="fa fa-eye-slash icon" ></span> </button>
          </div>
          <input class="form-control bg-light" ID="password" type="Password" Class="form-control" placeholder="Contraseña" name="password" oninput="validarCampoContrasenia()"onpaste="return false;"/>
        </div>
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