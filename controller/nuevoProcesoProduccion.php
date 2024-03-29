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
        require_once '../models/NuevoProcesoProduccion.php';

        $proceso = new ProcesoProduccion();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "InsertProcesoProduccion":
                $datos=$proceso->insert_procesoProduccion($body["Id_Estado_Proceso"],$body["Fecha"]);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($proceso->get_user($varsesion));
                $proceso->registrar_bitacora($Id_Usuario, 32, 'Insertar', 'Se realizó un proceso de producción');
                echo json_encode("Se agregó el proceso");
            break;

            case "InsertProductoTerminadoMP":
                $cantidad=$body['Cantidad'];
                $idMP=$body['Id_Producto'];

                $ValCantidad=$proceso->validarCantidadDeMPEnInventario($idMP, $cantidad);
                
                if ($ValCantidad) {
                    $arrResponse = array("status" => false, "msg" => 'Cantidad insuficiente en inventario de la materia prima seleccionada');
                }else{
                    $datos = $proceso->insert_productoTerminadoMP($body["Id_Producto"], $body["Cantidad"]);
                    $arrResponse = array("status" => true, "msg" => 'Materia prima agregada');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);  
                
            break;
            case "InsertProductoTerminadoMPEditandoProceso":
                $cantidad=$body['Cantidad'];
                $idMP=$body['Id_Producto'];

                $ValCantidad=$proceso->validarCantidadDeMPEnInventario($idMP, $cantidad);
                
                if ($ValCantidad) {
                    $arrResponse = array("status" => false, "msg" => 'Cantidad insuficiente en inventario de la materia prima seleccionada');
                }else{
                    $datos = $proceso->insert_productoTerminadoMPEditandoProceso($body["Id_Producto"], $body["Cantidad"], $body["Id_Proceso_Produccion"]);
                    $arrResponse = array("status" => true, "msg" => 'Materia prima agregada');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); 
            break;
            case "InsertProductoTerminadoFinal":
                $datos=$proceso->insert_productoTerminadoFinal($body["Id_Producto"],$body["Cantidad"]);
                echo json_encode("Se agregó el producto terminado");
            break;
            case "InsertProductoTerminadoFinalEditandoProceso":
                $datos = $proceso->insert_productoTerminadoFinalEditandoProceso($body["Id_Producto"], $body["Cantidad"], $body["Id_Proceso_Produccion"]);
                echo json_encode("Se agregó el producto terminado");
            break;
            //Datos de otra tabla
            case "GetProductosMP":
                $datos=$proceso->get_productosMP();
                echo json_encode($datos);
            break;
            case "GetProductosTerminados":
                $datos=$proceso->get_productosTerminados();
                echo json_encode($datos);
            break;
            case "GetEstadoProceso":
                $datos=$proceso->get_estadoProceso();
                echo json_encode($datos);
            break;
        }
?> 
