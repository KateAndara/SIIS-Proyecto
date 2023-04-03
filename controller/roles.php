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
        require_once '../models/Roles.php';

        $roles = new Rol();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetRoles":
                $datos=$roles->get_roles();
                echo json_encode($datos);
            break;
            case "GetRol": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Rol"]) ? $body["Id_Rol"] : '');
            
                $datos = $roles->get_rol($busqueda);
            
                echo json_encode($datos);
            break;
            case "GetRoleditar": //Trae la fila que se va a editar
                $datos=$roles->get_roleditar($body["Id_Rol"]);
                echo json_encode($datos);
            break;
            case "InsertRol":
                $datos=$roles->insert_rol($body["Rol"],$body["Descripcion"]);
                echo json_encode("Se agregó el rol");
            break;
            case "UpdateRol":
                $datos=$roles->update_rol($body["Id_Rol"],$body["Rol"],$body["Descripcion"]);
                echo json_encode("Rol Actualizado");
            break;
            case "DeleteRol":
                $datos=$roles->delete_rol($body["Id_Rol"]);
                echo json_encode("Rol Eliminado");
            break;
        }

?>   
