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
        require_once '../models/Descuentos.php';

        $descuentos = new Descuentos();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetDescuentos":
                $datos=$descuentos->get_descuentos();
               
             

                 //ciclo for para insertar los botontes en cada opción
                 for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarDescuento(\'' .$datos[$i]['Id_Descuento']. '\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarDescuento(\'' .$datos[$i]['Id_Descuento']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }

              
                echo json_encode($datos);
            break;
            case "GetDescuento":  //Busca los datos por nombre y id
                $busqueda = isset($body["Nombre_descuento"]) ? $body["Nombre_descuento"] : $body["Id_Descuento"];                           
                echo json_encode($datos);
            break;
            case "GetDescuentoeditar": //Trae la fila que se va a editar
                $datos=$descuentos->get_descuentoeditar($body["Id_Descuento"]);
                echo json_encode($datos);
            break;
            case "InsertDescuento":
                $datos = $descuentos->insert_descuento($body["Nombre_descuento"], $body["Porcentaje_a_descontar"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($descuentos->get_user($varsesion));
                $descuentos->registrar_bitacora($Id_Usuario, 25, 'Insertar', 'Se insertó el descuento: ' . $body["Nombre_descuento"] . ' con porcentaje: ' . $body["Porcentaje_a_descontar"]);
                echo json_encode("Se agregó el descuento");
                break;
            case "UpdateDescuento":
                $datos = $descuentos->update_descuento($body["Id_Descuento"], $body["Nombre_descuento"], $body["Porcentaje_a_descontar"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($descuentos->get_user($varsesion));
                $descuentos->registrar_bitacora($Id_Usuario, 25, 'Actualizar', 'Se actualizó el descuento a: ' . $body["Nombre_descuento"] . ' con porcentaje: ' . $body["Porcentaje_a_descontar"]);
                echo json_encode("Descuento Actualizado");
                break;
            case "DeleteDescuento":
                $Id_Descuento = $body["Id_Descuento"];
                $nombreDescuento = $descuentos->descuentoeliminar($Id_Descuento); // Obtener el nombre del descuento antes de eliminarlo
                $datos = $descuentos->delete_descuento($Id_Descuento);
            
                // Agregar el registro en la bitácora
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($descuentos->get_user($varsesion));
                $descuentos->registrar_bitacora($Id_Usuario, 25, 'Eliminar', 'Se eliminó el Descuento: ' . $nombreDescuento);
            
                echo json_encode("Descuento Eliminado");
                break;
            
        }

?>   