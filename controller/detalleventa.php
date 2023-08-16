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
        require_once '../models/DetalleVenta.php';

        $detalleventas = new DetalleVentas();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetDetalles":
                $datos=$detalleventas->get_detalles();
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($detalleventas->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_detalleventas'])) {
                    $detalleventas->registrar_bitacora($Id_Usuario, 27,  'Ingresar', 'Se ingresó a la pantalla de detalle de ventas ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_detalleventas'] = true;
                }
                echo json_encode($datos);
            break;
            case "GetDetalleditar": //Trae la fila que se va a editar
                $datos=$detalleventas->get_detalleeditar($body["Id_Detalle_Venta"]);
                echo json_encode($datos);
            break;
            
        }

?> 