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
        require_once '../models/Promociones.php';

        $promociones = new Promociones();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetPromociones":
                $datos=$promociones->get_promociones();



                 //ciclo for para insertar los botontes en cada opción
                 for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarPromocion(\'' .$datos[$i]['Id_Promocion']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarPromocion(\'' .$datos[$i]['Id_Promocion'].  '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                    
                    //Bitácora

                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($promociones->get_user($varsesion));

                    if (!isset($_SESSION['ingreso_registrado_pantalla_promociones'])) {
                    $promociones->registrar_bitacora($Id_Usuario, 26, 'Ingresar', 'Se ingresó a la pantalla de promoción: ');

                        // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                        $_SESSION['ingreso_registrado_pantalla_promociones'] = true;
                    }
                }
                echo json_encode($datos);
            break;
            case "GetPromocion":  //Busca los datos por nombre y id
                $busqueda = isset($body["Nombre_Promocion"]) ? $body["Nombre_Promocion"] : $body["Id_Promocion"];
                echo json_encode($datos);
            break;
            case "GetPromocioneditar": //Trae la fila que se va a editar
                $datos=$promociones->get_promocioneditar($body["Id_Promocion"]);
                echo json_encode($datos);
            break;   
            case "InsertPromocion":
                $datos=$promociones->insert_promocion($body["Nombre_Promocion"], $body["Precio_Venta"], $body["Fecha_inicio"],$body["Fecha_final"]);                    
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promociones->get_user($varsesion));
                $promociones->registrar_bitacora($Id_Usuario, 26, 'Insertar', 'Se insertó la promoción: ' . $body["Nombre_Promocion"] . ' desde: ' . $body["Fecha_inicio"] . ' hasta: ' . $body["Fecha_final"]);
            
                echo json_encode("Se agregó la promoción");
            break;
            case "UpdatePromocion":
                $datos=$promociones->update_promocion($body["Id_Promocion"],$body["Nombre_Promocion"],$body["Precio_Venta"],$body["Fecha_inicio"],$body["Fecha_final"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promociones->get_user($varsesion));
                $promociones->registrar_bitacora($Id_Usuario, 26, 'Actualizar', 'Se actualizó la promoción a: ' . $body["Nombre_Promocion"] . ' desde: ' . $body["Fecha_inicio"] . ' hasta: ' . $body["Fecha_final"]);
            
                echo json_encode("Promoción Actualizada");
            break;
            case "DeletePromocion":
                $Id_Promocion = $body["Id_Promocion"];
                $nombrePromocion = $promociones->promocióneliminar($Id_Promocion); // Obtener el nombre de la promoción antes de eliminarla
                $datos=$promociones->delete_promocion($body["Id_Promocion"]);
            
                // Agregar el registro en la bitácora
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($promociones->get_user($varsesion));
                $promociones->registrar_bitacora($Id_Usuario, 26, 'Eliminar', 'Se eliminó la Promoción: ' . $nombrePromocion);
            
                
                echo json_encode("Promoción Eliminada");
            break;
            
        }

?>   