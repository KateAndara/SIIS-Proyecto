<?php
session_start();
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
        require_once '../models/PromocionesAplicadas.php';

        $promocionesapli = new PromocionesApli();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPromocionesApli":
                $datos=$promocionesapli->get_promocionesapli();
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promocionesapli->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_descuentos'])) {
                    $promocionesapli->registrar_bitacora($Id_Usuario, 56,  'Ingresar', 'Se ingresó a la pantalla de promociones en ventas ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_descuentos'] = true;
                }
                echo json_encode($datos);
            break;
                
        }

?>   