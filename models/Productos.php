<?php
    class Producto extends Conectar{

        public function get_productos(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre_tipo
                  FROM tbl_productos t1                              
                  JOIN tbl_tipo_producto t2 ON t1.Id_Tipo_Producto = t2.Id_Tipo_Producto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }


        public function get_producto($busqueda){    //Si no se nececita mostrar nombre en vez de ID.
            $conectar= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_productos 
                    WHERE Id_Producto LIKE :busqueda OR
                          Nombre_tipo LIKE :busqueda OR
                          Nombre LIKE :busqueda OR
                          Unidad_medida LIKE :busqueda OR
                          Precio LIKE :busqueda OR
                          Cantidad_maxima LIKE :busqueda OR
                          Cantidad_minimma LIKE :busqueda";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(':busqueda', "%$busqueda%");
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }           

        public function get_productoeditar($Id_Producto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_productos.*, tbl_tipo_producto.Nombre_tipo
                    FROM tbl_productos
                    INNER JOIN tbl_tipo_producto
                    ON tbl_productos.Id_Tipo_Producto = tbl_tipo_producto.Id_Tipo_Producto 
                    WHERE tbl_productos.Id_Producto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_producto($Id_Tipo_Producto, $Nombre, $Unidad_medida, $Precio, $Cantidad_maxima, $Cantidad_minima){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_productos(Id_Tipo_Producto, Nombre, Unidad_medida, Precio, Cantidad_maxima, Cantidad_minima)
            VALUES (?,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);            
            $sql->bindValue(1, $Id_Tipo_Producto);
            $sql->bindValue(2, $Nombre);
            $sql->bindValue(3, $Unidad_medida);
            $sql->bindValue(4, $Precio);
            $sql->bindValue(5, $Cantidad_maxima);
            $sql->bindValue(6, $Cantidad_minima);
            $resultado = $sql->execute();
            return $resultado;
        }

        public function update_producto($Id_Producto, $Id_Tipo_Producto, $Nombre, $Unidad_medida, $Precio, $Cantidad_maxima, $Cantidad_minima){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_productos SET Id_Tipo_Producto=?, Nombre=?, Unidad_medida=?, Precio=?, Cantidad_maxima=?, Cantidad_minima=? WHERE Id_Producto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Producto);
            $sql->bindValue(2, $Nombre);
            $sql->bindValue(3, $Unidad_medida);
            $sql->bindValue(4, $Precio);
            $sql->bindValue(5, $Cantidad_maxima);
            $sql->bindValue(6, $Cantidad_minima);
            $sql->bindValue(7, $Id_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        

        public function delete_producto($Id_Producto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_productos WHERE Id_Producto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Producto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_tipoproductos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_producto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    
    }
?>