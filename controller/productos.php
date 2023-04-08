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
        require_once '../models/Productos.php';

        $productos = new Producto();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProductos":
                $datos=$productos->get_productos();
                echo json_encode($datos);
            break;
            case "GetProducto": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Producto"]) ? $body["Id_Producto"] : '');
                $datos = $productos->get_producto($busqueda);
                echo json_encode($datos);
            break;
            case "GetProductoeditar": //Trae la fila que se va a editar
                $datos=$productos->get_productoeditar($body["Id_Producto"]);
                echo json_encode($datos);
            break;
            case "InsertProducto":
                $datos=$productos->insert_producto($body["Id_Tipo_Producto"],$body["Nombre"],$body["Unidad_medida"],$body["Precio"],$body["Cantidad_maxima"],$body["Cantidad_minima"]);
                echo json_encode("Se agregó el producto");
            break;
            case "UpdateProducto":
                $datos=$productos->update_producto($body["Id_Producto"],$body["Id_Tipo_Producto"],$body["Nombre"],$body["Unidad_medida"],$body["Precio"],$body["Cantidad_maxima"],$body["Cantidad_minima"]);
                echo json_encode("Producto actualizado");
            break;
            case "DeleteProducto":
                $datos=$productos->delete_producto($body["Id_Producto"]);
                echo json_encode("Producto eliminado");
            break;
            //Datos de otra tabla
            case "GetTipoProductos":
                $datos=$productos->get_tipoproductos();
                echo json_encode($datos);
            break;            
        }

?>