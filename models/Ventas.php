<?php
    class Ventas extends Conectar{

        public function get_ventas(){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT a.Id_Venta, b.Nombre, c.Usuario, d.Nombre_estado, a.Subtotal,
                  a.Impuesto, a.Total, a.Fecha, a.RTN, a.Numero_factura FROM  tbl_ventas a, tbl_clientes b, tbl_ms_usuarios c,
                  tbl_estado_venta d, tbl_ventas_descuento e  WHERE a.Id_Cliente=b.Id_Cliente and a.Id_Usuario=c.Id_Usuario
                  and a.Id_Estado_Venta = d.Id_Estado_Venta";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_productos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos a, tbl_tipo_producto b WHERE
             a.Id_Tipo_producto = b.Id_Tipo_Producto AND b.Nombre_tipo='Producto terminado'";          
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
        
        public function get_promociones(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_promociones";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        public function get_descuentos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_descuentos";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
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
        $Id_Cliente,
        $Id_Usuario,
        $Id_Estado,
        $Subtotal,
        $Impuesto,
        $Total,
        $Fecha,
        $RTN,
        $Num_Factura){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_ventas(Id_Cliente, Id_Usuario, Id_Estado_Venta, Subtotal,Impuesto, Total, Fecha, RTN, Numero_factura)
            VALUES (?,?,?,?,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Cliente);
            $sql->bindValue(2, $Id_Usuario);
            $sql->bindValue(3, $Id_Estado);
            $sql->bindValue(4, $Subtotal);
            $sql->bindValue(5, $Impuesto);
            $sql->bindValue(6, $Total);
            $sql->bindValue(7, $Fecha);
            $sql->bindValue(8, $RTN);
            $sql->bindValue(9, $Num_Factura);
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
                $sql="INSERT INTO tbl_detalle_de_ventas(Id_Producto, Id_Venta, Cantidad, Precio)
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

            public function updateInventario($productoid,$cantidad){
                           $conectar= parent::Conexion();
                            parent::set_names();
                            $sql="SELECT existencia FROM tbl_inventario WHERE Id_Producto=?";
                            $sql=$conectar->prepare($sql);
                            $sql->bindvalue(1, $productoid);
                            $sql->execute();
                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                            $existencia=$resultado[0]['existencia']+$cantidad;
                
                            $sql="UPDATE `tbl_inventario` SET `Existencia` = '$existencia' WHERE `tbl_inventario`.`Id_Producto` = $productoid;";
                            $sql=$conectar->prepare($sql);
                          
                            $sql->execute();
                            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
                
                
                           return $resultado;
            }

       
    }
?>