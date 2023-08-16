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
        require_once '../models/EstadoVentaMM.php';

        $estadosVentasMM = new EstadoVentaMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetEstadosVentaMM":
                $datos=$estadosVentasMM->get_EstadosVentaMM();


                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarEstadoVentaMM(\'' .$datos[$i]['Id_Estado_Venta']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarEstadoVentaMM(\''.$datos[$i]['Id_Estado_Venta']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                //Bitácora

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));

                if (!isset($_SESSION['ingreso_registrado_pantalla_estadosventa'])) {
                    $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Ingresar', 'Se ingresó a la pantalla de estados de venta ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_estadosventa'] = true;
                }
                echo json_encode($datos);
            break;

            case "GetEstadoVentaMM":
                $busqueda = isset($body["Nombre_estado"]) ? $body["Nombre_estado"] : (isset($body["Id_Estado_Venta"]) ? $body["Id_Estado_Venta"] : '');
                $datos=$estadosVentasMM->get_EstadoVentaMM($busqueda);
                echo json_encode($datos);
            break;

            case "GetEstadoVentaMMeditar": //Trae la fila que se va a editar
                $datos=$estadosVentasMM->get_EstadoVentaMMeditar($body["Id_Estado_Venta"]);
                echo json_encode($datos);
            break;
            case "InsertEstadoVentaMM":
                $selectEstadoVenta=$estadosVentasMM->selectEstadoVenta($body['Nombre_estado']);


                if (count($selectEstadoVenta)>0) {
                    $arrResponse = array("status" => false, "msg" => 'El Estado de venta ya existe');
                }else{
                    $datos=$estadosVentasMM->insert_EstadoVentaMM($body["Nombre_estado"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó el  estado de venta');
                }
                
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Insertar', 'Se insertó el Estado de Venta: '.$body['Nombre_estado']);
            break;
            case "UpdateEstadoVentaMM":
                $nombreEstado=$body['Nombre_estado'];
                $idEstadoVenta=$body['Id_Estado_Venta'];

                $selectEstadoVenta=$estadosVentasMM->selectEstadoVenta2($nombreEstado,$idEstadoVenta);
                
                if (count($selectEstadoVenta)>=1) {

                    $arrResponse = array("status" => false, "msg" => 'El estado de venta  ya existe');

                }else{
                    $datos=$estadosVentasMM->update_EstadoVentaMM($nombreEstado,$idEstadoVenta);
                    $arrResponse = array("status" => true, "msg" => 'Estado de venta Actualizado Correctamente');
                }
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Actualizar', 'Se actualizó el Estado de Venta: '.$body['Nombre_estado']);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;

            case "DeleteEstadoVentaMM":
                $Id_Estado_Venta = $body["Id_Estado_Venta"];
                $nombreEstadoVenta = $estadosVentasMM->estadodeventaeliminar($Id_Estado_Venta); // Obtener el nombre del estado de venta antes de eliminarlo
                $datos = $estadosVentasMM->delete_EstadoVentaMM($Id_Estado_Venta);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Eliminar', 'Se eliminó el Estado de Venta: ' . $nombreEstadoVenta); // Usar el nombre del estado de venta eliminado en la bitácora
                echo json_encode("Estado De Venta Eliminado");
                break;
        }

?>   
