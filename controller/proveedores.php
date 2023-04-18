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
        require_once '../models/Proveedores.php';

        $proveedores = new Proveedor();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetProveedores":
                $datos=$proveedores->get_proveedores();
                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargaProveedor(\'' .$datos[$i]['Id_Proveedor'].'\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarProveedor(\'' .$datos[$i]['Id_Proveedor'].'\')">Eliminar</button>';
                    }
                
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($proveedores->get_user($varsesion));
                $proveedores->registrar_bitacora($Id_Usuario, 30, 'Ingresar', 'Se ingresó a la pantalla de Proveedores');
                echo json_encode($datos);
            break;
            case "GetProveedor": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Proveedor"]) ? $body["Id_Proveedor"] : '');
            
                $datos = $proveedores->get_proveedor($busqueda);
            
                echo json_encode($datos);
            break;
            case "GetProveedoreditar": //Trae la fila que se va a editar
                $datos=$proveedores->get_proveedoreditar($body["Id_Proveedor"]);
                echo json_encode($datos);
            break;
            case "InsertProveedor":
                $datos=$proveedores->insert_proveedor($body["Nombre"],$body["RTN"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($proveedores->get_user($varsesion));
                $proveedores->registrar_bitacora($Id_Usuario, 30, 'Insertar', 'Se insertó un nuevo proveedor');
                echo json_encode("Se agregó el proveedor");
            break;
            case "UpdateProveedor":
                $datos=$proveedores->update_proveedor($body["Id_Proveedor"],$body["Nombre"],$body["RTN"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($proveedores->get_user($varsesion));
                $proveedores->registrar_bitacora($Id_Usuario, 30, 'Actualizar', 'Se actualizó un proveedor');
                echo json_encode("Proveedor Actualizado");
            break;
            case "DeleteProveedor":
                $datos=$proveedores->delete_proveedor($body["Id_Proveedor"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($proveedores->get_user($varsesion));
                $proveedores->registrar_bitacora($Id_Usuario, 30, 'Eliminar', 'Se eliminó un proveedor');
                echo json_encode("Proveedor Eliminado");
            break;
        }

?>   