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
        require_once '../models/Kardex.php';

        $Kardexs = new Kardex();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            case "GetKardexs":
                $datos=$Kardexs->get_Kardexs();

                for ($i=0; $i < count($datos) ; $i++) 
                {               
                    $badge="";
                   if ($datos[$i]['Id_Tipo_Movimiento']==1) {
                        $datos[$i]['badge'] = '<span class="badge text-bg-success">COMPRA</span>';
                   }else {
                    $datos[$i]['badge'] = '<span class="badge text-bg-primary">VENTA</span>';
                   }                    
                }
                
                echo json_encode($datos);
            break;
            case "GetKardex":
                $datos=$Kardexs->get_Kardex($body["Id_Kardex"]);
                echo json_encode($datos);
            break;
        }
?>   