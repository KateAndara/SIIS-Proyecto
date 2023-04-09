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
        require_once '../models/TipoMovimientoMM.php';

        $tiposMovimientosMM = new TipoMovimientoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoMovimientosMM":
                $datos=$tiposMovimientosMM->get_TipoMovimientosMM();
                echo json_encode($datos);
            break;
            case "GetTipoMovimientoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Descripcion"]) ? $body["Descripcion"] : (isset($body["Id_Tipo_Movimiento"]) ? $body["Id_Tipo_Movimiento"] : '');
                $datos=$tiposMovimientosMM->get_TipoMovimientoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetTipoMovimientoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposMovimientosMM->get_TipoMovimientoMMeditar($body["Id_Tipo_Movimiento"]);
                echo json_encode($datos);
            break;
            case "InsertTipoMovimientoMM":
                $datos=$tiposMovimientosMM->insert_TipoMovimientoMM($body["Descripcion"]);
                echo json_encode("Se agregó el  Cargo");
            break;
            case "UpdateTipoMovimientoMM":
                $datos=$tiposMovimientosMM->update_TipoMovimientoMM($body["Id_Tipo_Movimiento"],$body["Descripcion"]);
                echo json_encode("Cargo Actualizado");
            break;
            case "DeleteTipoMovimientoMM":
                $datos=$tiposMovimientosMM->delete_TipoMovimientoMM($body["Id_Tipo_Movimiento"]);
                echo json_encode("Cargo Eliminado");
            break;
        }

?>    
