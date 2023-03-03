<?php

/**
 * Funcion para requerir la conexion a la base de datos
 */
require_once("../../../config/conexion.php");
include_once '../../../token/Token.php'; //incluir clase para generar tokens



//obtencion del nombre del usuario por el metodo POST
 $nombre = htmlspecialchars( $_POST['usuario'],ENT_QUOTES,'UTF-8');


//busquedad del correo del usuario por el metodo post
 $sql=$conexion->query(" select Correo_Electronico from tbl_ms_usuarios where Usuario='$nombre'");

 $datos=$sql->fetch_object();

 if ($datos == NULL) {
    //pueden enviar un mensaje de confirmacion auque no sea correcto el usuario

    header('Location: ../../../Formularios/index.html');
 }

/**
 * Conversion de los datos que retorna la base de datos y calculo de la posición del correo para el envió
 */
 $informacion = json_encode($datos,true);

 $posicion =  strpos($informacion, ":") + 2;

 $correo =  substr($informacion, $posicion, -2);

//  echo $correo;

 /**
  * Generar token 
  */

  //traer parameto con tiempo de expiracion desde la base de datos
  $sql=$conexion->query(" select Valor from tbl_ms_parametros where Parametro='Correo_EXP'");

  $datos=$sql->fetch_object();

  $informacion = json_encode($datos,true);

  $posicion =  strpos($informacion, ":") + 2;
 
  $duracion =  substr($informacion, $posicion, -2);
 

//   echo $duracion.'  '.$nombre.'  '.$correo;

  $token_generado = ALLtoken::Generar($duracion, $nombre, $correo);

// $email = htmlspecialchars( $_POST['email'],ENT_QUOTES,'UTF-8');
// $cdm = htmlspecialchars( $_POST['CDM'],ENT_QUOTES,'UTF-8');
// $indentificador = htmlspecialchars( $_POST['identificador'],ENT_QUOTES,'UTF-8');



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'cazadores.software2022@gmail.com';                     //SMTP username
    $mail->Password   = 'fwdlqnylsvjgvdiv';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('cazadores.software2022@gmail.com', 'prueba Mailer');
    $mail->addAddress($correo,$nombre );     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com'); 
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


    $bodyHtml = 'Hola '.$nombre.', has solicitado cambiar tu contraseña, Presiona el botón';
    $bodyHtml .= '<form action="http://localhost/SIIS-PROYECTO/pruebas.php" method="post">
      <input type="hidden" name="user" value='.$nombre.'>
    <input  type="hidden" name="token" value='.$token_generado.'>
    <br>
    <input type="submit" name="validar" value="validar">
    
    </form>';
   //  $bodyHtml .='http://localhost/SIIS-PROYECTO/Formularios/Login.php?user='.$nombre.'&token='.$token_generado.'\n\n';
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Solicitud de restablecimiento de credenciales';
    $mail->Body    = $cdm.$bodyHtml;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
      //Bitácora
    $sql=$conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$nombre';");
    $idusuario=$sql->fetch_object();


    //limpiar datos
    $informacion = json_encode($idusuario,true); 
    $posicion =  strpos($informacion, ":") + 2;
    $idusuario =  substr($informacion, $posicion, -2);
    $sql=$conexion->query("Select id_objeto from tbl_objetos where Objeto = 'recuperacion_Correo';");
    $idobjeto=$sql->fetch_object();

    // limpiar datos 
    $informacion = json_encode($idobjeto,true);
   
    $posicion =  strpos($informacion, ":") + 2;
   
    $idobjeto =  substr($informacion, $posicion, -2);

    echo $idobjeto.' Usuario:'.$idusuario;
    $sql=$conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de contraseña por correo','El usuario $nombre ha solicitado un cambio de contraseña') ");
    
   
   
    //insertarNumero

    $mensaje = 'Se envio de forma sactifactoria el correo a '.$correo;
    header("Location: ../../../Formularios/index.html?mensaje=".urlencode($mensaje));


} catch (Exception $e) {
    //Bitácora
    $sql=$conexion->query("Select id_usuario from tbl_ms_usuarios where Usuario = '$nombre';");
    $idusuario=$sql->fetch_object();


    //limpiar datos
    $informacion = json_encode($idusuario,true); 
    $posicion =  strpos($informacion, ":") + 2;
    $idusuario =  substr($informacion, $posicion, -2);
    $sql=$conexion->query("Select id_objeto from tbl_objetos where Objeto = 'recuperacion_Correo';");
    $idobjeto=$sql->fetch_object();

    // limpiar datos 
    $informacion = json_encode($idobjeto,true);
 
    $posicion =  strpos($informacion, ":") + 2;
 
    $idobjeto =  substr($informacion, $posicion, -2);

    //echo $idobjeto.' Usuario:'.$idusuario;
    $sql=$conexion->query("INSERT INTO tbl_ms_bitacora(Id_Usuario,Id_Objeto,Fecha,Accion,Descripcion) VALUES($idusuario,$idobjeto,now(),'Cambio de contraseña por correo fallido','El usuario $nombre ha intentado solicitar un cambio de contraseña') ");
  
    echo " Error EN MENSAJE: {$mail->ErrorInfo}";
}

?>