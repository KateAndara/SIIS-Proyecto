<?php
    class Ventas extends Conectar{

        public function get_ventas(){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT v.*,c.Nombre,e.Nombre_estado,u.Usuario from tbl_ventas v 
            INNER JOIN tbl_clientes c on v.Id_Cliente=c.Id_Cliente
            INNER JOIN tbl_estado_venta e on e.Id_Estado_Venta=v.Id_Estado_Venta
            INNER JOIN tbl_ms_usuarios u on u.Id_Usuario=v.Id_Usuario order by v.Id_Venta desc";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function get_venta($idVenta){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT v.*,c.Nombre,e.Nombre_estado,u.Usuario from tbl_ventas v 
            INNER JOIN tbl_clientes c on v.Id_Cliente=c.Id_Cliente
            INNER JOIN tbl_estado_venta e on e.Id_Estado_Venta=v.Id_Estado_Venta
            INNER JOIN tbl_ms_usuarios u on u.Id_Usuario=v.Id_Usuario where v.Id_Venta=$idVenta order by v.Id_Venta desc";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }

        public function get_detalle($idVenta){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT dv.*,p.Nombre from tbl_detalle_de_venta dv
            INNER JOIN tbl_productos p on p.Id_Producto=dv.Id_Producto where dv.Id_Venta=$idVenta";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        } 
        public function get_descuentoVenta($idVenta){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT vd.*,d.Nombre_descuento,d.Porcentaje_a_descontar FROM `tbl_ventas_descuento` vd 
            INNER JOIN tbl_descuentos d on d.Id_Descuento=vd.Id_Descuento where vd.Id_Venta=$idVenta";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        
        
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_productos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos a, tbl_tipo_producto b WHERE
             a.Id_Tipo_producto = b.Id_Tipo_Producto AND b.Nombre_tipo='Producto terminado Final'";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        public function getProducto($idProducto){   
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos WHERE Id_Producto=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $idProducto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function get_clientes(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT *
                  FROM tbl_clientes";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }
        public function get_cliente($idCliente){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT *
                  FROM tbl_clientes where Id_Cliente=?";
            $sql= $conexion->prepare($sql);
            $sql->bindValue(1, $idCliente);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);                
        }
        public function get_promociones(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT p.* FROM `tbl_promociones` p;";          
            $sql= $conexion->prepare($sql);
    

            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_productosPromo($idPromocion){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT p.*,pp.*,pr.Nombre FROM `tbl_promociones` p 
            INNER JOIN tbl_promocion_producto pp on pp.Id_Promocion=p.Id_Promocion 
            INNER JOIN tbl_productos pr on pp.Id_Producto=pr.Id_Producto where p.Id_Promocion=?";          
            $sql= $conexion->prepare($sql);
            $sql->bindValue(1, $idPromocion);
    

            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function getPromocion($idPromocion){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT p.* FROM `tbl_promociones` p  where p.Id_Promocion=?";          
            $sql= $conexion->prepare($sql);
            $sql->bindValue(1, $idPromocion);
    

            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function get_promocion($idProducto,$idDescuento){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT p.*,pp.* FROM `tbl_promociones` p INNER JOIN tbl_promocion_producto pp on pp.Id_Promocion=p.Id_Promocion where pp.Id_Producto=? && pp.Id_Promocion_Producto =? ";          
            $sql= $conexion->prepare($sql);
            $sql->bindValue(1, $idProducto);
            $sql->bindValue(2, $idDescuento);

            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        
        public function get_descuentos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_descuentos where Id_Descuento!=0";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        public function get_descuento($idDescuento){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_descuentos where Id_Descuento=$idDescuento";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        public function getCAI(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_talonario ORDER BY `tbl_talonario`.`Id_Talonario` DESC";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        public function getImpuesto(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT Valor FROM tbl_ms_parametros Where `tbl_ms_parametros`.`Parametro`='IMPUESTO'";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        
        public function get_estados(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_estado_venta";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function insertVenta(
            $idCliente,
            $Id_Usuario,
            $idEstado,
            $Subtotal,
            $Impuesto,
            $Total,
            $RTN,
            $Numero_factura){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_ventas(Id_Cliente, Id_Usuario, Id_Estado_Venta, Subtotal,Impuesto, Total, Fecha, RTN, Numero_factura)
            VALUES (?,?,?,?,?,?,CURRENT_TIMESTAMP(),?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idCliente);
            $sql->bindValue(2, $Id_Usuario);
            $sql->bindValue(3, $idEstado);
            $sql->bindValue(4, $Subtotal);
            $sql->bindValue(5, $Impuesto);
            $sql->bindValue(6, $Total);
            $sql->bindValue(7, $RTN);
            $sql->bindValue(8, $Numero_factura);
          
            $sql->execute();
             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
             $resultado = $conectar->lastInsertId();

             
           return $resultado;
        }

        public function insertVentasPromociones(
            $promocionid,$idVenta,$cantidad,$precio){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO `tbl_ventas_promociones` ( `Id_Promocion`, `Id_Venta`, `Precio_venta`, `Cantidad`) VALUES (?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $promocionid);
            $sql->bindValue(2, $idVenta);
            $sql->bindValue(3, $precio);
            $sql->bindValue(4, $cantidad);
            
          
            $sql->execute();
             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
             $resultado = $conectar->lastInsertId();

             
           return $resultado;
        }

        public function insertDetalleVenta(
            $Id_Producto,
            $Id_Venta,
            $Cantidad,
            $Precio){
                $conectar= parent::conexion();
                parent::set_names();
                $sql="INSERT INTO tbl_detalle_de_venta(Id_Producto, Id_Venta, Cantidad, Precio)
                VALUES (?,?,?,?);";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $Id_Producto);
                $sql->bindValue(2, $Id_Venta);
                $sql->bindValue(3, $Cantidad);
                $sql->bindValue(4, $Precio);
                $sql->execute();
                 $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                 $resultado = $conectar->lastInsertId();
    
                 
               return $resultado;
            }
        
            public function insertCliente(
                $Nombre,
                $Fecha_nacimiento,
                $Dni){
                    $conectar= parent::conexion();
                    parent::set_names();
                    $sql="INSERT INTO tbl_clientes(Nombre, Fecha_nacimiento, DNI)
                    VALUES (?,?,?);";
                    $sql=$conectar->prepare($sql);
                    $sql->bindValue(1, $Nombre);
                    $sql->bindValue(2, $Fecha_nacimiento);
                    $sql->bindValue(3, $Dni);
                    $sql->execute();
                     $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                     $resultado = $conectar->lastInsertId();
        
                     
                   return $resultado;
                }
 
                public function insertVentaPromocion(
                    $IdPromocion,
                    $IdVenta,
                    $PrecioVenta,
                    $Cantidad){
                        $conectar= parent::conexion();
                        parent::set_names();
                        $sql="INSERT INTO tbl_ventas_promociones(Id_Promocion, Id_Venta, Precio_Venta, Cantidad)
                        VALUES (?,?,?,?);";
                        $sql=$conectar->prepare($sql);
                        $sql->bindValue(1, $IdPromocion);
                        $sql->bindValue(2, $IdVenta);
                        $sql->bindValue(3, $PrecioVenta);
                        $sql->bindValue(4, $Cantidad);
                        $sql->execute();
                         $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                         $resultado = $conectar->lastInsertId();
            
                         
                       return $resultado;
                    }

                    public function insertDescuentoPromocion(
                        $IdVenta,
                        $IdDescuento,
                        $PorcentajeDescontado,
                        $Total){
                            $conectar= parent::conexion();
                            parent::set_names();
                            $sql="INSERT INTO tbl_ventas_descuentos(Id_Venta, Id_Descuento, Porcentaje_descontado, Total_descuento)
                            VALUES (?,?,?,?);";
                            $sql=$conectar->prepare($sql);
                            $sql->bindValue(1, $IdVenta);
                            $sql->bindValue(2, $IdDescuento);
                            $sql->bindValue(3, $PorcentajeDescontado);
                            $sql->bindValue(4, $Total);
                            $sql->execute();
                             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                             $resultado = $conectar->lastInsertId();
                
                             
                           return $resultado;
                        }
    
            public function insertKardex($productoid,$movimiento,$cantidad,$idPersona){
                            $conectar= parent::conexion();
                            parent::set_names();
                            $sql="INSERT INTO `tbl_kardex` ( `Id_Producto`, `Id_Tipo_Movimiento`, `Cantidad`,`Id_Usuario`,`Fecha_hora`) VALUES (?,?,?,?,CURRENT_TIMESTAMP());";
                            $sql=$conectar->prepare($sql);
                       
                            $sql->bindValue(1, $productoid);
                            $sql->bindValue(2, $movimiento);
                            $sql->bindValue(3, $cantidad);
                            $sql->bindValue(4, $idPersona);
                
                            $sql->execute();
                             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                             $resultado = $conectar->lastInsertId();
                
                             
            return $resultado;
            }

            public function insertVentasDescuento($idVenta,
            $idDescuento,
            $Porcentaje,
            $Totaldescontado){
                $conectar= parent::conexion();
                parent::set_names();
                $sql="INSERT INTO `tbl_ventas_descuento` (`Id_Venta`, `Id_Descuento`, `Porcentaje_descontado`, `Total_descuento`) VALUES (?,?,?, ?);";
                $sql=$conectar->prepare($sql);
           
                $sql->bindValue(1, $idVenta);
                $sql->bindValue(2, $idDescuento);
                $sql->bindValue(3, $Porcentaje);
                $sql->bindValue(4, $Totaldescontado);
    
                $sql->execute();
                 $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                 $resultado = $conectar->lastInsertId();
    
                 
                return $resultado;
                }

            public function updateInventario($productoid,$cantidad){
                           $conectar= parent::Conexion();
                            parent::set_names();
                            $sql="SELECT Existencia FROM tbl_inventario WHERE Id_Producto=?";
                            $sql=$conectar->prepare($sql);
                            $sql->bindvalue(1, $productoid);
                            $sql->execute();
                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                            
                            $existencia=$resultado[0]['Existencia']-$cantidad;
                
                            $sql="UPDATE `tbl_inventario` SET `Existencia` = '$existencia' WHERE `tbl_inventario`.`Id_Producto` = $productoid;";
                            $sql=$conectar->prepare($sql);
                          
                            $sql->execute();
                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                
                
                           return $resultado;
            }


            public function updatePromocionProducto($promocionProducto,$cantidad){
                $conectar= parent::Conexion();
                 parent::set_names();
                 $sql="SELECT Cantidad FROM tbl_promocion_producto WHERE Id_Promocion_Producto=?";
                 $sql=$conectar->prepare($sql);
                 $sql->bindvalue(1, $promocionProducto);
                 $sql->execute();
                 $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                 
                 $existencia=$resultado[0]['Cantidad']-$cantidad;
     
                 $sql="UPDATE `tbl_promocion_producto` SET `Cantidad` = '$existencia' WHERE `tbl_promocion_producto`.`Id_Promocion_Producto` = $promocionProducto;";
                 $sql=$conectar->prepare($sql);
               
                 $sql->execute();
                 $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
     
     
                return $resultado;
 }
            public function updateCAI($idTalonario,$valorActual){
                $conectar= parent::Conexion();
                 parent::set_names();
                
     
                 $sql="UPDATE `tbl_talonario` SET `Rango_actual` = '$valorActual' WHERE `tbl_talonario`.`Id_Talonario` = $idTalonario;";
                 $sql=$conectar->prepare($sql);
               
                 $sql->execute();
                 $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
     
     
                return $resultado;
        }

        public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion){
            $conexion= parent::Conexion();
            parent::set_names();
            
            $sql="INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                  VALUES (:id_usuario, :id_objeto, :fecha, :accion, :descripcion)";
            $stmt= $conexion->prepare($sql);
            $fecha = date("Y-m-d H:i:s");
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $stmt->bindParam(":accion", $accion, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->execute();
        }
        public function get_user($user){
            $conexion = parent::Conexion();
            parent::set_names();
            $sql = "SELECT Id_Usuario FROM tbl_ms_usuarios WHERE Usuario = ?";
            $stmt = $conexion->prepare($sql);
            if ($stmt) {
                $stmt->bindValue(1, $user, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado['Id_Usuario'];
            } else {
                return null;
            }
        }
       
    }
?>