<?php
    class PromocionesProductos extends Conectar{

        public function get_promocionesProductos() {
            $conexion = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT a.Id_Promocion_Producto, c.Nombre AS Nombre, b.Nombre_Promocion, a.Cantidad 
                    FROM tbl_promocion_producto a 
                    INNER JOIN tbl_promociones b ON a.Id_Promocion = b.Id_Promocion
                    INNER JOIN tbl_productos c ON a.Id_Producto = c.Id_Producto";
        
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $resultado;
        }

        public function insert_promocionProducto($Id_Producto, $Id_Promocion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_promocion_producto(Id_Producto, Id_Promocion, Cantidad)
            VALUES (?,?,?);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Promocion);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_promocionProductoEditar($Id_Promocion_Producto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_promocion_producto
                    WHERE Id_Promocion_Producto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion_Producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_promocionProducto($Id_Promocion_Producto, $Id_Producto, $Id_Promocion, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_promocion_producto SET Id_Producto=?, Id_Promocion=?, Cantidad=? WHERE Id_Promocion_Producto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Producto);
            $sql->bindValue(2, $Id_Promocion);
            $sql->bindValue(3, $Cantidad);
            $sql->bindValue(4, $Id_Promocion_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_promocionProducto($Id_Promocion_Producto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_promocion_producto WHERE Id_Promocion_Producto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_productosTerminados(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_productos WHERE Id_Tipo_Producto = 1"; //El "1" es porque el tipo de producto 1, es Terminado.          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_promociones(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_promociones";           
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
    }
?>