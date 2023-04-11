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
        require_once '../models/EstadoVentaMM.php';

        $estadosVentasMM = new EstadoVentaMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetEstadosVentaMM":
                $datos=$estadosVentasMM->get_EstadosVentaMM();
                echo json_encode($datos);
            break;

            case "GetEstadoVentaMM":
                $busqueda = isset($body["Nombre_estado"]) ? $body["Nombre_estado"] : (isset($body["Id_Estado_Venta"]) ? $body["Id_Estado_Venta"] : '');
                $datos=$estadosVentasMM->get_EstadoVentaMM($busqueda);
                echo json_encode($datos);
            break;

            case "GetEstadoVentaMMeditar": //Trae la fila que se va a editar
                $datos=$estadosVentasMM->get_EstadoVentaMMeditar($body["Id_Estado_Venta"]);
                echo json_encode($datos);
            break;
            case "InsertEstadoVentaMM":
                $datos=$estadosVentasMM->insert_EstadoVentaMM($body["Nombre_estado"]);
                echo json_encode("Se agregó el  Estado De Venta");
            break;
            case "UpdateEstadoVentaMM":
                $datos=$estadosVentasMM->update_EstadoVentaMM($body["Id_Estado_Venta"],$body["Nombre_estado"]);
                echo json_encode("Estado De Venta Actualizado");
            break;

            case "DeleteEstadoVentaMM":
                $datos=$estadosVentasMM->delete_EstadoVentaMM($body["Id_Estado_Venta"]);
                echo json_encode("Estado De Venta Eliminado");
            break;
        }

?>   
