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
        require_once '../models/GestionProcesoProduccion.php';

        $procesos = new EditarProcesoProduccion();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProcesosProduccion":
                $datos=$procesos->get_procesosProduccion();
                echo json_encode($datos);
            break;
            //Datos de otra tabla
            case "GetEstadosProcesos":
                $datos=$procesos->get_estadoProceso();
                echo json_encode($datos);
            break;
            case "GetProcesoProduccionEditar": //Trae la fila que se va a editar
                $datos=$procesos->get_procesoProduccionEditar($body["Id_Proceso_Produccion"]);
                echo json_encode($datos);
            break;
            case "UpdateProcesoProduccion":
                $datos=$procesos->update_procesoProduccion($body["Id_Proceso_Produccion"],$body["Id_Estado_Proceso"],$body["Fecha"]);
                echo json_encode("Proceso Actualizado");
            break;
        }

?>   
