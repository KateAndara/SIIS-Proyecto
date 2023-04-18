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
        require_once '../models/Inventario.php';

        $Inventarios = new Inventario();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetInventarios":
                $datos=$Inventarios->get_Inventarios();

                for ($i=0; $i < count($datos) ; $i++) 
                {
                   $cantidadMaxima=$datos[$i]['Cantidad_maxima'];
                   $cantidadMinima=$datos[$i]['Cantidad_minima'];
                   $existencia=$datos[$i]['Existencia'];
                    $badge="";
                   if ($existencia<$cantidadMinima) {
                        $porcentaje= number_format(($existencia/$cantidadMaxima)*100,2);
                        $datos[$i]['badge'] = '<span class="badge text-bg-danger">'.$porcentaje.'%</span>';
                   }else if($existencia>=$cantidadMinima && $existencia<=$cantidadMaxima){
                    $porcentaje= number_format(($existencia/$cantidadMaxima)*100,2);
                        $datos[$i]['badge'] = '<span class="badge text-bg-warning">'.$porcentaje.'%</span>';
                   }else if ($existencia>$cantidadMaxima){
                    $porcentaje="100%";
                    $datos[$i]['badge'] = '<span class="badge text-bg-success">'.$porcentaje.'</span>';
                   }                    
                }
                session_start();
                require_once("../config/conexion.php");
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($Inventarios->get_user($varsesion));
                $Inventarios->registrar_bitacora($Id_Usuario, 33, 'Ingresar', 'Se ingresó a la pantalla de Inventario');
                echo json_encode($datos);
            break;        
            case "GetMovimientos":
                $idProducto=$body['Id_Producto'];
                $datos=$Inventarios->getMovimientos($idProducto);
                
                for ($i=0; $i < count($datos) ; $i++) 
                {               
                    $badge="";
                   if ($datos[$i]['Id_Tipo_Movimiento']==1) {
                        $datos[$i]['badge'] = '<span class="badge text-bg-success">ENTRADA</span>';
                   }else {
                    $datos[$i]['badge'] = '<span class="badge text-bg-primary">SALIDA</span>';
                   }                   
                }
          
                echo json_encode($datos);
            break;            
        }
?>   