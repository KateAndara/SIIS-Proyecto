<?php
    class Clientes extends Conectar{ 

        

        public function get_clientes(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT *
                  FROM tbl_clientes";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        
        
        public function get_cliente($busqueda){  //Buscar por nombre y id               
            $conectar = parent::Conexion();
            parent::set_names();
        
            // Verificar si la búsqueda es un número o una cadena
            if (is_numeric($busqueda)) {
                $sql = "SELECT * 
                        FROM tbl_clientes  
                        WHERE Id_Cliente=?" ;
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            } else {
                $sql = "SELECT * 
                        FROM tbl_clientes
                        WHERE Nombre=?";
                $sql = $conectar->prepare($sql);
                $sql->bindvalue(1, $busqueda);
            }
        
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function get_clienteeditar($Id_Cliente){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * 
                    FROM tbl_clientes
                    WHERE Id_Cliente=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_cliente($Nombre_cliente, $Fecha_nacimiento,$DNI){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_clientes(Nombre, Fecha_nacimiento,DNI)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cliente);
            $sql->bindValue(2, $Fecha_nacimiento);
            $sql->bindValue(3, $DNI);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_cliente($Id_Cliente, $Nombre_cliente, $Fecha_nacimiento, $DNI){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_clientes SET Nombre=?, Fecha_nacimiento=?, DNI=? WHERE Id_Cliente=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nombre_cliente);
            $sql->bindValue(2, $Fecha_nacimiento);
            $sql->bindValue(3, $DNI);
            $sql->bindValue(4, $Id_Cliente);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_cliente($Id_Cliente){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_clientes WHERE Id_Cliente =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>