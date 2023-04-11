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
        require_once '../models/Clientes.php';

        $clientes = new Clientes();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetClientes":
                $datos=$clientes->get_clientes();
                echo json_encode($datos);
            break;
            case "GetCliente":  //Busca los datos por nombre y id
                $busqueda = isset($body["Nombre"]) ? $body["Nombre"] : $body["Id_Cliente"];
                
                // Verificar si la búsqueda es un número o una cadena
                if (is_numeric($busqueda)) {
                    $datos = $clientes->get_cliente($busqueda, "Id_Cliente");
                } else {
                    $datos = $clientes->get_cliente($busqueda, "Nombre");
                }
            
                echo json_encode($datos);
            break;
            case "GetClienteditar": //Trae la fila que se va a editar
                $datos=$clientes->get_clienteeditar($body["Id_Cliente"]);
                echo json_encode($datos);
            break;
            case "InsertCliente":
                $datos=$clientes->insert_cliente($body["Nombre"],$body["Fecha_nacimiento"],$body["DNI"]);
                echo json_encode("Se agregó el Cliente");
            break;
            case "UpdateCliente":
                $datos=$clientes->update_cliente($body["Id_Cliente"],$body["Nombre"],$body["Fecha_nacimiento"], $body["DNI"]);
                echo json_encode("Cliente Actualizado");
            break;
            case "DeleteCliente":
                $datos=$clientes->delete_cliente($body["Id_Cliente"]);
                echo json_encode("Cliente Eliminado");
            break;
        }

?> 