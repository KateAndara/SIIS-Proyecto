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
        require_once '../models/Preguntas.php';
       

        $Preguntas = new Pregunta();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPreguntas":
                $datos=$Preguntas->get_preguntas();
                echo json_encode($datos);
            break;
            case "GetPregunta":
                $busqueda = isset($body["Pregunta"]) ? $body["Pregunta"] : (isset($body["Id_Pregunta"]) ? $body["Id_Pregunta"] : '');
                $datos=$Preguntas->get_pregunta($body[$busqueda]);
                echo json_encode($datos);
            break;
            case "GetPreguntaeditar": //Trae la fila que se va a editar
                $datos=$Preguntas->get_preguntaeditar($body["Id_Pregunta"]);
                echo json_encode($datos);
            break;
            case "InsertPregunta":
                $datos=$Preguntas->insert_pregunta($body["Pregunta"]);
                echo json_encode("Se agregó la pregunta");
            break;
            case "UpdatePregunta":
                $datos=$Preguntas->update_pregunta($body["Id_Pregunta"],$body["Pregunta"]);
                echo json_encode("Pregunt Actualizada");
            break;
            case "DeletePregunta":
                $datos=$Preguntas->delete_pregunta($body["Id_Pregunta"]);
                echo json_encode("Pregunta Eliminada");
            break;
        }

?>   
