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
        require_once '../models/ProductoTerminadoFinal.php';

        $productosTerminadosFinal = new ProductoTerminadoFinal();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProductosTerminadosFinal":
                $datos=$productosTerminadosFinal->get_productosTerminadosFinal();
                echo json_encode($datos);
            break;
        
            case "DeleteProductoTerminadoFinal":
                $datos=$productosTerminadosFinal->delete_productoTerminadoFinal($body["Id_Producto_Terminado_Final"]);
                echo json_encode("Producto Eliminado");
            break;
        }
?>  