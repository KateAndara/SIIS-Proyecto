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
        require_once '../models/Parametros.php';

        $Parametros = new Parametro();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetParametros":
                $datos=$Parametros->get_parametros();
                echo json_encode($datos);
            break;
            case "GetParametro":
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Parametro"]) ? $body["Id_Parametro"] : '');
                $datos=$Parametros->get_parametro($body[$busqueda]);
                echo json_encode($datos);
            break;
            case "GetParametroeditar": //Trae la fila que se va a editar
                $datos=$Parametros->get_parametroeditar($body["Id_Parametro"]);
                echo json_encode($datos);
            break;
            /*case "InsertParametro":
                $datos=$Parametros->insert_parametro($body["Parametro"],$body["Valor"]);
                echo json_encode("Se agregó el parámetro");
            break;*/
            case "UpdateParametro":
                $datos=$Parametros->update_parametro($body["Id_Parametro"],$body["Parametro"],$body["Valor"]);
                echo json_encode("Parámetro Actualizado");
            break;
            /*case "DeleteParametro":
                $datos=$Parametros->delete_parametro($body["Id_Parametro"]);
                echo json_encode("Parámetro Eliminado");
            break;*/
        }

?>   
