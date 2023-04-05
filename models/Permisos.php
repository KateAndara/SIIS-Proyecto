<?php
    //include_once('../components/header.components.php');

    class Permiso extends Conectar{


        public function get_permisos(){                 //Si se nececita mostrar nombre en vez de ID.         
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT 
            t1.*, 
            t2.Rol, 
            t3.Objeto,
            CASE WHEN t1.Permiso_insercion = 1 THEN 'Sí' ELSE 'No' END AS Insertar,
            CASE WHEN t1.Permiso_eliminacion = 1 THEN 'Sí' ELSE 'No' END AS Eliminar,
            CASE WHEN t1.Permiso_actualizacion = 1 THEN 'Sí' ELSE 'No' END AS Actualizar,
            CASE WHEN t1.Permiso_consultar = 1 THEN 'Sí' ELSE 'No' END AS Visualizar
        FROM 
            tbl_permisos t1
            JOIN tbl_ms_roles t2 ON t1.Id_Rol = t2.Id_Rol
            JOIN tbl_objetos t3 ON t1.Id_Objeto = t3.Id_Objeto";
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);                
        }

        public function get_permiso($busqueda){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT tbl_permisos.*, tbl_roles.Rol, tbl_objetos.Objeto 
                    FROM tbl_permisos 
                    INNER JOIN tbl_ms_roles, tbl_objetos
                    ON tbl_permisos.Id_Rol = tbl_ms_roles.Id_Rol
                    ON tbl_permisos.Id_Objeto = tbl_objetos.Id_Objeto
                    WHERE tbl_permisos.Id_Permisos LIKE :busqueda OR 
                          tbl_ms_Roles.Rol LIKE :busqueda OR 
                          tbl_objetos.Objeto LIKE :busqueda OR 
                          tbl_permisos.Permiso_insercion LIKE :busqueda OR 
                          tbl_permisos.Permiso_eliminacion LIKE :busqueda OR 
                          tbl_permisos.Permiso_actualizacion LIKE :busqueda OR 
                          tbl_permisos.Permiso_consultar LIKE :busqueda";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(':busqueda', "%$busqueda%");
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_permisoeditar($Id_Permisos){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT tbl_permisos.*, tbl_ms_roles.Rol, tbl_objetos.Objeto 
                    FROM tbl_permisos 
                    INNER JOIN tbl_ms_roles 
                    ON tbl_permisos.Id_Rol = tbl_ms_roles.Id_Rol 
                    INNER JOIN tbl_objetos 
                    ON tbl_permisos.Id_Objeto = tbl_objetos.Id_Objeto
                    WHERE tbl_permisos.Id_Permisos=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Permisos);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_permiso($Id_Rol, $Id_Objeto, $Permiso_insercion, $Permiso_eliminacion, $Permiso_actualizacion, $Permiso_consultar){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tbl_permisos(Id_Rol, Id_Objeto, Permiso_insercion, Permiso_eliminacion, Permiso_actualizacion, Permiso_consultar)
            VALUES (?,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Rol);
            $sql->bindValue(2, $Id_Objeto);
            $sql->bindValue(3, $Permiso_insercion);
            $sql->bindValue(4, $Permiso_eliminacion);
            $sql->bindValue(5, $Permiso_actualizacion);
            $sql->bindValue(6, $Permiso_consultar);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_permiso($Id_Permisos, $Id_Rol, $Id_Objeto, $Permiso_insercion, $Permiso_eliminacion, $Permiso_actualizacion, $Permiso_consultar){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tbl_permisos SET Id_Rol=?, Id_Objeto=?, Permiso_insercion=?, Permiso_eliminacion=?, Permiso_actualizacion=?, Permiso_consultar=? WHERE Id_Permisos=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Id_Rol);
            $sql->bindValue(2, $Id_Objeto);
            $sql->bindValue(3, $Permiso_insercion);
            $sql->bindValue(4, $Permiso_eliminacion);
            $sql->bindValue(5, $Permiso_actualizacion);
            $sql->bindValue(6, $Permiso_consultar);
            $sql->bindValue(7, $Id_Permisos);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_permiso($Id_Permisos){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_permisos WHERE Id_Permisos =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Permisos);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
        //Si se necesita traer datos de otra tabla para seleccionarlos como entrada
        public function get_roles(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_ms_roles";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function get_objetos(){    
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_objetos";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>