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
        require_once '../models/ProductoTerminadoMP.php';

        $productosTerminadosMP = new ProductoTerminadoMP();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProductosTerminadosMP":
                $datos=$productosTerminadosMP->get_productosTerminadosMP();
                echo json_encode($datos);
            break;
            case "GetProductosTerminadosMPEditandoProceso":
                if(isset($_GET['id_proceso_produccion'])){
                    $id_proceso_produccion = $_GET['id_proceso_produccion'];
                    $datos=$productosTerminadosMP->get_productosTerminadosMPEditandoProceso($id_proceso_produccion);
                    echo json_encode($datos);
                }
            break;
            case "DeleteProductoTerminadoMP":
                $datos=$productosTerminadosMP->delete_productoTerminadoMP($body["Id_Producto_Terminado_Mp"]);
                echo json_encode("Producto Eliminado");
            break;
        }

?>   
