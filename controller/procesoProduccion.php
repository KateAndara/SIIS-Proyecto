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
        require_once '../models/ProcesoProduccion.php';

        $proceso = new ProcesoProduccion();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "InsertProcesoProduccion":
                $datos=$proceso->insert_procesoProduccion($body["Id_Estado_Proceso"],$body["Fecha"]);
                echo json_encode("Se agregó el proceso");
            break;

            case "InsertProductoTerminadoMP":
                $datos=$proceso->insert_productoTerminadoMP($body["Id_Producto"],$body["Id_Proceso_Produccion"],$body["Cantidad"]);
                echo json_encode("Se agregó el producto terminado");
            break;
            case "InsertProductoTerminadoFinal":
                $datos=$proceso->insert_productoTerminadoFinal($body["Id_Producto"],$body["Id_Proceso_Produccion"],$body["Cantidad"]);
                echo json_encode("Se agregó el producto terminado");
            break;
            //Datos de otra tabla
            case "GetProductos":
                $datos=$proceso->get_productos();
                echo json_encode($datos);
            break;
            case "GetEstadoProceso":
                $datos=$proceso->get_estadoProceso();
                echo json_encode($datos);
            break;
        }
?> 
