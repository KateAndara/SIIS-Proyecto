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
    <div id="mensaje" style="display: none; background-color: dark; padding: 5px; text-align: center;">
    <span style="font-size: 14px; color: white;">Solo se permiten letras.</span>
    </div>
        <div class="welcome-back">
            <div class="message">
                <h2 class="text-white d-flex justify-content-center">RECUPERACIÓN DE CONTRASEÑA</h2>
                <div class="d-flex justify-content-center">
                <img src="https://w7.pngwing.com/pngs/546/655/png-transparent-password-computer-icons-user-the-plain-style-miscellaneous-area-padlock.png" alt="recup-icon" style="height: 7rem" />
            </div>
            <form action="../mailer/PHPMailer/src/enviarcorreo.php" method="post">
            <br><br><p class="text-white fw-semibold">Ingrese su usuario:</p>
            <input class="form-control bg-light" type="text" placeholder="Usuario" name="usuario" id="inputUser3"  onkeydown="this.value=Mayus(this.value)" onkeyup="this.value=Mayusculas(this.value)" autocomplete="off" oninput="validarCampoUsuario()" onkeypress="javascript:return soloLetras(event)"onpaste="return false;"/>
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
            <div class="d-flex gap-1 justify-content-center mt-1">
                <div id="btnEnviarContrasenia">
                    <input type="submit" name="btnenviarcontrasenia" value="ENVIAR CORREO" class="btn btn-info text-black w-100 mt-3 fw-semibold shadow-sm">
                </div>
                </form>
            </div>
        </div> 
    </div> 
</body> 

</html>
<?php ob_end_flush(); ?>