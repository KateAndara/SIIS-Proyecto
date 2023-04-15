<?php
    class Talonario extends Conectar{

        public function get_Talonarios(){               //Si no se nececita mostrar nombre en vez de ID.
            $conexion= parent::Conexion();
            parent::set_names();
            $sql="SELECT * FROM tbl_talonario";          
            $sql= $conexion->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function selectTalonario($cai){  //Buscar por cualquier campo
            $conectar = parent::Conexion();
            parent::set_names();
        
            $sql = "SELECT * FROM tbl_talonario 
                    WHERE Numero_CAI =?"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cai);
            $sql->execute();
        
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_roleditar($Id_Talonario){       //Trae los datos de la fila que se quiere editar.           
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tbl_talonario
                    WHERE Id_Talonario=?";
            $sql = $conectar->prepare($sql);
            $sql->bindvalue(1, $Id_Talonario);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_talonario($idPersona,$numCai,$rangeInicial,$rangeFinal,$rangeActual,$dateVencimiento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO `tbl_talonario` (`Id_Usuario`, `Numero_CAI`, `Rango_Inicial`, `Rango_final`, `Rango_actual`, `Fecha_Vencimiento`) VALUES (?, ?, ?, ?, ?, ?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idPersona);
            $sql->bindValue(2, $numCai);
            $sql->bindValue(3, $rangeInicial);
            $sql->bindValue(4, $rangeFinal);
            $sql->bindValue(5, $rangeActual);
            $sql->bindValue(6, $dateVencimiento);

            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function update_Talonario($idTalonario,$numCai,$rangeInicial,$rangeFinal,$rangeActual,$dateVencimiento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE `tbl_talonario` SET `Numero_CAI` = ?, `Rango_Inicial` = ?, `Rango_final` = ?, `Rango_actual` = ?, `Fecha_Vencimiento` = ? WHERE `tbl_talonario`.`Id_Talonario` = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $numCai);
            $sql->bindValue(2, $rangeInicial);
            $sql->bindValue(3, $rangeFinal);
            $sql->bindValue(4, $rangeActual);
            $sql->bindValue(5, $dateVencimiento);
            $sql->bindValue(6, $idTalonario);

            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }

        public function delete_Talonario($idTalonario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM tbl_talonario WHERE Id_Talonario =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $idTalonario);
            $sql->execute();
            return $resultado=$sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>