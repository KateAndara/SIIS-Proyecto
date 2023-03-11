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
      <form class="form-horizontal" action="registro.php" method="post" >
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
               <label class="text-light">Usuario</label>
               <div class="input-group-text bg-light ">
                   <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2.5rem" />
                   <input class="form-control bg-light"  type="text" placeholder="Usuario..." name="Usuario"  
                   id="inputUser3" maxlength="45" onkeydown="this.value=Mayus(this.value)" value="<?php if(isset($_POST["Usuario"])) echo $_POST["Usuario"]; ?>"
                   onkeyup="this.value=Mayusculas(this.value)" pattern="[A-Z]+" title="El usuario solo puede ir en Mayúsculas" required/>
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
              </script>
            </div>
            
             <div class="form-group col-md-6">
                <label class="text-light">Nombre</label>
                <div class="input-group-text bg-light ">
                    <img src="https://icon-library.com/images/name-icon/name-icon-4.jpg" alt="username-icon" style="height: 2.5rem" />
                    <input class="form-control bg-light" type="text" placeholder="Nombre..." name="Nombre"
                     id="inputname" maxlength="60" onkeyup="this.value=Letras(this.value)" 
                     value="<?php if(isset($_POST["Nombre"])) echo $_POST["Nombre"]; ?>"
                     pattern="[a-zA-Z ]+" title="El nombre solo debe contener letras y espacio" required/>
                </div>
              <script>
              function Letras(string){//Solo texto
              var out = '';
              var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZáéíóú ';//Caracteres validos
	
              //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
              for (var i=0; i<string.length; i++)
              if (filtro.indexOf(string.charAt(i)) != -1) 
             //Se añaden a la salida los caracteres validos
	            out += string.charAt(i);
	
              //Retornar valor filtrado
               return out;
               } 
               
               // Funcion para permitir solo un espacio entre caracteres
               document.getElementById("inputname").addEventListener("keydown", teclear);

               var flag = false;
               var teclaAnterior = "";

               function teclear(event) {
                   teclaAnterior = teclaAnterior + " " + event.keyCode;
                   var arregloTA = teclaAnterior.split(" ");
                   if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
                        event.preventDefault();
                   }
               }
              </script>
              
             </div>
        </div>
       
        <div class="row justify-content-center">
             <div class="form-group col-md-6">
                 <label class="text-light">DNI</label>
                 <div class="input-group-text bg-light">
                     <img src="https://icon-library.com/images/card-icon/card-icon-14.jpg" alt="username-icon" style="height: 2.5rem" />
                     <input class="form-control bg-light" type="text" placeholder="0000-0000-00000" 
                     name="Dni" value="<?php if(isset($_POST["Dni"])) echo $_POST["Dni"]; ?>"
                    id="inputdni" maxlength="16" onkeydown="this.value=Numeros(this.value)"
                    pattern="[0-9-]+" title="Solo se permiten números y guión" required/>
                 </div>
              <script>
              function Numeros(string){//Solo numeros
              var out = '';
              var filtro = '0123456789-';//Caracteres validos
	
              //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
              for (var i=0; i<string.length; i++)
              if (filtro.indexOf(string.charAt(i)) != -1) 
             //Se añaden a la salida los caracteres validos
	            out += string.charAt(i);
	
              //Retornar valor filtrado
               return out;
              }   
              </script>   
             </div>

		         <div class="form-group col-md-6">
                  <label class="text-light">Correo Electrónico</label>
                  <div class="input-group-text bg-light ">
                       <img src="https://icon-library.com/images/free-e-mail-icon/free-e-mail-icon-12.jpg" alt="username-icon" style="height: 2.5rem" />
                       <input class="form-control bg-light"  type="email" placeholder="john@example.com"
                        name="Email" id="floatingInputEmail" maxlength="45" value="<?php if(isset($_POST["Email"])) echo $_POST["Email"]; ?>"
                        pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
                         title="El email debe contener un @ y un dominio (.com,.es,etc)" required/>
                  </div>       
             </div>
            
        </div>     
  
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <label class="text-light">Contraseña</label>
                <div class="input-group-text bg-light ">
                    <button id="show_password" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" ></span> </button>
                    <input class="form-control bg-light" type="password" placeholder="xxxx..." 
                    name="Clave" value="<?php if(isset($_POST["Clave"])) echo $_POST["Clave"]; ?>"
                    id="txtPassword" maxlength="15" minlength="5" pattern="[a-zA-Z0-9!#$%&@'*_+-.]+" 
                    title="La contraseña debe contener mayúsculas, minusculas, números y caracteres especiales"
                    required  />
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
                       <input class="form-control bg-light" type="password" placeholder="xxxx..."
                       name="Confirmacion" value="<?php if(isset($_POST["Confirmacion"])) echo $_POST["Confirmacion"]; ?>"
                       id="txtPassword2" maxlength="15" minlength="5"  required/>
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
        
        <div class="d-flex gap-1 justify-content-center mt-1">
          <div id="btnIniciarSesion">
              <input type="submit" name="btnRegistrar" value="REGISTRARSE"  class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
          </div>
        </div>
		    <br>
        <div class="d-flex gap-1 justify-content-center mt-1">
        <input type="button" onclick="location.href='../Formularios/index.html'" name="volver atrás" value="REGRESAR" class="btn btn-danger text-white w-30 mt-6 fw-semibold shadow-sm">
        </div>
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