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
        require_once '../models/TipoProductoMM.php';

        $tiposProductosMM = new TipoProductoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoProductosMM":
                $datos=$tiposProductosMM->get_TipoProductosMM();
                echo json_encode($datos);
            break;
            case "GetTipoProductoMM":
                $busqueda = isset($body["Nombre_tipo"]) ? $body["Nombre_tipo"] : (isset($body["Id_Tipo_Producto"]) ? $body["Id_Tipo_Producto"] : '');
                $datos=$tiposProductosMM->get_TipoProductoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetTipoProductoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposProductosMM->get_TipoProductoMMeditar($body["Id_Tipo_Producto"]);
                echo json_encode($datos);
            break;
            case "InsertTipoProductoMM":
                $datos=$tiposProductosMM->insert_TipoProductoMM($body["Nombre_tipo"]);
                echo json_encode("Se agregó el  Tipo De Producto");
            break;
            case "UpdateTipoProductoMM":
                $datos=$tiposProductosMM->update_TipoProductoMM($body["Id_Tipo_Producto"],$body["Nombre_tipo"]);
                echo json_encode("Tipo De Producto Actualizado");
            break;
            case "DeleteTipoProductoMM":
                $datos=$tiposProductosMM->delete_TipoProductoMM($body["Id_Tipo_Producto"]);
                echo json_encode("Tipo De Producto Eliminado");
            break; 
        }

?>   
