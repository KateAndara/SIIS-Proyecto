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
        require_once '../models/EstadoProcesoMM.php';

        $estadosProcesosMM = new EstadoProcesoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetEstadoProcesosMM": 
                $datos=$estadosProcesosMM->get_EstadoProcesosMM();
                echo json_encode($datos);
            break;
            case "GetEstadoProcesoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Descripcion"]) ? $body["Descripcion"] : (isset($body["Id_Estado_Proceso"]) ? $body["Id_Estado_Proceso"] : '');
                $datos=$estadosProcesosMM->get_EstadoProcesoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetEstadoProcesoMMeditar": //Trae la fila que se va a editar
                $datos=$estadosProcesosMM->get_EstadoProcesoMMeditar($body["Id_Estado_Proceso"]);
                echo json_encode($datos);
            break;
            case "InsertEstadoProcesoMM":
                $datos=$estadosProcesosMM->insert_EstadoProcesoMM($body["Descripcion"]);
                echo json_encode("Se agregó el Estado del proceso");
            break;
            case "UpdateEstadoProcesoMM":
                $datos=$estadosProcesosMM->update_EstadoProcesoMM($body["Id_Estado_Proceso"],$body["Descripcion"]);
                echo json_encode("Estado del proceso Actualizado");
            break;
            case "DeleteEstadoProcesoMM":
                $datos=$estadosProcesosMM->delete_EstadoProcesoMM($body["Id_Estado_Proceso"]);
                echo json_encode("Estado del proceso Eliminado");
            break;
        }

?>   
