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
            //ciclo for para insertar los botontes en cada opción
            for ($i=0; $i < count($datos); $i++) { 

                //variable de los botones
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                

                //si permisos es igual a Permiso_actualizacion de update crea el boton
                if($_SESSION['permisosMod']['u']){
                    $btnEdit = '<button class="rounded mr-2" style=" background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEditarTalonario(\'' .$datos[$i]['Id_Talonario']."'); mostrarFormulario();\">Editar</button>'";
                }
                    //si permisos es igual a Permiso_eliminacion de delete crea el boton

                if($_SESSION['permisosMod']['d']){
                    $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTalonario(\'' .$datos[$i]['Id_Talonario']."')\">Eliminar</button>'";
                }
              
                
                //unimos los botontes
                $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

            }
               
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
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($talonario->get_user($varsesion));
                $talonario->registrar_bitacora($Id_Usuario, 45, 'Insertar', 'Se insertó un nuevo registro de Talonario: '.$body['numCai'].' con rango inicial '.$body['rangeInicial'].' y rango final '.$body['rangeFinal']);
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



                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($talonario->get_user($varsesion));
                $talonario->registrar_bitacora($Id_Usuario, 45, 'Actualizar', 'Se actualizó un registro de Talonario con número '.$body['numCai'].' con rango inicial '.$body['rangeInicial'].' y rango final '.$body['rangeFinal']);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "deleteTalonario":
                $idTalonario = $body["idTalonario"];
                $nombreTalonario = $talonario->talonarioeliminar($idTalonario); // Obtener el nombre del talonario antes de eliminarlo
                $datos = $talonario->delete_Talonario($idTalonario);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($talonario->get_user($varsesion));
                $talonario->registrar_bitacora($Id_Usuario, 45, 'Eliminar', 'Se eliminó el Talonario: ' . $nombreTalonario); // Usar el nombre del talonario eliminado en la bitácora
                echo json_encode("Talonario Eliminado Correctamente");
            break;
            
        }

?>   
