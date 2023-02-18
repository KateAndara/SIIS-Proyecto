<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// class clsMail{
// private $mail = null;
    // function __construct()
    // {
    //     $this->mail = new PHPMailer();
    //     $this->mail->isSMTP();
    //     $this->mail->SMTPAuth=true;
    //     $this->mail->SMTPSecure='tls';
    //     $this->mail->Host = "smtp.gmail.com";
    //     $this->mail->Port = 587;

    //     $this->mail->Username = "cazadores.software2022@gmail.com";
    //     $this->mail->Password = "llwicaywpbiztvnr";
    // }

    //  public function metEnviar(string $titulo, string $nombre, string $correo, string $asunto, string $bodyHTML)
    // {
    //     $this->mail->setFrom("cazadores.software2022@gmail.com",$titulo,true);
    //     $this->mail->addAddress($nombre,  $correo);
    //     $this->mail->Subject = $asunto;
    //     $this->mail->Body = $bodyHTML;
    //     $this->mail->isHTML(true);
    //     $this->mail->CharSet = "UTF-8";

    //     return  $this->mail->send();
    // }
    //Create an instance; passing `true` enables exceptions
    // }
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
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'cazadores.software2022@gmail.com';                     //SMTP username
    $mail->Password   = 'llwicaywpbiztvnr';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('cazadores.software2022@gmail.com', 'prueba Mailer');
    //$mail->addAddress('monicagomezdv01@gmail.com', 'Emerson');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com'); 
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'FUNCIONA CORRECTAMENTE <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message ENVIADO';
} catch (Exception $e) {
    echo " Error EN MENSAJE: {$mail->ErrorInfo}";
}

?>