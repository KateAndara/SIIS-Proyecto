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

     //inicizalizar variable Session
     session_start();
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

      

                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="rounded" style="background-color: #2D7AC0; color: white; display: inline-block; width: 80px;" onclick="verVenta(\'' .$datos[$i]['Id_Venta'].'\'); mostrarFormulario();">Ver Más</button>';
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 67px;" onclick="generarPDF(\'' .$datos[$i]['Id_Venta']. '\')">PDF <i class="fa-regular fa-file-pdf"></i></button>';
                    }
                  
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($ventas->get_user($varsesion));
                $ventas->registrar_bitacora($Id_Usuario, 24, 'Ingresar', 'Se ingresó a la pantalla de Ventas');
              
                echo json_encode($datos);
            break;
            case "GetProductos":
                $datos=$ventas->get_productos();
               
                echo json_encode($datos);
            break;
            case "GetProducto":
                $datos=$ventas->getProducto($body['idProducto']);
               
                echo json_encode($datos);
            break;
            case "GetPromociones":
                
                $datos=$ventas->get_promociones();
                echo json_encode($datos);
            break;
            case "getPrecioPromocion":
          
                $datos=$ventas->get_promocion($body['idProducto'],$body['idPromocion']);
                $promociones=$ventas->get_promociones($body['idProducto']);
                $datosProducto=$ventas->getProducto($body['idProducto']);

                if ($body['idPromocion']==0) {
                    $precio=$datosProducto[0]['Precio'];

                }else{

                    $precio=$datos['Precio_Venta'];
                }
           
                $idProducto=$body['idProducto'];
                $Cantidad=$body['Cantidad'];
                $Nombre=$body['Nombre'];
                $arrDetalle = $_SESSION['ventaDetalle'];
             
                $arrinfoProducto=array('Id_Producto' => $idProducto,
                'Cantidad' => $Cantidad,
                'Nombre' => $Nombre,
                'Precio' => $precio,
                'promociones'=>$promociones
                );
                 
                
                //$_SESSION['compraDetalle']=array();
                if(isset($_SESSION['ventaDetalle'])){
                 $on = true;
                 $arrDetalle = $_SESSION['ventaDetalle'];
             
                 for ($pr=0; $pr < count($arrDetalle); $pr++) {
                     if($arrDetalle[$pr]['Id_Producto'] == $idProducto){
                         $arrDetalle[$pr]['Cantidad'] =  $Cantidad;
                         $arrDetalle[$pr]['Nombre'] = $Nombre;
                         $arrDetalle[$pr]['Precio'] = $precio;
                         $arrDetalle[$pr]['promociones'] = $promociones;
                        

            
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
                 $data['producto']['idPromo']=$body['idPromocion'];
                 function getFile(string $url, $data)
                 {
                     ob_start();
                     require_once("{$url}.php");
                     $file = ob_get_clean();
                     return $file;        
                 }


                
                 $htmlVentas = getFile('../Formularios/tablaVentas',$data); 
                 $htmlTotales = getFile('../Formularios/tablaTotales',$data); 
                 $htmlPromociones=getfile('../Formularios/tablaPromociones',$data);
                 $htmlTotalesPromociones=getfile('../Formularios/totalesPromociones',$data);
        
          
                 $arrResponse = array("status" => true, "msg" => 'Promoción Seleccionada',"htmlVentas"=>$htmlVentas,"htmlTotales"=>$htmlTotales,"htmlPromociones"=>$htmlPromociones,"htmlTotalesPromociones"=>$htmlTotalesPromociones);

             echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

         
            break;
            case "GetDescuentos":
                $datos=$ventas->get_descuentos();
                echo json_encode($datos);
            break;
            case "GetDescuento":
                $datos=$ventas->get_descuento($body['idDescuento']);
                $datos['impuesto']=$ventas->getImpuesto();
               
                echo json_encode($datos);
            break;
            case "getClientes":
                $datos=$ventas->get_clientes();
        
                echo json_encode($datos);
            break;
            case "getCliente":
                $datos=$ventas->get_cliente($body['idCliente']);
        
                echo json_encode($datos);
            break;
            case "GetEstados":
                $datos=$ventas->get_estados();
                echo json_encode($datos);
            break;
            case "agregarCAI":
                $datos=$ventas->getCAI();
                echo json_encode($datos);
            break;
            case "AgregarDetalle":  
                
                $idProducto=$body['Producto'];
                $Cantidad=intval($body['Cantidad']);
                $Precio=$body['Precio'];
               
                $arrDetalle=array();
                
                //$user=intval($_SESSION['idUser']);
                $arrData = $ventas->getProducto($idProducto);
                $promociones=$ventas->get_promociones($idProducto);
             
                $arrinfoProducto=array('Id_Producto' => $idProducto,
                'Cantidad' => $Cantidad,
                'Nombre' => $arrData[0]['Nombre'],
                'Precio' => $Precio,
                'promociones'=>$promociones
                );
                 
                
                //$_SESSION['compraDetalle']=array();
                if(isset($_SESSION['ventaDetalle'])){
                 $on = true;
                 $arrDetalle = $_SESSION['ventaDetalle'];
             
                 for ($pr=0; $pr < count($arrDetalle); $pr++) {
                     if($arrDetalle[$pr]['Id_Producto'] == $idProducto){
                         $arrDetalle[$pr]['Cantidad'] = $arrDetalle[$pr]['Cantidad']+ $Cantidad;
                         $arrDetalle[$pr]['Nombre'] = $arrData[0]['Nombre'];
                         $arrDetalle[$pr]['Precio'] = $Precio;
                         $arrDetalle[$pr]['promociones'] = $promociones;
                        

            
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
                    $htmlTotales = getFile('../Formularios/tablaTotales',$data); 
                    $htmlPromociones=getfile('../Formularios/tablaPromociones',$data);
                    $htmlTotalesPromociones=getfile('../Formularios/totalesPromociones',$data);
           
             
                    $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlVentas"=>$htmlVentas,"htmlTotales"=>$htmlTotales,"htmlPromociones"=>$htmlPromociones,"htmlTotalesPromociones"=>$htmlTotalesPromociones);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
             
            break;
            case "deleteProducto": 
               
                $detalleTabla='';
                $idproducto = intval($body['Producto']);
            
                if (is_numeric($idproducto) ) {
                 $arrVenta=$_SESSION['ventaDetalle'];
                 for ($pr=0; $pr < count($arrVenta); $pr++) {
                     if($arrVenta[$pr]['Id_Producto'] == $idproducto){
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
                 $htmlTotales = getFile('../Formularios/tablaTotales',$data); 
                 $htmlPromociones=getfile('../Formularios/tablaPromociones',$data);
                 $htmlTotalesPromociones=getfile('../Formularios/totalesPromociones',$data);
        
          
                 $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlVentas"=>$htmlVentas,"htmlTotales"=>$htmlTotales,"htmlPromociones"=>$htmlPromociones,"htmlTotalesPromociones"=>$htmlTotalesPromociones);
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
          
            
                $idCliente=$body['idCliente'];
                $idDescuento=$body['idDescuento'];
                $Porcentaje=$body['Porcentaje'];
                $totalDetalle=$body['totalDetalle'];
                $Totaldescontado=$body['Totaldescontado'];
                $SubtotalDescuento=$body['SubtotalDescuento'];
                $idEstado=$body['idEstado'];
                $Subtotal=$body['Subtotal'];
                $Impuesto=$body['Impuesto'];
                $RTN=$body['RTN'];
                $Total=$body['Total'];
                $Numero_factura=$body['Numero_factura'];
                $Id_Usuario=$_SESSION['Id_Usuario'];
                $usuario=$_SESSION['usuario'];
                $idTalonario=$body['idTalonario'];
               
                if (!empty($body['valorActual'])) {
                    
                    $valorActual=$body['valorActual'] + 1;
                }
                
                
               
         
                
                
                if (isset($_SESSION['ventaDetalle']) || isset($_SESSION['ventaPromociones']) ) {
                    
               
                    $request_venta=$ventas->insertVenta($idCliente,
                                                            $Id_Usuario,
                                                            $idEstado,
                                                            $Subtotal,
                                                            $Impuesto,
                                                            $Total,
                                                            $RTN,
                                                            $Numero_factura);


                    if ($request_venta>0){
                        $idVenta=$request_venta;
                        if (!empty($_SESSION['ventaDetalle']) && isset($_SESSION['ventaDetalle'])) {
                        foreach ($_SESSION['ventaDetalle'] as $producto) {
                            
                            $idVenta=$request_venta;
                            $productoid = $producto['Id_Producto'];
                            $precio = $producto['Precio'];
                            $cantidad = $producto['Cantidad'];                            
                            $detalleVenta=$ventas->insertDetalleVenta($productoid,$idVenta,$cantidad,$precio);

                            $insertKardex=$ventas->insertKardex($productoid,2,$cantidad,$Id_Usuario);
                            $updateInventario=$ventas->updateInventario($productoid,$cantidad);

                            




                            
                            /* //Aumentar stock
                            $this->model->updateStock($id['COD_PRODUCTO'],$nuevoStock); 
                            //actualizarCant Compra
                            $this->model->updateCantCompra($id['COD_PRODUCTO'],$cantCompra);  */
    
                            }
                         }

                         if (!empty($_SESSION['ventaPromociones']) && isset($_SESSION['ventaPromociones'])) {
                            foreach ($_SESSION['ventaPromociones'] as $promocion) {
                             
                                $idVenta=$request_venta;
                                $promocionid = $promocion['IdPromocion'];
                                $precio = $promocion['Precio'];
                                $cantidad = $promocion['Cantidad'];                            
                                $detalleVenta=$ventas->insertVentasPromociones($promocionid,$idVenta,$cantidad,$precio);
                                

                                $productosPromos=$ventas->get_productosPromo($promocionid);

                         
                               
                                foreach($productosPromos as $producto)
                                {

                               
                                    $idProducto=$producto['Id_Producto'];
                                    $idPromocionProducto=$producto['Id_Promocion_Producto'];
                                    $insertKardex=$ventas->insertKardex($idProducto,2,$cantidad,$Id_Usuario);
                                    $updateInventario=$ventas->updateInventario($idProducto,$cantidad);
                                    $updatePromocionProducto=$ventas->updatePromocionProducto($idPromocionProducto,$cantidad);

                                }
                                

                              
    
                                
    
    
    
    
                                
                                /* //Aumentar stock
                                $this->model->updateStock($id['COD_PRODUCTO'],$nuevoStock); 
                                //actualizarCant Compra
                                $this->model->updateCantCompra($id['COD_PRODUCTO'],$cantCompra);  */
        
                                }
                         }
                        
                        if ($Totaldescontado!=0) {
                            $requestVentasDescuento=$ventas->insertVentasDescuento($idVenta,
                            $idDescuento,
                            $Porcentaje,
                            $Totaldescontado,
                            );
                        }else{
                            $requestVentasDescuento=$ventas->insertVentasDescuento($idVenta,
                            0,
                            0,
                            0,
                            ); 
                        }
                       

                        //actualizar CAI
                        if (!empty($body['valorActual'])) {
                        $updateCAI=$ventas->updateCAI($idTalonario,$valorActual);
                        }
                            $arrResponse= array("status"=> true,"msg"=>'Venta Realizada',"idVenta"=>$request_venta);
                            
                                unset($_SESSION['ventaDetalle']);
                                unset($_SESSION['ventaPromociones']);

                                //session_regenerate_id(true);
                        
                    } 
                                                        
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
            case "getVentaListar":
                $idVenta=$body['idVenta'];
                $venta=$ventas->get_venta($idVenta);
                $detalle=$ventas->get_detalle($idVenta);
                $descuento=$ventas->get_descuentoVenta($idVenta);




                $arrVenta=array();

                $arrVenta['Venta']=$venta;
                $arrVenta['detalle']=$detalle;
                $arrVenta['descuento']=$descuento;


                //funcion para traer el html
            function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("../Formularios/{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }

                    $arrResponse= array("status"=> true,"msg"=>'Venta Realizada',"datos"=>$arrVenta);
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case 'promoProductos':
             
               $productosPromos=$ventas->get_productosPromo($body['promocion']);

               $data='';

                for ($i=0; $i < count($productosPromos); $i++) { 
                    $data.='=> '.$productosPromos[$i]['Nombre'].'<br> ';
                }

                
               $arrResponse= array("status"=> true,"msg"=>'Venta Realizada',"html"=>$data,"data"=>$productosPromos);

               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case 'agregarPromocion':
                
                //unset( $_SESSION['ventaPromociones']);
                $idPromocion=$body['promocion'];
                $Cantidad=intval($body['cantidad']);
                $Precio=$body['precio'];
               
                $arrDetalle=array();
                
                //$user=intval($_SESSION['idUser']);
                //$arrData = $ventas->getProducto($idProducto);
                $promocion=$ventas->getPromocion($idPromocion);
              
                $arrInfoPromo=array('IdPromocion' => $idPromocion,
                'Cantidad' => $Cantidad,
                'Nombre'=>$promocion[0]['Nombre_Promocion'],
                'Precio' => $Precio,
                
                );
                 
                
                //$_SESSION['compraDetalle']=array();
                if(isset($_SESSION['ventaPromociones'])){
                 $on = true;
                 $arrDetalle = $_SESSION['ventaPromociones'];
             
                 for ($pr=0; $pr < count($arrDetalle); $pr++) {
                     if($arrDetalle[$pr]['IdPromocion'] == $idPromocion){
                         $arrDetalle[$pr]['Cantidad'] = $arrDetalle[$pr]['Cantidad']+ $Cantidad;
                         $arrDetalle[$pr]['Nombre'] = $promocion[0]['Nombre_Promocion'];
                         $arrDetalle[$pr]['Precio'] = $Precio;
                      
                         $on = false;
                     }
                 }
                 if($on){
                     array_push($arrDetalle,$arrInfoPromo);
                 }
                     $_SESSION['ventaPromociones'] = $arrDetalle;
                 }else{
                     array_push($arrDetalle, $arrInfoPromo);
                     $_SESSION['ventaPromociones'] = $arrDetalle;
                 }
                 $data=array();
                 $data['producto']=$_SESSION['ventaPromociones'];
            
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }
                    

                  
                  /*   $htmlVentas = getFile('../Formularios/tablaVentas',$data); 
                    $htmlTotales = getFile('../Formularios/tablaTotales',$data);  */
                    $htmlPromociones=getfile('../Formularios/tablaPromociones',$data);
                    $htmlTotalesPromociones=getfile('../Formularios/totalesPromociones',$data);
           
             
                    $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlPromociones"=>$htmlPromociones,"htmlTotalesPromociones"=>$htmlTotalesPromociones);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);


            break;

            case "deletePromocion": 
               
                $detalleTabla='';
                $idPromocion = intval($body['idPromocion']);
            
                if (is_numeric($idPromocion) ) {
                 $arrVenta=$_SESSION['ventaPromociones'];
                 for ($pr=0; $pr < count($arrVenta); $pr++) {
                     if($arrVenta[$pr]['IdPromocion'] == $idPromocion){
                         unset($arrVenta[$pr]);
                     }
                 }
                 sort($arrVenta);
                 $_SESSION['ventaPromociones']=$arrVenta;
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }
                    $data=array();
                    $data['producto']=$_SESSION['ventaPromociones'];
                      
         
                 $htmlPromociones=getfile('../Formularios/tablaPromociones',$data);
                 $htmlTotalesPromociones=getfile('../Formularios/totalesPromociones',$data);
        
          
                 $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlPromociones"=>$htmlPromociones,"htmlTotalesPromociones"=>$htmlTotalesPromociones);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
           
        }
?> 
