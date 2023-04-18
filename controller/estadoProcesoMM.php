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
        require_once '../models/EstadoProcesoMM.php';

        $estadosProcesosMM = new EstadoProcesoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetEstadoProcesosMM": 
                $datos=$estadosProcesosMM->get_EstadoProcesosMM();
                    //ciclo for para insertar los botontes en cada opción
                    for ($i=0; $i < count($datos); $i++) { 

                        //variable de los botones
                        $btnView = '';
                        $btnEdit = '';
                        $btnDelete = '';

                        

                        //si permisos es igual a Permiso_actualizacion de update crea el boton
                        if($_SESSION['permisosMod']['u']){
                            $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoProcesoMM(\'' .$datos[$i]['Id_Estado_Proceso'].  '\'); mostrarFormulario();">Editar</button>';
                        }
                            //si permisos es igual a Permiso_eliminacion de delete crea el boton

                        if($_SESSION['permisosMod']['d']){
                            $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoProcesoMM(\'' .$datos[$i]['Id_Estado_Proceso']. '\')">Eliminar</button>';
                        }
                    
                        
                        //unimos los botontes
                        $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                    }

                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($estadosProcesosMM->get_user($varsesion));
                    $estadosProcesosMM->registrar_bitacora($Id_Usuario, 50, 'Ingresar', 'Se ingresó a la pantalla del Estado del proceso');
                echo json_encode($datos);
            break;
            case "GetEstadoProcesoMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Descripcion"]) ? $body["Descripcion"] : (isset($body["Id_Estado_Proceso"]) ? $body["Id_Estado_Proceso"] : '');
                $datos=$estadosProcesosMM->get_EstadoProcesoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetEstadoProcesoMMeditar": //Trae la fila que se va a editar
                $datos=$estadosProcesosMM->get_EstadoProcesoMMeditar($body["Id_Estado_Proceso"]);
                echo json_encode($datos);
            break;
            case "InsertEstadoProcesoMM":
                $datos=$estadosProcesosMM->insert_EstadoProcesoMM($body["Descripcion"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosProcesosMM->get_user($varsesion));
                $estadosProcesosMM->registrar_bitacora($Id_Usuario, 50, 'Insertar', 'Se insertó un nuevo Estado para el proceso');
                echo json_encode("Se agregó el Estado del proceso");
            break;
            case "UpdateEstadoProcesoMM":
                $datos=$estadosProcesosMM->update_EstadoProcesoMM($body["Id_Estado_Proceso"],$body["Descripcion"]);
                $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($estadosProcesosMM->get_user($varsesion));
                    $estadosProcesosMM->registrar_bitacora($Id_Usuario, 50, 'Actualizar', 'Se actualizó un Estado del proceso');
                echo json_encode("Estado del proceso Actualizado");
            break;
            case "DeleteEstadoProcesoMM":
                $datos=$estadosProcesosMM->delete_EstadoProcesoMM($body["Id_Estado_Proceso"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosProcesosMM->get_user($varsesion));
                $estadosProcesosMM->registrar_bitacora($Id_Usuario, 50, 'Eliminar', 'Se eliminó un Estado para el proceso');
                echo json_encode("Estado del proceso Eliminado");
            break;
        }

?>   
