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
        require_once '../models/ContactoClienteMM.php';

        $contactosClientesMM = new ContactoClienteMM();
 
        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetContactoClientesMM":
                $datos=$contactosClientesMM->get_ContactoClientesMM();
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
                $datos=$contactosClientesMM->insert_ContactoClienteMM($body["Id_Tipo_Contacto"],$body["Id_Cliente"],$body["Contacto"]);
                echo json_encode("Se agregó el  Contacto del cliente");
            break;
            case "UpdateContactoClienteMM":
                $datos=$contactosClientesMM->update_ContactoClienteMM($body["Id_Cliente_Contacto"],$body["Id_Tipo_Contacto"],$body["Id_Cliente"],$body["Contacto"]);
                echo json_encode("Conatcto Actualizado");
            break;
            case "DeleteContactoClienteMM":
                $datos=$contactosClientesMM->delete_ContactoClienteMM($body["Id_Cliente_Contacto"]);
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
        }

?>   
