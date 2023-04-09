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
        require_once '../models/CargosMM.php';

        $cargosMM = new CargosMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetCargosMM":
                $datos=$cargosMM->get_CargosMM();
                echo json_encode($datos);
            break;
            case "GetCargoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre_cargo"]) ? $body["Nombre_cargo"] : (isset($body["Id_Cargo"]) ? $body["Id_Cargo"] : '');
                $datos=$cargosMM->get_CargoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetCargoMMeditar": //Trae la fila que se va a editar
                $datos=$cargosMM->get_CargoMMeditar($body["Id_Cargo"]);
                echo json_encode($datos);
            break;
            case "InsertCargoMM":
                $datos=$cargosMM->insert_CargoMM($body["Nombre_cargo"]);
                echo json_encode("Se agregó el  Cargo");
            break;
            case "UpdateCargoMM":
                $datos=$cargosMM->update_CargoMM($body["Id_Cargo"],$body["Nombre_cargo"]);
                echo json_encode("Cargo Actualizado");
            break;
            case "DeleteCargoMM":
                $datos=$cargosMM->delete_CargoMM($body["Id_Cargo"]);
                echo json_encode("Cargo Eliminado");
            break;
        }

?>   
