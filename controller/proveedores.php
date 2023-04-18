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
        require_once '../models/Proveedores.php';

        $proveedores = new Proveedor();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProveedores":
                $datos=$proveedores->get_proveedores();
                echo json_encode($datos);
            break;
            case "GetProveedor": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Proveedor"]) ? $body["Id_Proveedor"] : '');
            
                $datos = $proveedores->get_proveedor($busqueda);
            
                echo json_encode($datos);
            break;
            case "GetProveedoreditar": //Trae la fila que se va a editar
                $datos=$proveedores->get_proveedoreditar($body["Id_Proveedor"]);
                echo json_encode($datos);
            break;
            case "InsertProveedor":
                $datos=$proveedores->insert_proveedor($body["Nombre"],$body["RTN"]);
                echo json_encode("Se agregó el proveedor");
            break;
            case "UpdateProveedor":
                $datos=$proveedores->update_proveedor($body["Id_Proveedor"],$body["Nombre"],$body["RTN"]);
                echo json_encode("Proveedor Actualizado");
            break;
            case "DeleteProveedor":
                $datos=$proveedores->delete_proveedor($body["Id_Proveedor"]);
                echo json_encode("Proveedor Eliminado");
            break;
        }

?>   
