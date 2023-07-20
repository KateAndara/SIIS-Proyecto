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
        require_once '../models/Objetos.php';

        $Objetos = new Objeto();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetObjetos":
                $datos=$Objetos->get_objetos();
                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    /*if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarObjeto(\'' .$datos[$i]['Id_Objeto'].'\'); mostrarFormulario();">Editar</button>';
                    }*/
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                   /* if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarObjeto(\'' .$datos[$i]['Id_Objeto'].'\')">Eliminar</button>';
                    }
                */
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }

                
                echo json_encode($datos);
            break;
            case "GetObjeto":
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Objeto"]) ? $body["Id_Objeto"] : '');
                $datos=$Objetos->get_objeto($body[$busqueda]);
                echo json_encode($datos);
            break;
            case "GetObjetoeditar": //Trae la fila que se va a editar
                $datos=$Objetos->get_objetoeditar($body["Id_Objeto"]);
                echo json_encode($datos);
            break;
            case "InsertObjeto":
                $datos=$Objetos->insert_objeto($body["Objeto"],$body["Descripcion"],$body["Tipo_objeto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Objetos->get_user($varsesion));
                $Objetos->registrar_bitacora($Id_Usuario, 41, 'Insertar', 'Se insertó un objeto');
                echo json_encode("Se agregó el objeto");
            break;
            case "UpdateObjeto":
                $datos=$Objetos->update_objeto($body["Id_Objeto"],$body["Objeto"],$body["Descripcion"],$body["Tipo_objeto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Objetos->get_user($varsesion));
                $Objetos->registrar_bitacora($Id_Usuario, 41, 'Actualizar', 'Se actualizó un objeto');
                echo json_encode("Objeto Actualizado");
            break;
            case "DeleteObjeto":
                $datos=$Objetos->delete_objeto($body["Id_Objeto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Objetos->get_user($varsesion));
                $Objetos->registrar_bitacora($Id_Usuario, 41, 'Eliminar', 'Se eliminó un objeto');
                echo json_encode("Objeto Eliminado");
            break;
        }

?>   
