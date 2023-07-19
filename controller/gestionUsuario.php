<?php
//1= Produccion
//0= Local
$enviroment=0;

//Usar las librerias 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require '../Libraries/phpmailer/Exception.php';
 require '../Libraries/phpmailer/PHPMailer.php';
 require '../Libraries/phpmailer/SMTP.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  if (!empty($_POST["btnRegistrar"])){
       // Validación de campos vacios 
       if (empty($_POST["Usuario"]) or empty($_POST["Nombre"]) or empty($_POST["Dni"]) or empty($_POST["Clave"]) or empty($_POST["Confirmacion"]) or empty($_POST["Email"])) {
           echo '<div class="alert alert-danger">Uno de los campos esta vacio</div> ';
       } elseif ($_POST["Clave"] != $_POST["Confirmacion"]){
           echo '<div class="alert alert-danger">Los campos de contraseña no coinciden</div> ';
       } else {
        $usuario=strtoupper($_POST["Usuario"]);
        $clave=$_POST["Clave"];
        $nombre=strtoupper($_POST["Nombre"]);
        $dni=$_POST["Dni"];
        $email=$_POST["Email"];
        $rol=$_POST["Rol"];
        $estado='Nuevo';
        $Fecha=date("Y-m-d");
        $creadop = $_SESSION['usuario'];
        $id_cargo=1;
        $id_rol = $_POST["Rol"];
        $contrasena = $_POST["Clave"];

        // Función para encriptar contraseña
        function encriptar($password) {
          $Encriptada = hash('sha256', $password);
          return $Encriptada;
        }
        //Variable que almacena la contraseña encriptada
        $contrasenaEncriptada = encriptar($contrasena);
        
        $correo = $_POST["Email"];
        $parametro = $_POST["fecha_v"];

        //Función para validar el campo de nombre
        function valnombre($nombre) {    
          $patron = "/^[a-zA-Z \d]*$/";
          if(preg_match($patron, $nombre)) {
              return true;
          }else{
              return false;
          }
        }
        //Función para validar el campo dni
        function valdni($dni) {         
          $patron2 = "/^[0-9-\d]*$/";
          if(preg_match($patron2, $dni)) {
              return true;
          }else{
              return false;
          }
        } 
        //Función para validar el campo email
        function valcorreo($email){      
          $patron3 = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
          if(preg_match($patron3, $email)) {
              return true;
          }else{
              return false;
          }
        }
        // Funcion para validar contraseña
        function valcontraseña($clave){
          if (!preg_match('`[a-z]`',$clave)){
            
            return false;
         }
         if (!preg_match('`[A-Z]`',$clave)){
            
            return false;
         }
         if (!preg_match('`[0-9]`',$clave)){
            
            return false;
         }
         return true;
        }

        //Validar las listas desplegables 
        if ($estado== ""){
            array_push($campos, "Selecciona un estado");
       }

        $sql=$conexion->query(" select * from tbl_ms_usuarios where Usuario='$usuario' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este nombre de usuario ya existe</div> ';
        }else if(strpbrk($usuario, " ")){ // Validación de espacios en blanco en el campo Usuario.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Usuario no puede contener espacios en blanco.</div>';
        }else if(valnombre($nombre)==false){ // Validación de solo texto en el campo nombre.
          echo '<br>';
          echo '<div class="alert alert-danger">El nombre del usuario debe contener solo texto.</div>';
        }else if(valdni($dni)==false){ // Validación de solo numeros en el campo del dni.
          echo '<br>';
          echo '<div class="alert alert-danger">El dni solo debe tener números y guión</div>';
        }else if(valcorreo($email)==false){ // Validación del campo del correo con @ y punto.
          echo '<br>';
          echo '<div class="alert alert-danger">El correo electrónico debe llevar una @ y un dominio(.com,.es,etc)</div>';
        }else if(valcontraseña($clave)==false){ // Validación del campo del correo con @ y punto.
          echo '<br>';
          echo '<div class="alert alert-danger">La contraseña debe tener minimo 1 carácter en mayúscula, minúscula y un carácter númerico </div>';
        }else if(strpbrk($clave, " ")){ // Validación de espacios en blanco en el campo Contraseña.
          echo '<br>';
          echo '<div class="alert alert-danger">El campo Contraseña no puede contener espacios en blanco.</div>';
        }else{
          $sql=$conexion -> query("insert into tbl_ms_usuarios(Id_Rol,Id_Cargo,Usuario,Nombre,Estado,Contraseña,DNI,Correo_Electronico, Fecha_creacion, Creado_por, Fecha_vencimiento)values('$id_rol','$id_cargo','$usuario','$nombre','$estado','$contrasenaEncriptada','$dni','$correo','$Fecha', '$creadop', '$parametro')");
          echo '<br>';
          header('Location:../Formularios/GestionUsuarios.php?mensaje=guardado');
        
          //ENVIAR CORREO 
          if ($enviroment==1) {
            $asunto = "BIENVENIDO A SIIS";
            $emailDestino = $correo;
            $empresa = "SIIS";
            $remitente = "cazadores.software2022@gmail.com";
            
            //ENVIO DE CORREO
            $de = "MIME-Version: 1.0\r\n";
            $de .= "Content-type: text/html; charset=UTF-8\r\n";
            $de .= "From: {$empresa} <{$remitente}>\r\n";
            ob_start();
            require_once("email.php");
            $mensaje = ob_get_clean();
            $send = mail($emailDestino, $asunto, $mensaje, $de);
            return $send;
          }else{
            //Create an instance; passing `true` enables exceptions
          $mail = new PHPMailer(true);
          ob_start();
          require_once("email.php");
          $mensaje = ob_get_clean();

          try {
              //Server settings
              $mail->SMTPDebug =  0;                      //Enable verbose debug output
              $mail->isSMTP();                                            //Send using SMTP
              $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
              $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
              $mail->Username   = 'cazadores.software2022@gmail.com';          //SMTP username
              $mail->Password   = 'fwdlqnylsvjgvdiv';                               //SMTP password
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
              $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

              //Recipients
              $mail->setFrom('cazadores.software2022@gmail.com', 'Servidor Local SIIS');
              $mail->addAddress($correo);     //Add a recipient
              if(!empty($correo)){
                  $mail->addBCC($correo);
              }
              $mail->CharSet = 'UTF-8';
              //Content
              $mail->isHTML(true);                                  //Set email format to HTML
              $mail->Subject = "BIENVENIDO A SIIS";
              $mail->Body    = $mensaje;
              
              $mail->send();
              echo '<br>';
              header('Location:../Formularios/GestionUsuarios.php?mensaje=guardado');
              return true;
          } catch (Exception $e) {
              return false;
          } 
          }
        }
    
      } 
  }
  
?>



