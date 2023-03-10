<?phpinclude '../components/header.components.php';?>
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
  <title>Guaradar Usuario</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  
</head>


<body>

<?php session_start();
    require_once("../config/conexion.php");
    $resultado = mysqli_query($conexion,"SELECT Id_Rol, Rol FROM tbl_ms_roles");
     
    $sql = "SELECT Valor FROM tbl_ms_parametros where Parametro='FEC_VENCIMIENTO'"; 
    $resultado2 = $conexion->query($sql);

    $parametroIntentos = mysqli_fetch_assoc($resultado2)['Valor'];
    $fecha_actual = date("Y-m-d");
    $parametro = date("Y-m-d",strtotime($fecha_actual."+ ".intval($parametroIntentos)." days"));



    
  ?>  

  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 40rem">
    <div class="container">
      <!--Boton regreasar a menu principal-->
    <a href="GestionUsuarios.php" type="submit"  class="btn btn-primary">Regresar</a>

    <div class="d-flex justify-content-center">
           <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
      <form class="form-horizontal" action="" method="post">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
               <label class="text-light">Usuario</label>
               <div class="input-group-text bg-light ">
                   <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2.5rem" />
                   <input style=" text-transform: uppercase; " class="form-control bg-light" type="text" placeholder="Usuario..." name="Usuario" id="inputUser3" maxlength="45" />
               </div>
            </div>
             <div class="form-group col-md-6">
                <label class="text-light">Nombre</label>
                <div class="input-group-text bg-light ">
                    <img src="https://icon-library.com/images/name-icon/name-icon-4.jpg" alt="username-icon" style="height: 2.5rem" />
                    <input style=" text-transform: uppercase; " class="form-control bg-light" type="text" placeholder="Nombre..." name="Nombre" id="inputname" maxlength="60" />
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
                  <label class="text-light">Correo Electr??nico</label>
                  <div class="input-group-text bg-light ">
                       <img src="https://icon-library.com/images/free-e-mail-icon/free-e-mail-icon-12.jpg" alt="username-icon" style="height: 2.5rem" />
                       <input class="form-control bg-light" type="email" placeholder="john@example.com" name="Email" id="floatingInputEmail" maxlength="45"  />
                  </div>       
             </div>
            
            </div>     
  
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <label class="text-light">Contrase??a</label>
                <div class="input-group-text bg-light ">
                    <button id="show_password" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" ></span> </button>
                    <input class="form-control bg-light" type="password" placeholder="xxxx..." name="Clave"  id="txtPassword" maxlength="15" minlength="5"  />
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
                   <label class="text-light">Confirmar Contrase??a</label>
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

        <div class="form-group col-md-6">
                   <label class="text-light">Fecha creaci??n</label>
                   <div class="input-group-text bg-light">
                       <button id="show_password2" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword2()"> <span class="fa fa-calendar-o icon" ></span> </button>
                       <input readonly value=" <?php echo date("Y-m-d") ?>" class="form-control bg-light"   />
                   </div>
                   
        </div>
         

        <!--Muestra los datos de la tabla roles en una lista desplegable-->
        <Table>     
          <tr>
            <td>
             <div style="font-size: 25px">
                <label for="estado">Rol del usuario</label>
                <select name="Rol" id="rol">
                  <?php while ($fila = $resultado->fetch_assoc()):
                    $id_rol = $fila["Id_Rol"];
                    $rol = $fila["Rol"];
                    echo "<option value='{$id_rol}'>{$rol}</option>";
                    endwhile;  
                  ?>  
                </select>
              </div>
            </td>
          </tr>
        </Table>

        <div class="form-group col-md-6">
                   <label class="text-light">Fecha Vencimiento</label>
                   <div class="input-group-text bg-light">
                       <button id="show_password2" class="btn btn-dark"  type="button" style="width:40px" onclick="mostrarPassword2()"> <span class="fa fa-calendar-o icon" ></span> </button>
                       <input name="fecha_v" readonly value=" <?php echo $parametro ?>" class="form-control bg-light"   />
                   </div>      
        </div>

        <div class="d-flex gap-1 justify-content-center mt-1">
          <div id="btnIniciarSesion">
            <input type="submit" name="btnRegistrar" value="Guardar" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
          </div>
        </div>
		    <br>
        <?php require_once("../config/conexion.php");
        require_once("../controller/gestionUsuario.php"); ?>
      </form>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
<?php include '../components/footer.components.php' ?>