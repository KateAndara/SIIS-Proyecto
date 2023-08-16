<?php
    class Compras extends Conectar{

        public function get_compras(){              
            $conexion= parent::Conexion();
            parent::set_names();
            date_default_timezone_set('America/Tegucigalpa'); // Configuración de la zona horaria
            $sql="SELECT c.*, p.Nombre as nombreProveedor FROM  tbl_compras c INNER JOIN tbl_proveedores p on c.Id_Proveedor=p.Id_Proveedor Where c.Cancelada!=1";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            $resultados = $sql->fetchALL(PDO::FETCH_ASSOC);
        
            // Formatear la fecha en cada resultado
            foreach ($resultados as &$resultado) {
                $fecha_dt = new DateTime($resultado['Fecha_compra']);  
                $fecha_dt->setTimezone(new DateTimeZone('America/Tegucigalpa'));
                $fecha_formateada = $fecha_dt->format('d-m-Y');
                $resultado['Fecha_compra'] = $fecha_formateada;
            }
        
            return $resultados;
        
    
        }

        public function get_ultimaCompra(){              
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT Id_Compra FROM tbl_compras ORDER BY Id_Compra DESC LIMIT 1";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }
        
       public function registrar_bitacora($id_usuario, $id_objeto, $accion, $descripcion) {
            $conexion = parent::Conexion();
            parent::set_names();
            
            $sql = "INSERT INTO tbl_ms_bitacora (Id_Usuario, Id_Objeto, Fecha, Accion, Descripcion) 
                    VALUES (:id_usuario, :id_objeto, CURRENT_TIMESTAMP(), :accion, :descripcion)";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(":id_objeto", $id_objeto, PDO::PARAM_INT);
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
        public function get_compra($idCompra){              
            $conexion= parent::Conexion();
            parent::set_names();
            $arrCompra=[];
            $sql="SELECT c.*, p.Nombre as nombreProveedor FROM  tbl_compras c INNER JOIN tbl_proveedores p on c.Id_Proveedor=p.Id_Proveedor WHERE c.Id_Compra=$idCompra";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            $resultadoCompra=$sql->fetchALL(PDO::FETCH_ASSOC);
            $arrCompra['Compra']=$resultadoCompra;


            $sql="SELECT dc.*,p.Nombre FROM tbl_detalle_compra dc
            INNER JOIN tbl_productos p on p.Id_Producto=dc.Id_Producto
            WHERE dc.Id_Compra=$idCompra";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            $resultadoDetalleCompra=$sql->fetchALL(PDO::FETCH_ASSOC);
            $arrCompra['DetalleCompra']=$resultadoDetalleCompra;
            
            foreach ($arrCompra['DetalleCompra'] as $key=> $detalle) {
               
              
                $idDetalle=$detalle['Id_Detalle_Compra'];
                $sql="SELECT `Id_Detalle_Producto_Comprado`,`Especie`,`Peso_vivo`,`Canal`,`Rendimiento` FROM `tbl_detalle_producto_comprado` WHERE `Id_Detalle_Compra`= $idDetalle";          
                $sql= $conexion->prepare($sql);
                $sql->execute();
                $resultadoDetalleComprado=$sql->fetchALL(PDO::FETCH_ASSOC);
                
                array_push($arrCompra['DetalleCompra'][$key],$resultadoDetalleComprado[0]);
            }


            
        

            return $arrCompra;
        }
        public function deleteCompra($idCompra){            
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="UPDATE `tbl_compras` SET `Cancelada` = '1' WHERE `tbl_compras`.`Id_Compra` = $idCompra;";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            
           
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function get_Proveedores(){            
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * 
                  FROM tbl_proveedores";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function getProductos(){   
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos WHERE Id_Tipo_Producto=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, 2);
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
        
    
        public function insertCompra($proveedor,
        $fechaCompra,
        $total,
        $observacion,
        $idPersona){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_compras(Id_Proveedor, Fecha_compra, Total, Observacion, Creado_por)
            VALUES (?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $proveedor);
            $sql->bindValue(2, $fechaCompra);
            $sql->bindValue(3, $total);
            $sql->bindValue(4, $observacion);
            $sql->bindValue(5, $idPersona);
            $sql->execute();
             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
             $resultado = $conectar->lastInsertId();

             
           return $resultado;
        }

        public function insertDetalle($idCompra,$productoid,$precio,$cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_detalle_compra(Id_Compra, Id_Producto, Cantidad, Precio_Libra)
            VALUES (?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idCompra);
            $sql->bindValue(2, $productoid);
            $sql->bindValue(3, $cantidad);
            $sql->bindValue(4, $precio);
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

        public function insertDetalleProducto($detalleCompra,$especie,$pesoVivo,$canal,$Rendimiento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_detalle_producto_comprado(Id_Detalle_Compra, Especie, Peso_vivo, Canal,Rendimiento)
            VALUES (?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $detalleCompra);
            $sql->bindValue(2, $especie);
            $sql->bindValue(3, $pesoVivo);
            $sql->bindValue(4, $canal);
            $sql->bindValue(5, $Rendimiento);
            $sql->execute();
             $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
             $resultado = $conectar->lastInsertId();

             
           return $resultado;
        }


       
    }
?>