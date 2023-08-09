
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
        require_once '../models/ContactoClienteMM.php';
        
        $contactosClientesMM = new ContactoClienteMM();
        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetContactoClientesMM":
                $datos=$contactosClientesMM->get_ContactoClientesMM($body['Id_Cliente']);
                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
                   
                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarContactoClienteMM(\'' .$datos[$i]['Id_Cliente_Contacto'].'\'); mostrarFormulario();">Editar</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarContactoClienteMM(\'' .$datos[$i]['Id_Cliente_Contacto']. '\')">Eliminar</button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }

                echo json_encode($datos);
            break;
            case "GetContactoClienteMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Cliente_Contacto"]) ? $body["Id_Cliente_Contacto"] : '');
                $datos = $contactosClientesMM->get_ContactoClienteMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetContactoClienteMMeditar": //Trae la fila que se va a editar
                $datos=$contactosClientesMM->get_ContactoClienteMMeditar($body["Id_Cliente_Contacto"]);
                echo json_encode($datos);
            break;
            case "InsertContactoClienteMM": 
                $datos = $contactosClientesMM->insert_ContactoClienteMM($body["Id_Tipo_Contacto"], $body["Id_Cliente"], $body["Contacto"]);
                $nombre_cliente = $contactosClientesMM->obtener_nombre_cliente_por_id($body["Id_Cliente"]);

                if (!empty($nombre_cliente)) {
                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($contactosClientesMM->get_user($varsesion));
                    $contactosClientesMM->registrar_bitacora($Id_Usuario, 47, 'Insertar', 'Se insertó el contacto: ' . $body["Contacto"] . ' para el cliente ' . $nombre_cliente);

                    echo json_encode("Se agregó el Contacto del cliente");
                } else {
                    echo json_encode("Error: No se encontró el nombre del cliente para el Id_Cliente proporcionado.");
                }
            break;
            case "UpdateContactoClienteMM":
                $datos = $contactosClientesMM->update_ContactoClienteMM($body["Id_Cliente_Contacto"], $body["Id_Tipo_Contacto"], $body["Id_Cliente"], $body["Contacto"]);

                // Obtener el nombre del cliente utilizando la función del modelo
                $nombre_cliente = $contactosClientesMM->obtener_nombre_cliente_por_id($body["Id_Cliente"]);

                // Verificar si se encontró el nombre del cliente
                if (!empty($nombre_cliente)) {
                    // Llamada al método para registrar la bitácora con el nombre del cliente actualizado
                    $varsesion = $_SESSION['usuario'];
                    $Id_Usuario = intval($contactosClientesMM->get_user($varsesion));
                    $contactosClientesMM->registrar_bitacora($Id_Usuario, 47, 'Actualizar', 'Se actualizó el contacto: ' . $body["Contacto"] . ' del cliente: ' . $nombre_cliente);

                    echo json_encode("Contacto Actualizado");
                } else {
                    echo json_encode("Error: No se encontró el nombre del cliente para el Id_Cliente proporcionado.");
                }

            break;
            case "DeleteContactoClienteMM":
                $Id_Cliente_Contacto = $body["Id_Cliente_Contacto"];
                $contacto_eliminado = $contactosClientesMM->contactoclienteeliminar($Id_Cliente_Contacto);
                $datos = $contactosClientesMM->delete_ContactoClienteMM($body["Id_Cliente_Contacto"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($contactosClientesMM->get_user($varsesion));
                $contactosClientesMM->registrar_bitacora($Id_Usuario, 47, 'Eliminar', 'Se eliminó el contacto: ' . $contacto_eliminado);
                echo json_encode("Contacto Eliminado");
            break; 
            //Datos de otra tabla
            case "GetContactos":
                $datos=$contactosClientesMM->get_Contactos();
                echo json_encode($datos);
            break;
            case "GetClientes":
                $datos=$contactosClientesMM->get_Clientes();
                echo json_encode($datos);
            break;
            case "getCliente":
                $datos=$ventas->get_cliente($body['idCliente']);
        
                echo json_encode($datos);
            break;
        } 

?>   
