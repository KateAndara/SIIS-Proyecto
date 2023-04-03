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
        require_once '../models/Inventario.php';

        $Inventarios = new Inventario();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetInventarios":
                $datos=$Inventarios->get_Inventarios();
                echo json_encode($datos);
            break;
            case "GetInventario":
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Inventario"]) ? $body["Id_Inventario"] : '');
                $datos=$Inventarios->get_Inventario($busqueda);
                echo json_encode($datos);
            break;          
        }
?>   