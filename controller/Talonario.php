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
        require_once '../models/Talonario.php';

        $talonario = new Talonario();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTalonarios":
                $datos=$talonario->get_Talonarios();
            
                echo json_encode($datos);
            break;
            case "urlEditarTalonario": //Trae la fila que se va a editar
                $datos=$talonario->get_roleditar($body["idTalonario"]);
        
                echo json_encode($datos);
            break;
            case "insertTalonario":
              

                $numCai=$body['numCai'];
                $rangeInicial=$body['rangeInicial'];
                $rangeFinal=$body['rangeFinal'];
                $rangeActual=$body['rangeActual'];
                $dateVencimiento=$body['dateVencimiento'];
                $idPersona=$_SESSION['Id_Usuario'];
                

                $selectTalonario=$talonario->selectTalonario($numCai);

               
                if (count($selectTalonario)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'Número CAI ya existe');

                 
                    
    
                }else{
                    $datos=$talonario->insert_talonario($idPersona,$numCai,$rangeInicial,$rangeFinal,$rangeActual,$dateVencimiento);
                    

                    
                    $arrResponse = array("status" => true, "msg" => 'Talonario Guardado Correctamente');

                }
               
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "UpdateTalonario": 

              

                $idTalonario=$body['idTalonario'];

                $numCai=$body['numCai'];
                $rangeInicial=$body['rangeInicial'];
                $rangeFinal=$body['rangeFinal'];
                $rangeActual=$body['rangeActual'];
                $dateVencimiento=$body['dateVencimiento'];
                $idPersona=$_SESSION['Id_Usuario'];


                
                $selectTalonario=$talonario->selectTalonario($numCai);

               
                if (count($selectTalonario)>=1 && $selectTalonario[0]['Numero_CAI']!=$numCai) {

                    $arrResponse = array("status" => false, "msg" => 'Número CAI ya existe');

                 
                    
    
                }else{
                    $datos=$talonario->update_Talonario($idTalonario,$numCai,$rangeInicial,$rangeFinal,$rangeActual,$dateVencimiento);
                    

                    
                    $arrResponse = array("status" => true, "msg" => 'Talonario Actualizado Correctamente');

                }



               
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "deleteTalonario":
                $datos=$talonario->delete_Talonario($body["idTalonario"]);
                echo json_encode("Talonario Eliminado Correctamente");
            break;
        }

?>   
