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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Registro</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  
</head>


<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 40rem">
    <div class="container">
    <div class="d-flex justify-content-center">
           <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
      <form class="form-horizontal" action="" method="post">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
               <label class="text-light">Usuario</label>
               <div class="input-group-text bg-light ">
                   <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2.5rem" />
                   <input class="form-control bg-light" type="text" placeholder="Usuario..." name="Usuario" id="inputUser3" maxlength="45" />
               </div>
               
            </div>
            
             <div class="form-group col-md-6">
                <label class="text-light">Nombre</label>
                <div class="input-group-text bg-light ">
                    <img src="https://icon-library.com/images/name-icon/name-icon-4.jpg" alt="username-icon" style="height: 2.5rem" />
                    <input class="form-control bg-light" type="text" placeholder="Nombre..." name="Nombre" id="inputname" maxlength="60" />
                </div>
            
             </div>
        </div>
       
        <div class="row justify-content-center">
             <div class="form-group col-md-6">
                 <label class="text-light">DNI</label>
                 <div class="input-group-text bg-light">
                     <img src="https://icon-library.com/images/card-icon/card-icon-14.jpg" alt="username-icon" style="height: 2.5rem" />
                     <input class="form-control bg-light" type="text" placeholder="0000-0000-00000" name="Dni" id="inputdni" maxlength="16" />
                 </div>
                 
             </div>

		         <div class="form-group col-md-6">
                  <label class="text-light">Correo Electrónico</label>
                  <div class="input-group-text bg-light ">
                       <img src="https://icon-library.com/images/free-e-mail-icon/free-e-mail-icon-12.jpg" alt="username-icon" style="height: 2.5rem" />
                       <input class="form-control bg-light" type="email" placeholder="john@example.com" name="Email" id="floatingInputEmail" maxlength="45" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+" />
                  </div>       
             </div>
            
        </div>     
  
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <label class="text-light">Contraseña</label>
                <div class="input-group-text bg-light ">
                    <button id="show_password" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" ></span> </button>
                    <input class="form-control bg-light" type="password" placeholder="xxxx..." name="Clave" id="txtPassword" maxlength="15" minlength="5"  />
                </div>
                
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
          
		        <div class="form-group col-md-6">
                   <label class="text-light">Confirmar Contraseña</label>
                   <div class="input-group-text bg-light">
                       <button id="show_password2" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon" ></span> </button>
                       <input class="form-control bg-light" type="password" placeholder="xxxx..." name="Confirmacion" id="txtPassword2" maxlength="15" minlength="5"  />
                   </div>
                   
            </div>
            <script type="text/javascript">
                 function mostrarPassword2(){
                    var cambio = document.getElementById("txtPassword2");
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
        </div>    
        <div class="formulario__grupo" id="grupo__terminos">
                   <label class="formulario__label">
                      <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos" required>
                    Acepto los terminos y Condiciones
                    </label>             
        </div>
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