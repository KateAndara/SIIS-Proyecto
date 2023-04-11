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
        require_once '../models/Ventas.php';

        $ventas = new Ventas();

        $body = json_decode(file_get_contents("php://input"), true);

        switch($_GET["opc"]){

            //Datos de otra tabla
            case "GetVentas":
                $datos=$ventas->get_ventas();
                echo json_encode($datos);
            break;
            case "GetProductos":
                $datos=$ventas->get_productos();
                echo json_encode($datos);
            break;
            case "GetPromociones":
                $datos=$ventas->get_promociones();
                echo json_encode($datos);
            break;
            case "GetDescuentos":
                $datos=$ventas->get_descuentos();
                echo json_encode($datos);
            break;
            case "GetEstados":
                $datos=$ventas->get_estados();
                echo json_encode($datos);
            break;
            case "AgregarDetalle":  
                
                $IdProducto=$body['Producto'];
                $Cantidad=intval($body['Cantidad']);
                $Precio=$body['Precio'];
                
                $arrDetalle=array();

                //$user=intval($_SESSION['idUser']);
                $arrData = $ventas->getProducto($idProducto);
              
                $arrinfoProducto=array('Id_Producto' => $idProducto,
                'Cantidad' => $Cantidad,
                'Nombre' => $arrData[0]['Nombre'],
                'Precio' => $Precio,
                
                );
                 
                 
                //$_SESSION['compraDetalle']=array();
                if(isset($_SESSION['ventaDetalle'])){
                 $on = true;
                 $arrDetalle = $_SESSION['ventaDetalle'];
                 for ($pr=0; $pr < count($arrDetalle); $pr++) {
                     if($arrDetalle[$pr]['idproducto'] == $idProducto){
                         $arrDetalle[$pr]['cantidad'] = $cantidad;
                         $arrDetalle[$pr]['nombre'] = $arrData[0]['Nombre'];
                         $arrDetalle[$pr]['precio'] = $Precio_Libra;
                        

            
                         $on = false;
                     }
                 }
                 if($on){
                     array_push($arrDetalle,$arrinfoProducto);
                 }
                     $_SESSION['ventaDetalle'] = $arrDetalle;
                 }else{
                     array_push($arrDetalle, $arrinfoProducto);
                     $_SESSION['ventaDetalle'] = $arrDetalle;
                 }
                 $data=array();
                 $data['producto']=$_SESSION['ventaDetalle'];
                
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }

                    $htmlVentas = getFile('../Formularios/tablaVentas',$data); 

                    $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlVentas"=>$htmlVentas);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
             
            break;
            case "deleteProducto": 
               
                $detalleTabla='';
                $idproducto = intval($body['Producto']);
          
                if (is_numeric($idproducto) ) {
                 $arrVenta=$_SESSION['ventaDetalle'];
                 for ($pr=0; $pr < count($arrCompra); $pr++) {
                     if($arrVenta[$pr]['idproducto'] == $idproducto){
                         unset($arrVenta[$pr]);
                     }
                 }
                 sort($arrVenta);
                 $_SESSION['ventaDetalle']=$arrVenta;
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }
                    $data=array();
                    $data['producto']=$_SESSION['ventaDetalle'];
                    $htmlVentas = getFile('../Formularios/tablaVentas',$data); 
                     
                 $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlVentas"=>$htmlVentas);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "editProducto":
                
                $idProducto=$body['Producto'];
                $datos=$_SESSION['ventaDetalle'][$idProducto];

               

                $arrResponse = array("status" => true, "msg" => 'Editando Producto',"datos"=>$datos);


                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);


            break;

            case "finalVenta":
                
                
                $cliente=$body['Nombre'];
                $Fecha_nacimiento=$body['Fecha_nacimiento'];
                $DNI=$body['DNI'];
                $Id_Usuario=$_SESSION['Id_Usuario'];
                $Id_Estado=$body['Id_Estado'];
                $Subtotal=$body['Subtotal'];
                $Impuesto=$body['Impuesto'];
                $Total=$body['Total'];
                $Fecha=$body['Fecha'];
                $RTN=$body['RTN'];
                $Num_Factura=$body['Numero_factura'];
                
                
         
                
                
                if (!empty($_SESSION['ventaDetalle'])) {
                    $request_cliente=$ventas->insertCliente($cliente,
                                                            $Fecha_nacimiento,
                                                            $DNI);


                    if ($request_cliente>0){
                        $Id_Cliente=$request_cliente;
                        $request_venta=$ventas->insertVenta($Id_Cliente,
                                                            $Id_Usuario,
                                                            $Id_Estado,
                                                            $Subtotal,
                                                            $Impuesto,
                                                            $Total,
                                                            $Fecha,
                                                            $RTN,
                                                            $Num_Factura);
                        foreach ($_SESSION['ventaDetalle'] as $producto) {
                            
                            $idVenta=$request_venta;
                            $productoid = $producto['idproducto'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];                            
                            $detalleVenta=$ventas->insertDetalleVenta($productoid,$idVenta,$cantidad,$precio);

                            $insertKardex=$ventas->insertKardex($productoid,1,$cantidad,$Id_Usuario);
                            $updateInventario=$ventas->updateInventario($productoid,$cantidad);

                            




                            
                            /* //Aumentar stock
                            $this->model->updateStock($id['COD_PRODUCTO'],$nuevoStock); 
                            //actualizarCant Compra
                            $this->model->updateCantCompra($id['COD_PRODUCTO'],$cantCompra);  */
    
                        }
                    
                       
                            $arrResponse= array("status"=> true,"msg"=>'Compra Realizada');
                            
                                unset($_SESSION['ventaDetalle']);
                                //session_regenerate_id(true);
                            }                                             
                }


                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
           
        }
?> 
