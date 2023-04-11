<?php
    class PromocionesApli extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_promocionesapli(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT a.Id_Venta_Promocion, b.Nombre_Promocion, a.Id_Venta, a.Precio_venta, a.Cantidad 
                  FROM tbl_ventas_promociones a , tbl_promociones b
                  WHERE a.Id_Promocion = b.Id_Promocion";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        
        
        
        
        
    }
?>