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
        require_once '../models/Descuentos.php';

        $descuentos = new Descuentos();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetDescuentos":
                $datos=$descuentos->get_descuentos();
                echo json_encode($datos);
            break;
            case "GetDescuento":  //Busca los datos por nombre y id
                $busqueda = isset($body["Nombre_descuento"]) ? $body["Nombre_descuento"] : $body["Id_Descuento"];
                
                // Verificar si la búsqueda es un número o una cadena
                if (is_numeric($busqueda)) {
                    $datos = $descuentos->get_descuento($busqueda, "Id_Descuento");
                } else {
                    $datos = $descuentos->get_descuento($busqueda, "Nombre_descuento");
                }
            
                echo json_encode($datos);
            break;
            case "GetDescuentoeditar": //Trae la fila que se va a editar
                $datos=$descuentos->get_descuentoeditar($body["Id_Descuento"]);
                echo json_encode($datos);
            break;
            case "InsertDescuento":
                $datos=$descuentos->insert_descuento($body["Nombre_descuento"],$body["Porcentaje_a_descontar"]);
                echo json_encode("Se agregó el descuento");
            break;
            case "UpdateDescuento":
                $datos=$descuentos->update_descuento($body["Id_Descuento"],$body["Nombre_descuento"],$body["Porcentaje_a_descontar"]);
                echo json_encode("Descuento Actualizado");
            break;
            case "DeletePromocion":
                $datos=$descuentos->delete_descuento($body["Id_Descuento"]);
                echo json_encode("Descuento Eliminado");
            break;
        }

?>   