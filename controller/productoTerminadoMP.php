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
            case "GetProductoTerminadoMP": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Producto_Terminado_Mp"]) ? $body["Id_Producto_Terminado_Mp"] : '');
            
                $datos = $productosTerminadosMP->get_productoTerminadoMP($busqueda);
            
                echo json_encode($datos);
            break;
            case "GetProductoTerminadoMPeditar": //Trae la fila que se va a editar
                $datos=$productosTerminadosMP->get_productoTerminadoMPeditar($body["Id_Producto_Terminado_Mp"]);
                echo json_encode($datos);
            break;
            case "InsertProductoTerminadoMP":
                $datos=$productosTerminadosMP->insert_productoTerminadoMP($body["Id_Producto"],$body["Id_Proceso_Produccion"],$body["Cantidad"]);
                echo json_encode("Se agregó el producto terminado");
            break;
            case "UpdateProductoTerminadoMP":
                $datos=$productosTerminadosMP->update_productoTerminadoMP($body["Id_Producto_Terminado_Mp"],$body["Id_Producto"],$body["Id_Proceso_Produccion"],$body["Cantidad"]);
                echo json_encode("Producto Actualizado");
            break;
            case "DeleteProductoTerminadoMP":
                $datos=$productosTerminadosMP->delete_productoTerminadoMP($body["Id_Producto_Terminado_Mp"]);
                echo json_encode("Producto Eliminado");
            break;
            //Datos de otra tabla
            case "GetProductos":
                $datos=$productosTerminadosMP->get_productos();
                echo json_encode($datos);
            break;
        }

?>   
