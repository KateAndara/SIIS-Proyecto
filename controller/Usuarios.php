<?php
session_start();

//1= Produccion
//0= Local
$enviroment=0;

//Usar las librerias 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require '../Libraries/phpmailer/Exception.php';
 require '../Libraries/phpmailer/PHPMailer.php';
 require '../Libraries/phpmailer/SMTP.php';
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
     }
        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json');

        require_once '../config/conexion3.php';
        require_once '../models/Usuarios.php';

        $usuarios = new Usuarios();

        function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetUsuarios":
                $datos=$usuarios->get_Usuarios();

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    
                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="verUsuario(\'' .$datos[$i]['Id_Usuario']."'); \">Ver +</button>'";
                    }
                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarUsuario(\'' .$datos[$i]['Id_Usuario']."'); mostrarFormulario();\">Editar</button>'";
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarUsuario(\'' .$datos[$i]['Id_Usuario']."')\">Eliminar</button>'";
                    }
                
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }


               
                echo json_encode($datos);
            break;
           
            case "GetUsuarioeditar": //Trae la fila que se va a editar
                $datos=$usuarios->getUsuarioEditar($body["idUsuario"]);
                echo json_encode($datos);
            break;
            case "InsertUsuario":

          
                $CreadoPor=$_SESSION['nombre'];
                $usuario=$body['usuario'];
                $nombre=$body['nombre'];
                $DNI=$body['DNI'];
                $contrasena=$body['contraseña'];
                $confirmcontrasena=$body['confirmContraseña'];
                $correo=$body['correo'];
                $rolSelect=$body['rolSelect'];
                $fechaVencimiento=$body['fechaVencimiento'];
                $rolCargo=$body['rolCargo'];
                $estado=$body['estadoSelect'];

                if ($contrasena=="") {
                    $contrasena=passGenerator();
                }

                $selectDNI=$usuarios->verficaDNI($DNI);
                $selectUsuario=$usuarios->verificarUsuario($usuario);
                $selectCorreo=$usuarios->verificarCorreo($correo);

                // Función para encriptar contraseña
                function encriptar($password) {
                    $Encriptada = hash('sha256', $password);
                    return $Encriptada;
                }
                //Variable que almacena la contraseña encriptada
                $contrasenaEncriptada = encriptar($contrasena);

                if (count($selectDNI)>0) {
                    $arrResponse = array("status" => false, "msg" => 'DNI ya existente, Verifique nuevamente');
                }else if (count($selectUsuario)>0) {
                    $arrResponse = array("status" => false, "msg" => 'USUARIO ya existente, Verifique nuevamente');
                }else if (count($selectCorreo)>0) {
                    $arrResponse = array("status" => false, "msg" => 'CORREO ya existente, Verifique nuevamente');
                }else{
                    $datos=$usuarios->insert_Usuario($usuario,$nombre,$estado,$DNI,$correo,$contrasenaEncriptada,$rolSelect,$rolCargo,$fechaVencimiento,$CreadoPor);

                    if ($datos>0) {
                        
                        
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
                            $mail->Password   = 'kkvijfylcyhfkdnb';                               //SMTP password
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
                           
                            $arrResponse = array("status" => true, "msg" => 'Usuario Agregado Con exito');
                        } catch (Exception $e) {
                            return false;
                        } 
                        }




                    }
                }


                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($usuarios->get_user($varsesion));
                $usuarios->registrar_bitacora($Id_Usuario, 36, 'Insertar', 'Se insertó un usuario');
               
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "UpdateUsuario":
                $id_Usuario=$body['idUsuario'];
                $modificadoPor=$_SESSION['nombre'];
                $usuario=$body['usuario'];
                $nombre=$body['nombre'];
                $DNI=$body['DNI'];
                $contrasena=$body['contraseña'];
                $confirmcontrasena=$body['confirmContraseña'];
                $correo=$body['correo'];
                $rolSelect=$body['rolSelect'];
                $fechaVencimiento=$body['fechaVencimiento'];
                $rolCargo=$body['rolCargo'];
                $estado=$body['estadoSelect'];


                $selectDNI=$usuarios->verficaDNI2($DNI,$id_Usuario);
                $selectUsuario=$usuarios->verificarUsuario2($usuario,$id_Usuario);
                $selectCorreo=$usuarios->verificarCorreo2($correo,$id_Usuario);

                // Función para encriptar contraseña
                function encriptar($password) {
                    $Encriptada = hash('sha256', $password);
                    return $Encriptada;
                }
                //Variable que almacena la contraseña encriptada
                $contrasenaEncriptada = encriptar($contrasena);

                if (count($selectDNI)>0) {
                    $arrResponse = array("status" => false, "msg" => 'DNI ya existente, Verifique nuevamente');
                }else if (count($selectUsuario)>0) {
                    $arrResponse = array("status" => false, "msg" => 'USUARIO ya existente, Verifique nuevamente');
                }else if (count($selectCorreo)>0) {
                    $arrResponse = array("status" => false, "msg" => 'CORREO ya existente, Verifique nuevamente');
                }else{

                    if (!empty($contrasena)) {
                        $datos=$usuarios->update_Usuario($usuario,$nombre,$estado,$DNI,$correo,$contrasenaEncriptada,$rolSelect,$rolCargo,$fechaVencimiento,$modificadoPor,$id_Usuario);

                    }else{
                        $datos=$usuarios->update_Usuario2($usuario,$nombre,$estado,$DNI,$correo,$rolSelect,$rolCargo,$fechaVencimiento,$modificadoPor,$id_Usuario);

                    }


            

                    if ($datos>0) {
                        $arrResponse = array("status" => true, "msg" => 'Usuario Actualizado Con exito');
                    }
                }
                
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($usuarios->get_user($varsesion));
                $usuarios->registrar_bitacora($Id_Usuario, 36, 'Actualizar', 'Se actualizó un usuario');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "deleteUsuario":
                $datos=$usuarios->delete_rol($body["idUsuario"]);
                $arrResponse = array("status" => true, "msg" => 'Usuario Eliminado Correctamente');
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($usuarios->get_user($varsesion));
                $usuarios->registrar_bitacora($Id_Usuario, 36, 'Eliminar', 'Se eliminó un usuario');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "GetRoles":
                $datos=$usuarios->getRoles();
                echo json_encode($datos);
            break;
            case "GetCargos":
                $datos=$usuarios->getCargos();
                echo json_encode($datos);
            break;
        }

?>