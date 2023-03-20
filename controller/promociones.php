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
        require_once '../models/Promociones.php';

        $promociones = new Promociones();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPromociones":
                $datos=$promociones->get_promociones();
                echo json_encode($datos);
            break;
            case "GetPromocion":  //Busca los datos por nombre y id
                $busqueda = isset($body["Nombre_Promocion"]) ? $body["Nombre_Promocion"] : $body["Id_Promocion"];
                
                // Verificar si la búsqueda es un número o una cadena
                if (is_numeric($busqueda)) {
                    $datos = $promociones->get_promocion($busqueda, "Id_Promocion");
                } else {
                    $datos = $promociones->get_promocion($busqueda, "Nombre_Promocion");
                }
            
                echo json_encode($datos);
            break;
            case "GetPromocioneditar": //Trae la fila que se va a editar
                $datos=$promociones->get_promocioneditar($body["Id_Promocion"]);
                echo json_encode($datos);
            break;
            case "InsertPromocion":
                $datos=$promociones->insert_promocion($body["Nombre_Promocion"],$body["Precio_Venta"],$body["Fecha_inicio"],$body["Fecha_final"]);
                echo json_encode("Se agregó la promoción");
            break;
            case "UpdatePromocion":
                $datos=$promociones->update_promocion($body["Id_Promocion"],$body["Nombre_Promocion"],$body["Precio_Venta"],$body["Fecha_inicio"],$body["Fecha_final"]);
                echo json_encode("Promoción Actualizada");
            break;
            case "DeletePromocion":
                $datos=$promociones->delete_promocion($body["Id_Promocion"]);
                echo json_encode("Promoción Eliminada");
            break;
        }

?>   