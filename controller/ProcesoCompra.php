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
        require_once '../models/Compras.php';

        $compras = new Compras();

        $body = json_decode(file_get_contents("php://input"), true);

        
        

        switch($_GET["opc"]){
            case "getCompras":
                $datos=$compras->get_compras();
                
                //ciclo for para insertar los botontes en cada opción
                for ($i=0; $i < count($datos); $i++) { 

                    //variable de los botones
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<div class="d-flex"><div  style="margin-right: 4px;"><button class="rounded" style=" background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="verCompra(\'' .$datos[$i]['Id_Compra']."');\">Ver ".'<i class="fa-solid fa-eye"></i>'."</button></div>'";
                    }

                    //si permisos es igual a Permiso_actualizacion de update crea el boton
                    if($_SESSION['permisosMod']['r']){
                        $btnEdit = '<div style="margin-right: 4px;"><button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 80px;" onclick="compraPDF(\''.$datos[$i]['Id_Compra']."')\">PDF ".'<i class="fa-regular fa-file-pdf"></i>'."</button></div>";
                    }
                        //si permisos es igual a Permiso_eliminacion de delete crea el boton

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete='<div><button class="rounded" style="background-color: #FF0000; color: white; display: inline-block; width: 80px;" onclick="cancelarCompra(\''.$datos[$i]['Id_Compra']."')\">Cancelar</button></div>'"."</div>";
                    }
                
                    
                    //unimos los botontes
                    $datos[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

                }
                //Bitácora
               
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($compras->get_user($varsesion)); 

                if (!isset($_SESSION['ingreso_registrado_pantalla_compras'])) {
                    $compras->registrar_bitacora($Id_Usuario, 29,   'Ingresar', 'Se ingresó a la pantalla de Compras ');

                    // Marcar que el ingreso ha sido registrado para esta pantalla de ventas
                    $_SESSION['ingreso_registrado_pantalla_compras'] = true;
                }
               
                echo json_encode($datos);
            break;
            case "getCompra":
                $idCompra=$body['idCompra'];
                $datos=$compras->get_compra($idCompra);
                echo json_encode($datos);
            break;
            case "getUltimaCompra":
                $datos=$compras->get_ultimaCompra();
                echo json_encode($datos);
            break;
            case "deleteCompra":
                $idCompra=$body['idCompra'];
                $datos=$compras->deleteCompra($idCompra);
                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($compras->get_user($varsesion));
                $compras->registrar_bitacora($Id_Usuario, 29, 'Eliminar', 'Se canceló la compra N° '.$body['idCompra']);
                echo json_encode($datos);
            break;
            case "GetProveedores":
                $datos=$compras->get_Proveedores();
               
                echo json_encode($datos);
            break;
            case "GetProductos":
                $datos=$compras->getProductos();
            
                echo json_encode($datos);
            break;
            case "AgregarDetalle":  
                
                $idProducto=intval($body['Producto']);
                $cantidad=intval($body['Cantidad']);
                $especie=$body['especie'];
                $pesoVivo=$body['pesoVivo'];
                $Precio_Libra=$body['Precio_Libra'];
                $canal=$body['canal'];
                $Rendimiento=$body['Rendimiento'];

                $arrDetalle=array();

                //$user=intval($_SESSION['idUser']);
                $arrData = $compras->getProducto($idProducto);
              
                $arrinfoProducto=array('idproducto' => $idProducto,
                'cantidad' => $cantidad,
                'nombre' => $arrData[0]['Nombre'],
                'precio' => $Precio_Libra,
                'especie' => $especie,
                'pesoVivo' => $pesoVivo,
                'canal' => $canal,
                'Rendimiento' => $Rendimiento,

                );
                 
                 
                //$_SESSION['compraDetalle']=array();
                if(isset($_SESSION['compraDetalle'])){
                 $on = true;
                 $arrDetalle = $_SESSION['compraDetalle'];
                 for ($pr=0; $pr < count($arrDetalle); $pr++) {
                     if($arrDetalle[$pr]['idproducto'] == $idProducto){
                         $arrDetalle[$pr]['cantidad'] = $cantidad;
                         $arrDetalle[$pr]['nombre'] = $arrData[0]['Nombre'];
                         $arrDetalle[$pr]['precio'] = $Precio_Libra;
                         $arrDetalle[$pr]['especie'] = $especie;
                         $arrDetalle[$pr]['pesoVivo'] = $pesoVivo;
                         $arrDetalle[$pr]['canal'] = $canal;
                         $arrDetalle[$pr]['Rendimiento'] = $Rendimiento;

            
                         $on = false;
                     }
                 }
                 if($on){
                     array_push($arrDetalle,$arrinfoProducto);
                 }
                     $_SESSION['compraDetalle'] = $arrDetalle;
                 }else{
                     array_push($arrDetalle, $arrinfoProducto);
                     $_SESSION['compraDetalle'] = $arrDetalle;
                 }
                 $data=array();
                 $data['producto']=$_SESSION['compraDetalle'];
                
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }

                    $htmlCompras = getFile('../Formularios/tablaCompra',$data); 

                    $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlCompras"=>$htmlCompras);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
             
            break;
            case "deleteProducto": 
               
                $detalleTabla='';
                $idproducto = intval($body['Producto']);
          
                if (is_numeric($idproducto) ) {
                 $arrCompra=$_SESSION['compraDetalle'];
                 for ($pr=0; $pr < count($arrCompra); $pr++) {
                     if($arrCompra[$pr]['idproducto'] == $idproducto){
                         unset($arrCompra[$pr]);
                     }
                 }
                 sort($arrCompra);
                 $_SESSION['compraDetalle']=$arrCompra;
                 function getFile(string $url, $data)
                    {
                        ob_start();
                        require_once("{$url}.php");
                        $file = ob_get_clean();
                        return $file;        
                    }
                    $data=array();
                    $data['producto']=$_SESSION['compraDetalle'];
                    $htmlCompras = getFile('../Formularios/tablaCompra',$data); 
                     
                 $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlCompras"=>$htmlCompras);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            break;
            case "editProducto":
                
                $idProducto=$body['Producto'];
                $datos=$_SESSION['compraDetalle'][$idProducto];

               

                $arrResponse = array("status" => true, "msg" => 'Editando Producto',"datos"=>$datos);


                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);


            break;
            case "finalCompra":
                
                
                $proveedor=$body['proveedor'];
                $fechaCompra=$body['fechaCompra'];
                $total=$body['total'];
                $observacion=$body['observacion'];
                $idPersona=$_SESSION['Id_Usuario'];
                $nombre=$_SESSION['nombre'];
                if (!empty($_SESSION['compraDetalle'])) {
                    $request_compra=$compras->insertCompra($proveedor,
                                                                $fechaCompra,
                                                                $total,
                                                                $observacion,
                                                                $nombre);


                    if ($request_compra>0){
                        foreach ($_SESSION['compraDetalle'] as $producto) {
                            
                            $idCompra=$request_compra;
                            $productoid = $producto['idproducto'];
                            $precio = $producto['precio'];
                            $cantidad = $producto['cantidad'];                            
                            $detalleCompra=$compras->insertDetalle($idCompra,$productoid,$precio,$cantidad);

                            $insertKardex=$compras->insertKardex($productoid,1,$cantidad,$idPersona);
                            $updateInventario=$compras->updateInventario($productoid,$cantidad);

                            $especie = $producto['especie'];
                            $canal = $producto['canal'];
                            $pesoVivo = $producto['pesoVivo'];
                            $Rendimiento = $producto['Rendimiento'];

                            $compras->insertDetalleProducto($detalleCompra,$especie,$pesoVivo,$canal,$Rendimiento);

                            
                            /* //Aumentar stock
                            $this->model->updateStock($id['COD_PRODUCTO'],$nuevoStock); 
                            //actualizarCant Compra
                            $this->model->updateCantCompra($id['COD_PRODUCTO'],$cantCompra);  */
    
                        }
                    
                       
                            $arrResponse= array("status"=> true,"msg"=>'Compra Realizada');
                            
                                unset($_SESSION['compraDetalle']);
                                //session_regenerate_id(true);
                            }                                             
                }

                $varsesion = $_SESSION['usuario'];
                $Id_Usuario = intval($compras->get_user($varsesion)); 
                $compras->registrar_bitacora($Id_Usuario, 29, 'Insertar', 'Se agregó la compra N° ' . $idCompra .' el '.$body['fechaCompra'].', con un total de: '.$body['total'].', con la forma de pago: '.$body['observacion']);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            break;
           
        }

?>   