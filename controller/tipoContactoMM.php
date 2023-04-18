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
        require_once '../models/TipoContactoMM.php';

        $tiposContactosMM = new TipoContactoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoContactosMM":
                $datos=$tiposContactosMM->get_TipoContactosMM();
                 //ciclo for para insertar los botontes en cada opción
                 for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoContactoMM(\'' .$datos[$i]['Id_Tipo_Contacto']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoContactoMM(\'' .$datos[$i]['Id_Tipo_Contacto']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposContactosMM->get_user($varsesion));
                $tiposContactosMM->registrar_bitacora($Id_Usuario, 48, 'Ingresar', 'Se ingresó a la pantalla de Tipos de contactos');
                echo json_encode($datos);
            break;
            case "GetTipoContactoMM":
                $busqueda = isset($body["Nombre_tipo_contacto"]) ? $body["Nombre_tipo_contacto"] : (isset($body["Id_Tipo_Contacto"]) ? $body["Id_Tipo_Contacto"] : '');
                $datos=$tiposContactosMM->get_TipoContactoMM($busqueda); 
                echo json_encode($datos);
            break;
            case "GetTipoContactoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposContactosMM->get_TipoContactoMMeditar($body["Id_Tipo_Contacto"]);
                echo json_encode($datos);
            break;
            case "InsertTipoContactoMM":
                $datos=$tiposContactosMM->insert_TipoContactoMM($body["Nombre_tipo_contacto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposContactosMM->get_user($varsesion));
                $tiposContactosMM->registrar_bitacora($Id_Usuario, 48, 'Insertar', 'Se insertó un tipo de contacto');
                echo json_encode("Se agregó el  tipo de contacto");
            break;
            case "UpdateTipoContactoMM":
                $datos=$tiposContactosMM->update_TipoContactoMM($body["Id_Tipo_Contacto"],$body["Nombre_tipo_contacto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposContactosMM->get_user($varsesion));
                $tiposContactosMM->registrar_bitacora($Id_Usuario, 48, 'Actualizar', 'Se actualizó un tipo de contacto');
                echo json_encode("Tipo de contacto Actualizado");
            break;
            case "DeleteTipoContactoMM":
                $datos=$tiposContactosMM->delete_TipoContactoMM($body["Id_Tipo_Contacto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposContactosMM->get_user($varsesion));
                $tiposContactosMM->registrar_bitacora($Id_Usuario, 48, 'Eliminar', 'Se eliminó un tipo de contacto');
                echo json_encode("Tipo de contacto Eliminado");
            break; 
        }

?>   
 