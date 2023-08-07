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
        require_once '../models/EspeciesMM.php';

        $especiesMM = new EspeciesMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetEspeciesMM":
                $datos=$especiesMM->get_EspeciesMM();

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEspecieMM(\''.$datos[$i]['Id_Especie']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEspecieMM(\'' .$datos[$i]['Id_Especie']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }

                
                echo json_encode($datos);
            break;
            case "GetEspecieMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre_Especie"]) ? $body["Nombre_Especie"] : (isset($body["Id_Especie"]) ? $body["Id_Especie"] : '');
                $datos=$especiesMM->get_EspecieMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetEspecieMMeditar": //Trae la fila que se va a editar
                $datos=$especiesMM->get_EspecieMMeditar($body["Id_Especie"]);
                echo json_encode($datos);
            break;
            case "InsertEspecieMM":

                //validar Nombre Especie

                $selectEspecie=$especiesMM->selectEspecie($body['Nombre_Especie']);


                if (count($selectEspecie)>0) {
                    $arrResponse = array("status" => false, "msg" => 'La especie ya existe');
                }else{
                    $datos=$especiesMM->insert_EspecieMM($body["Nombre_Especie"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó la  especie');

                }

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($especiesMM->get_user($varsesion));
                $especiesMM->registrar_bitacora($Id_Usuario, 53, 'Insertar', 'Se insertó la especie: '.$body['Nombre_Especie']);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                
            break;
            case "UpdateEspecieMM":

                $nombreEspecie=$body['Nombre_Especie'];
                $idEspecie=$body['Id_Especie'];
                
                $selectEspecie=$especiesMM->selectEspecie2($nombreEspecie,$idEspecie);

                if (count($selectEspecie)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'La especie ya existe');

                 
                    
    
                }else{
                    $datos=$especiesMM->update_EspecieMM($nombreEspecie,$idEspecie);                    
                    $arrResponse = array("status" => true, "msg" => 'Especie Actualizada Correctamente');

                }

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($especiesMM->get_user($varsesion));
                $especiesMM->registrar_bitacora($Id_Usuario, 53, 'Actualizar', 'Se actualizó la especie a: '.$body['Nombre_Especie']);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "DeleteEspecieMM":
                $Id_Especie = $body["Id_Especie"];
                $nombreEspecie = $especiesMM->especieeliminar($Id_Especie); // Obtener el nombre de la especie antes de eliminarla
                $datos = $especiesMM->delete_EspecieMM($Id_Especie);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($especiesMM->get_user($varsesion));
                $especiesMM->registrar_bitacora($Id_Usuario, 53, 'Eliminar', 'Se eliminó la Especie: ' . $nombreEspecie); // Usar el nombre de la especie eliminada en la bitácora
                echo json_encode("Especie Eliminada");
            break;
            
        }

?>   
