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
        require_once '../models/TipoMovimientoMM.php';

        $tiposMovimientosMM = new TipoMovimientoMM();
 
        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoMovimientosMM":
                $datos=$tiposMovimientosMM->get_TipoMovimientosMM();

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoMovimientoMM(\'' .$datos[$i]['Id_Tipo_Movimiento']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoMovimientoMM(\'' .$datos[$i]['Id_Tipo_Movimiento']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
               
                echo json_encode($datos);
            break;
            case "GetTipoMovimientoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Descripcion"]) ? $body["Descripcion"] : (isset($body["Id_Tipo_Movimiento"]) ? $body["Id_Tipo_Movimiento"] : '');
                $datos=$tiposMovimientosMM->get_TipoMovimientoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetTipoMovimientoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposMovimientosMM->get_TipoMovimientoMMeditar($body["Id_Tipo_Movimiento"]);
                echo json_encode($datos);
            break;
            case "InsertTipoMovimientoMM":
                $selectTipo=$tiposMovimientosMM->selectTipo($body['Descripcion']);

                if (count($selectTipo)>0) {
                    $arrResponse = array("status" => false, "msg" => 'El tipo de movimiento ya existe');
                }else{
                    $datos=$tiposMovimientosMM->insert_TipoMovimientoMM($body["Descripcion"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó el  tipo de movimiento');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposMovimientosMM->get_user($varsesion));
                $tiposMovimientosMM->registrar_bitacora($Id_Usuario, 49, 'Insertar', 'Se insertó un Tipo de Movimiento');
            break;
            case "UpdateTipoMovimientoMM":
                $nombreTipo=$body['Descripcion'];
                $idTipo=$body['Id_Tipo_Movimiento'];

                $selectTipo=$tiposMovimientosMM->selectTipo2($nombreTipo,$idTipo);
                
                if (count($selectTipo)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'El tipo de movimiento ya existe');

                }else{
                    $datos=$tiposMovimientosMM->update_TipoMovimientoMM($nombreTipo,$idTipo);
                    $arrResponse = array("status" => true, "msg" => 'Tipo producto Actualizado Correctamente');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposMovimientosMM->get_user($varsesion));
                $tiposMovimientosMM->registrar_bitacora($Id_Usuario, 49, 'Actualizar', 'Se actualizó un Tipo de Movimiento');
            break;
            case "DeleteTipoMovimientoMM":
                $datos=$tiposMovimientosMM->delete_TipoMovimientoMM($body["Id_Tipo_Movimiento"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposMovimientosMM->get_user($varsesion));
                $tiposMovimientosMM->registrar_bitacora($Id_Usuario, 49, 'Eliminar', 'Se eliminó un Tipo de Movimiento');
                echo json_encode("Cargo Eliminado");
            break;
        }

?>    
