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
        require_once '../models/ContactoProveedorMM.php';

        $contactosProveedoresMM = new ContactoProveedorMM();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetContactoProveedoresMM":
                $datos=$contactosProveedoresMM->get_ContactoProveedoresMM();
                echo json_encode($datos);
            break;
            case "GetContactoProveedorMM": //Buscar por cualquier campo 
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : (isset($body["Id_Proveedores_Contacto"]) ? $body["Id_Proveedores_Contacto"] : '');
                $datos = $contactosProveedoresMM->get_ContactoProveedorMM($busqueda);
                echo json_encode($datos);
            break;
            case "GetContactoProveedorMMeditar": //Trae la fila que se va a editar
                $datos=$contactosProveedoresMM->get_ContactoProveedorMMeditar($body["Id_Proveedores_Contacto"]);
                echo json_encode($datos);
            break;
            case "InsertContactoProveedorMM":
                $datos=$contactosProveedoresMM->insert_ContactoProveedorMM($body["Id_Tipo_Contacto"],$body["Id_Proveedor"],$body["Contacto"]);
                echo json_encode("Se agregó el  Contacto del proveedor");
            break;
            case "UpdateContactoProveedorMM":
                $datos=$contactosProveedoresMM->update_ContactoProveedorMM($body["Id_Proveedores_Contacto"],$body["Id_Tipo_Contacto"],$body["Id_Proveedor"],$body["Contacto"]);
                echo json_encode("Contacto Actualizado");
            break;
            case "DeleteContactoProveedorMM":
                $datos=$contactosProveedoresMM->delete_ContactoProveedorMM($body["Id_Proveedores_Contacto"]);
                echo json_encode("Proveedor Eliminado");
            break;
            //Datos de otra tabla
            case "GetContactos":
                $datos=$contactosProveedoresMM->get_Contactos();
                echo json_encode($datos);
            break;
            case "GetProveedores":
                $datos=$contactosProveedoresMM->get_Proveedores();
                echo json_encode($datos);
            break;
        }

?>   
