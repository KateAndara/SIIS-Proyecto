<?php
    class ContactoClienteMM extends Conectar{


        public function get_ContactoClientesMM(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT t1.*, t2.Nombre_tipo_contacto, t3.Nombre
                  FROM tbl_clientes_contacto t1                              
                  JOIN tbl_tipo_contacto t2 ON t1.Id_Tipo_Contacto = t2.Id_Tipo_Contacto
                  JOIN tbl_clientes t3 ON t1.Id_Cliente = t3.Id_Cliente";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function get_ContactoClienteMM($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT tbl_clientes_contacto.*, tbl_clientes.Nombre, tbl_tipo_contacto.Nombre_tipo_contacto
                    FROM tbl_clientes_contacto 
                    INNER JOIN tbl_clientes 
                    ON tbl_clientes_contacto.Id_Cliente = tbl_clientes.Id_Cliente 
                    INNER JOIN tbl_tipo_contacto  
                    ON tbl_clientes_contacto.Id_Tipo_Contacto = tbl_tipo_contacto.Id_Tipo_Contacto 
                    WHERE tbl_clientes_contacto.Id_Cliente_Contacto LIKE :busqueda OR 
                        tbl_tipo_contacto.Nombre_tipo_contacto LIKE :busqueda OR 
                        tbl_clientes.Nombre LIKE :busqueda OR 
                        tbl_clientes_contacto.Contacto LIKE :busqueda";
        
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_ContactoClienteMMeditar($Id_Cliente_Contacto){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_clientes_contacto.*, tbl_clientes.Nombre 
                    FROM tbl_clientes_contacto 
                    INNER JOIN tbl_clientes 
                    ON tbl_clientes_contacto.Id_Cliente = tbl_clientes.Id_Cliente 
                    INNER JOIN tbl_tipo_contacto  
                    ON tbl_clientes_contacto.Id_Tipo_Contacto = tbl_tipo_contacto.Id_Tipo_Contacto
                    WHERE tbl_clientes_contacto.Id_Cliente_Contacto=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente_Contacto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_ContactoClienteMM($Id_Tipo_Contacto, $Id_Cliente, $Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_clientes_contacto(Id_Tipo_Contacto, Id_Cliente, Contacto)
            VALUES (?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Contacto);
            $sql->bindValue(2, $Id_Cliente);
            $sql->bindValue(3, $Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_ContactoClienteMM($Id_Cliente_Contacto, $Id_Tipo_Contacto, $Id_Cliente, $Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_clientes_contacto SET Id_Tipo_Contacto=?, Id_Cliente=?, Contacto=? WHERE Id_Cliente_Contacto=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Tipo_Contacto);
            $sql->bindValue(2, $Id_Cliente);
            $sql->bindValue(3, $Contacto);
            $sql->bindValue(4, $Id_Cliente_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_ContactoClienteMM($Id_Cliente_Contacto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_clientes_contacto WHERE Id_Cliente_Contacto =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Cliente_Contacto);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_Contactos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_tipo_contacto";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_Clientes(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_clientes";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>