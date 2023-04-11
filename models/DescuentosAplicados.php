<?php
    class DescuentosApli extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_descuentosapli(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT a.Id_Ventas_Descuento,a.Id_Venta, b.Nombre_descuento ,
                  concat(a.Porcentaje_descontado,' ', '%') AS Porcentaje , a.Total_descuento
                  FROM tbl_ventas_descuento a , tbl_descuentos b
                  WHERE a.Id_Descuento = b.Id_Descuento";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }        
        
    }
?>