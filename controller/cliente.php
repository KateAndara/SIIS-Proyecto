
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
        require_once '../models/Clientes.php';


        $clientes = new Clientes();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){
 
            case "GetClientes":
                
                $datos=$clientes->get_clientes();
                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';  
                    $btnEdit = '';
                    $btnDelete = '';
                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color:#2D7AC0; color: white; display: inline-block; width: 67px;" onclick="CargarCliente(\''.$datos[$i]['Id_Cliente'].'\'); mostrarFormulario();">Editar</button>';
                    }
                    //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="EliminarCliente(\''  .$datos[$i]['Id_Cliente']. '\')">Eliminar</button>';
                    }
        
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }

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
                $DNI=$body['DNI'];


                $selectDNI=$clientes->verficaDNI($DNI);
                
                if (count($selectDNI)>0) {
                    $arrResponse = array("status" => false, "msg" => 'DNI ya existente, Verifique nuevamente');
                }else{
                    $datos=$clientes->insert_cliente($body["Nombre"],$body["Fecha_nacimiento"],$body["DNI"]);
                    $arrResponse = array("status" => true, "msg" => 'Se agregó el cliente');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($clientes->get_user($varsesion));
                $clientes->registrar_bitacora($Id_Usuario, 28, 'Insertar', 'Se insertó un nuevo cliente con nombre: ' . $body["Nombre"]);
                break;    
            case "UpdateCliente":
                $nombre=$body['Nombre'];
                $fecha_nacimiento=$body['Fecha_nacimiento'];
                $DNI=$body['DNI'];
                $idCliente=$body['Id_Cliente'];

                $selectDNI=$clientes->verficaDNI2($nombre,$fecha_nacimiento,$DNI,$idCliente);

                if (count($selectDNI)>1) {
                    $arrResponse = array("status" => false, "msg" => 'DNI ya existente, Verifique nuevamente');
                }else{
                    $datos=$clientes->update_cliente($body["Nombre"],$body["Fecha_nacimiento"],$body["DNI"]);

                    $datos=$clientes->update_cliente($nombre,$fecha_nacimiento,$DNI,$idCliente);
                    $arrResponse = array("status" => true, "msg" => 'Cliente Actualizado Correctamente');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($clientes->get_user($varsesion));
                $clientes->registrar_bitacora($Id_Usuario, 28, 'Actualizar', 'Se actualizó el cliente: ' . $body["Nombre"].' con fecha de nacimiento '.$body["Fecha_nacimiento"]. ' y DNI '.$body["DNI"]);
            case "DeleteCliente":
                $Id_Cliente = $body["Id_Cliente"];
                $cliente_eliminado = $clientes->clienteeliminar($body["Id_Cliente"]);
                $datos=$clientes->delete_cliente($body["Id_Cliente"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($clientes->get_user($varsesion));
                $clientes->registrar_bitacora($Id_Usuario, 28, 'Eliminar', 'Se eliminó el cliente ' . $cliente_eliminado);
                echo json_encode("Cliente Eliminado");
                break;          
        
        }

?> 