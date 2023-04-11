<?php
    class Promociones extends Conectar{

        /*public function get_productosTerminadosMP(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_producto_terminado_mp";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }*/

        public function get_promociones(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * 
                  FROM tbl_promociones";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        
        
        public function get_promocion($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            $arrPromocion=[];
            $sql="SELECT * FROM  tbl_promociones  WHERE c.Id_Promocion=$busqueda";          
            $sql= $conectar->prepare($sql);
            $sql->execute();
            $resultadopromocion= $sql->fetchAll(PDO::FETCH_ASSOC);
            $arrPromocion['Promocion']=$resultadopromocion;
            return $arrPromocion;
        }
        public function get_promocioneditar($Id_Promocion){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_promociones
                    WHERE Id_Promocion=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductos(){   
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos WHERE Id_Tipo_Producto=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, 3);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        public function insert_promocion($Nombre_Promocion,$IdProducto, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL INS_PROMOCION(?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->bindValue(5, $IdProducto);
            $sql->execute();
            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
            $resultado = $conectar->lastInsertId();
            return $resultado;
        }
          
        public function insert__promocion_producto($Id_Promocion, $Id_Producto, $Cantidad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_promocion_producto(Id_Promocion, Id_Producto, Cantidad)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Promocion);
            $sql->bindValue(2, $Id_Producto);
            $sql->bindValue(3, $Cantidad);
            $sql->execute();
            $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
            $resultado = $conectar->lastInsertId();
            return $resultado;
        }


        public function update_promocion($Id_Promocion, $Nombre_Promocion, $Precio_Venta, $Fecha_inicio, $Fecha_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_promociones SET Nombre_Promocion=?, Precio_Venta=?, Fecha_inicio=?, Fecha_final=? WHERE Id_Promocion=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_Promocion);
            $sql->bindValue(2, $Precio_Venta);
            $sql->bindValue(3, $Fecha_inicio);
            $sql->bindValue(4, $Fecha_final);
            $sql->bindValue(5, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_promocion($Id_Promocion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_promociones WHERE Id_Promocion =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Promocion);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
    }
?>