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
        require_once '../models/CargosMM.php';

        $cargosMM = new CargosMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetCargosMM":
                $datos=$cargosMM->get_CargosMM();

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCargoMM(\''.$datos[$i]['Id_Cargo']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCargoMM(\'' .$datos[$i]['Id_Cargo']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }

                echo json_encode($datos);
            break;
            case "GetCargoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre_cargo"]) ? $body["Nombre_cargo"] : (isset($body["Id_Cargo"]) ? $body["Id_Cargo"] : '');
                $datos=$cargosMM->get_CargoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetCargoMMeditar": //Trae la fila que se va a editar
                $datos=$cargosMM->get_CargoMMeditar($body["Id_Cargo"]);
                echo json_encode($datos);
            break;
            case "InsertCargoMM":

                //validar Nombre Cargo

                $selectCargo=$cargosMM->selectCargo($body['Nombre_cargo']);


                if (count($selectCargo)>0) {
                    $arrResponse = array("status" => false, "msg" => 'El cargo ya existe');
                }else{
                    $datos=$cargosMM->insert_CargoMM($body["Nombre_cargo"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó el  Cargo');

                }

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($cargosMM->get_user($varsesion));
                $cargosMM->registrar_bitacora($Id_Usuario, 42, 'Insertar', 'Se insertó un cargo');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                
            break;
            case "UpdateCargoMM":
                //$datos=$cargosMM->update_CargoMM($body["Id_Cargo"],$body["Nombre_cargo"]);
                //echo json_encode("Cargo Actualizado");

                $nombrecargo=$body['Nombre_cargo'];
                $idCargo=$body['Id_Cargo'];


               
                
                $selectCargo=$cargosMM->selectCargo2($nombrecargo,$idCargo);

               
                if (count($selectCargo)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'El cargo ya existe');

                 
                    
    
                }else{
                    $datos=$cargosMM->update_CargoMM($nombrecargo,$idCargo);
                    //$datos=$cargosMM->update_CargoMM($body["Id_Cargo"],$body["Nombre_cargo"]);


                    
                    $arrResponse = array("status" => true, "msg" => 'Cargo Actualizado Correctamente');

                }



                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($cargosMM->get_user($varsesion));
                $cargosMM->registrar_bitacora($Id_Usuario, 42, 'Actualizar', 'Se actualizó un cargo');
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "DeleteCargoMM":
                $datos=$cargosMM->delete_CargoMM($body["Id_Cargo"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($cargosMM->get_user($varsesion));
                $cargosMM->registrar_bitacora($Id_Usuario, 42, 'Eliminar', 'Se eliminó un cargo');
                echo json_encode("Cargo Eliminado");
            break;
        }

?>   
