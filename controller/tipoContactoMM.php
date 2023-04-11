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
        require_once '../models/TipoContactoMM.php';

        $tiposContactosMM = new TipoContactoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoContactosMM":
                $datos=$tiposContactosMM->get_TipoContactosMM();
                echo json_encode($datos);
            break;
            case "GetTipoContactoMM":
                $busqueda = isset($body["Nombre_tipo_contacto"]) ? $body["Nombre_tipo_contacto"] : (isset($body["Id_Tipo_Contacto"]) ? $body["Id_Tipo_Contacto"] : '');
                $datos=$tiposContactosMM->get_TipoContactoMM($busqueda); 
                echo json_encode($datos);
            break;
            case "GetTipoContactoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposContactosMM->get_TipoContactoMMeditar($body["Id_Tipo_Contacto"]);
                echo json_encode($datos);
            break;
            case "InsertTipoContactoMM":
                $datos=$tiposContactosMM->insert_TipoContactoMM($body["Nombre_tipo_contacto"]);
                echo json_encode("Se agregó el  tipo de contacto");
            break;
            case "UpdateTipoContactoMM":
                $datos=$tiposContactosMM->update_TipoContactoMM($body["Id_Tipo_Contacto"],$body["Nombre_tipo_contacto"]);
                echo json_encode("Tipo de contacto Actualizado");
            break;
            case "DeleteTipoContactoMM":
                $datos=$tiposContactosMM->delete_TipoContactoMM($body["Id_Tipo_Contacto"]);
                echo json_encode("Tipo de contacto Eliminado");
            break; 
        }

?>   
 