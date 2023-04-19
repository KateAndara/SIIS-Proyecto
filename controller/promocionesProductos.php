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
        require_once '../models/PromocionesProductos.php';

        $promocionesproductos = new PromocionesProductos();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPromocionesProductos":
                $datos=$promocionesproductos->get_promocionesProductos();
                
                echo json_encode($datos);
            break;

            case "InsertPromocionProducto":
                $datos = $promocionesproductos->insert_promocionProducto($body["Id_Producto"], $body["Id_Promocion"], $body["Cantidad"]);
                echo json_encode("Se agregó la promoción al producto");
            break;

            case "GetPromocionProductoeditar": //Trae la fila que se va a editar
                $datos=$promocionesproductos->get_promocionProductoEditar($body["Id_Promocion_Producto"]);
                echo json_encode($datos);
            break;

            case "UpdatePromocionProducto":
                $datos=$promocionesproductos->update_promocionProducto($body["Id_Promocion_Producto"],$body["Id_Producto"],$body["Id_Promocion"], $body["Cantidad"]);
                echo json_encode("Promoción Actualizada");
            break;

            case "DeletePromocionProducto":
                $datos=$promocionesproductos->delete_promocionProducto($body["Id_Promocion_Producto"]);
                echo json_encode("Promoción Eliminada");
            break;

            case "GetProductosTerminados":
                $datos=$promocionesproductos->get_productosTerminados();
                echo json_encode($datos);
            break;

            case "GetPromociones":
                $datos=$promocionesproductos->get_promociones();
                echo json_encode($datos);
            break;
        }
?>  