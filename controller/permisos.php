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
        require_once '../models/Permisos.php';

        $permisos = new Permiso();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPermisos":
                $datos=$permisos->get_permisos();
                echo json_encode($datos);
            break;
            case "GetPermiso": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Permisos"]) ? $body["Id_Permisos"] : '');
                $datos = $permisos->get_permiso($busqueda);
                echo json_encode($datos);
            break;
            case "GetPermisoeditar": //Trae la fila que se va a editar
                $datos=$permisos->get_permisoeditar($body["Id_Permisos"]);
                echo json_encode($datos);
            break;
            case "InsertPermiso":
                $datos=$permisos->insert_permiso($body["Id_Rol"],$body["Id_Objeto"],$body["Permiso_insercion"],$body["Permiso_eliminacion"],$body["Permiso_actualizacion"],$body["Permiso_consultar"]);
                echo json_encode("Se agregaron los permisos");
            break;
            case "UpdatePermiso":
                $datos=$permisos->update_permiso($body["Id_Permisos"],$body["Id_Rol"],$body["Id_Objeto"],$body["Permiso_insercion"],$body["Permiso_eliminacion"],$body["Permiso_actualizacion"],$body["Permiso_consultar"]);
                echo json_encode("Permisos Actualizados");
            break;
            case "DeletePermiso":
                $datos=$permisos->delete_permiso($body["Id_Permisos"]);
                echo json_encode("Permisos Eliminadoss");
            break;
            //Datos de otra tabla
            case "GetRoles":
                $datos=$permisos->get_roles();
                echo json_encode($datos);
            break;
            case "GetObjetos":
                $datos=$permisos->get_objetos();
                echo json_encode($datos);
            break;
        }

?>   
