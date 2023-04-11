<?php
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
                echo json_encode($datos);
            break;
            case "GetDetalleditar": //Trae la fila que se va a editar
                $datos=$detalleventas->get_detalleeditar($body["Id_Detalle_Venta"]);
                echo json_encode($datos);
            break;
            
        }

?> 