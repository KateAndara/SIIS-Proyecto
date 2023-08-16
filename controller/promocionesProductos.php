<?php
    session_start();

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
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promocionesproductos->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_promocionesproductos'])) {
                    $promocionesproductos->registrar_bitacora($Id_Usuario, 54, 'Ingresar', 'Se ingresó a la pantalla de promociones de productos ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_promocionesproductos'] = true;
                }
                echo json_encode($datos);
            break;

            case "InsertPromocionProducto":
                $datos = $promocionesproductos->insert_promocionProducto($body["Id_Producto"], $body["Id_Promocion"], $body["Cantidad"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promocionesproductos->get_user($varsesion));

                // Obtener el nombre de la promoción usando $body["Id_Promocion"]
                $nombre_promocion = obtenerNombrePromocion($body["Id_Promocion"]);

                // Obtener el nombre del producto usando $body["Id_Producto"]
                $nombre_producto = obtenerNombreProducto($body["Id_Producto"]);

                // Construir el mensaje de registro
                $mensaje_registro = 'Se insertó la promoción "' . $nombre_promocion . '" al producto "' . $nombre_producto . '" con cantidad de ' . $body["Cantidad"];

                // Registrar en la bitácora
                $promocionesproductos->registrar_bitacora($Id_Usuario, 54, 'Insertar', $mensaje_registro);

                echo json_encode("Se agregó la promoción al producto");
            break;

            case "GetPromocionProductoeditar": //Trae la fila que se va a editar
                $datos=$promocionesproductos->get_promocionProductoEditar($body["Id_Promocion_Producto"]);
                echo json_encode($datos);
            break;

            case "UpdatePromocionProducto":
                $datos=$promocionesproductos->update_promocionProducto($body["Id_Promocion_Producto"],$body["Id_Producto"],$body["Id_Promocion"], $body["Cantidad"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promocionesproductos->get_user($varsesion));
                $nombre_promocion = obtenerNombrePromocion($body["Id_Promocion"]);
                $nombre_producto = obtenerNombreProducto($body["Id_Producto"]);

                $promocionesproductos->registrar_bitacora($Id_Usuario, 54, 'Actualizar', 'Se actualizó la promoción : ' . $nombre_promocion.' al producto '.$nombre_producto);

                echo json_encode("Promoción Actualizada");
            break;

            case "DeletePromocionProducto":
                $datos=$promocionesproductos->delete_promocionProducto($body["Id_Promocion_Producto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promocionesproductos->get_user($varsesion));
                $nombre_promocion = obtenerNombrePromocion($body["Id_Promocion"]);
                $promocionesproductos->registrar_bitacora($Id_Usuario, 54, 'Eliminar', 'Se eliminó la promoción : ' . $nombre_promocion.' al producto '.$nombre_producto);
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