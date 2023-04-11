<?php
    class DetalleVentas extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_detalles(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT a.Id_Detalle_Venta, b.Nombre , a.Id_Venta, a.Cantidad, a.Precio
                  FROM tbl_detalle_de_venta a, tbl_productos b
                  WHERE a.Id_Producto=b.Id_Producto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        /*public function get_productoTerminadoMP($Id_Producto_Terminado_Mp){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp WHERE Id_Producto_Terminado_Mp=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto_Terminado_Mp);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/ 
        
        
        public function get_detalleeditar($Id_Detalle_Venta){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_detalle_de_venta
                    WHERE Id_Detalle_Venta=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Detalle_Venta);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    
    }
?>