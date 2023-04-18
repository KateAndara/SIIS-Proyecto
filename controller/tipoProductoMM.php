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
        require_once '../models/TipoProductoMM.php';

        $tiposProductosMM = new TipoProductoMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetTipoProductosMM":
                $datos=$tiposProductosMM->get_TipoProductosMM();

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarTipoProductoMM(\'' .$datos[$i]['Id_Tipo_Producto']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarTipoProductoMM(\'' .$datos[$i]['Id_Tipo_Producto']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposProductosMM->get_user($varsesion));
                $tiposProductosMM->registrar_bitacora($Id_Usuario, 44, 'Ingresar', 'Se ingresó a la pantalla de Tipos de productos');
                echo json_encode($datos);
            break;
            case "GetTipoProductoMM":
                $busqueda = isset($body["Nombre_tipo"]) ? $body["Nombre_tipo"] : (isset($body["Id_Tipo_Producto"]) ? $body["Id_Tipo_Producto"] : '');
                $datos=$tiposProductosMM->get_TipoProductoMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetTipoProductoMMeditar": //Trae la fila que se va a editar
                $datos=$tiposProductosMM->get_TipoProductoMMeditar($body["Id_Tipo_Producto"]);
                echo json_encode($datos);
            break;
            case "InsertTipoProductoMM":
                $selectTipo=$tiposProductosMM->selectTipo($body['Nombre_tipo']);

                if (count($selectTipo)>0) {
                    $arrResponse = array("status" => false, "msg" => 'El tipo de producto ya existe');
                }else{
                    $datos=$tiposProductosMM->insert_TipoProductoMM($body["Nombre_tipo"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó el  tipo de producto');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposProductosMM->get_user($varsesion));
                $tiposProductosMM->registrar_bitacora($Id_Usuario, 44, 'Insertar', 'Se insertó un tipo de producto');
            break;
            case "UpdateTipoProductoMM":
                $nombreTipo=$body['Nombre_tipo'];
                $idTipo=$body['Id_Tipo_Producto'];

                $selectTipo=$tiposProductosMM->selectTipo2($nombreTipo,$idTipo);
                
                if (count($selectTipo)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'El tipo de producto ya existe');

                }else{
                    $datos=$tiposProductosMM->update_TipoProductoMM($nombreTipo,$idTipo);
                    $arrResponse = array("status" => true, "msg" => 'Tipo producto Actualizado Correctamente');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposProductosMM->get_user($varsesion));
                $tiposProductosMM->registrar_bitacora($Id_Usuario, 44, 'Actualizar', 'Se actualizó un tipo de producto');
            break;
            case "DeleteTipoProductoMM":
                $datos=$tiposProductosMM->delete_TipoProductoMM($body["Id_Tipo_Producto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($tiposProductosMM->get_user($varsesion));
                $tiposProductosMM->registrar_bitacora($Id_Usuario, 44, 'Eliminar', 'Se eliminó un tipo de producto');
                echo json_encode("Tipo De Producto Eliminado");
            break; 
        }

?>   
