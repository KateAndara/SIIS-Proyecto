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
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Ingresar', 'Se ingresó a la pantalla de Estado de Ventas');
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
                $datos=$estadosVentasMM->insert_EstadoVentaMM($body["Nombre_estado"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Insertar', 'Se insertó un Estado de Venta');
                echo json_encode("Se agregó el  Estado De Venta");
            break;
            case "UpdateEstadoVentaMM":
                $datos=$estadosVentasMM->update_EstadoVentaMM($body["Id_Estado_Venta"],$body["Nombre_estado"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Actualizar', 'Se actualizó un Estado de Venta');
                echo json_encode("Estado De Venta Actualizado");
            break;

            case "DeleteEstadoVentaMM":
                $datos=$estadosVentasMM->delete_EstadoVentaMM($body["Id_Estado_Venta"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($estadosVentasMM->get_user($varsesion));
                $estadosVentasMM->registrar_bitacora($Id_Usuario, 43, 'Insertar', 'Se insertó un Estado de Venta');
                echo json_encode("Estado De Venta Eliminado");
            break;
        }

?>   
